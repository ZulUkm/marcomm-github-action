<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderReturn;
use App\Models\OrderReturnItem;
use App\Services\AttachmentService;
use App\Services\MailService;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderNotification;
use App\Mail\OrderReturnNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Attachment;

class OrderService
{
    protected $attachmentService;
    protected $mailService;

    public function __construct(AttachmentService $attachmentService, MailService $mailService)
    {
        $this->attachmentService = $attachmentService;
        $this->mailService = $mailService;
    }

    public function getAllOrders()
    {
        $query = Order::all();
        return $query;
    }

    public function countAllOrders()
    {
        return Order::count();
    }

    public function countPendingOrders()
    {
        return Order::where('status', 'Pending')->count();
    }

    public function getOrderById($id)
    {
        $order = Order::find($id);
        return $order;
    }

    public function getOrderByAuthUser($userId)
    {
        $orders = Order::where('customer_id', $userId)->get();
        return $orders;
    }

    public function createOrder(array $data): Order
    {
        // Generate unique order number
        $data['order_number'] = $this->generateOrderNumber();
        $data['customer_id'] = auth()->id() ?? null;

        // Create the order
        $order = Order::create($data);

        return $order;
    }

    public function createOrderItems(Order $order, array $items): array
    {
        $orderItems = [];
        foreach ($items as $item) {
            $orderItem = new OrderItem([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['quantity'] * $item['price'],
            ]);
            $order->items()->save($orderItem);
            $orderItems[] = $orderItem;
        }
        return $orderItems;
    }

    public function updateOrder(Order $order, array $data): bool
    {
        return $order->update($data);
    }

    public function deleteOrder(Order $order): bool
    {
        return $order->delete();
    }

    public function attachFiles(Order $order, array $files): array
    {
        $attachments = [];
        foreach ($files as $file) {
            $attachments[] = $this->attachmentService->store($file);
        }
        $order->attachments()->saveMany($attachments);
        return $attachments;
    }

    private function generateOrderNumber()
    {
        // Format: ORD-YYYYMMDD-XXX
        $prefix = 'ORD';
        $date = date('Ymd');

        // Get the latest order from today
        $latestOrder = \App\Models\Order::where('order_number', 'like', "{$prefix}-{$date}-%")
            ->latest()
            ->first();

        if (!$latestOrder) {
            // First order of the day
            return "{$prefix}-{$date}-001";
        }

        // Extract the sequence number
        $orderNumber = $latestOrder->order_number;
        $sequence = (int) substr($orderNumber, -3);

        // Increment and pad
        $sequence++;
        return "{$prefix}-{$date}-" . str_pad($sequence, 3, '0', STR_PAD_LEFT);
    }

    public function deductInventory(Order $order)
    {
        foreach ($order->items as $item) {
            $product = Product::find($item->product_id);

            if ($product) {
                // Check if we have enough stock
                if ($product->stock->quantity < $item->quantity) {
                    throw new \Exception("Not enough stock for product: {$product->name}. Available: {$product->stock->quantity}, Required: {$item->quantity}");
                }

                // Deduct stock
                $product->stock->quantity -= $item->quantity;
                $product->stock->save();
            }
        }
    }

    public function createOrderReturn(Order $order, array $returnData)
    {
        // Create order return record
        $orderReturn = OrderReturn::create([
            'order_id' => $order->id,
            'return_date' => now(),
            'reason' => $returnData['reason'] ?? null,
            'notes' => $returnData['notes'] ?? null,
            'processed_by' => auth()->id() ?? null,
        ]);

        return $orderReturn;
    }

    public function getOrderItem(Order $order, $itemId): ?OrderItem
    {
        return $order->items()->where('id', $itemId)->first();
    }

    public function checkQuantityExceed($quantity, $orderItem)
    {
        if ($quantity > $orderItem->quantity) {
            throw new \Exception("Return quantity cannot exceed ordered quantity for item #{$itemId}");
        }
    }

    public function createOrderReturnItem(OrderReturn $orderReturn, OrderItem $orderItem, int $quantity, bool $restocked = false)
    {
        return OrderReturnItem::create([
            'order_return_id' => $orderReturn->id,
            'order_item_id' => $orderItem->id,
            'product_id' => $orderItem->product_id,
            'quantity' => $quantity,
            'restocked' => $restocked,
        ]);
    }

    public function sendNewOrderNotification($order)
    {
        try {
            
            $superAdminEmails = $this->mailService->getAllSuperAdminEmails();

           // Send Email Notification to Super-Admin to approve
           Mail::to($superAdminEmails)->send(new NewOrderNotification($order));
        } catch (\Exception $e) {
            Log::error('Failed to send order notification: ' . $e->getMessage());
        }
    }

    public function sendReturnOrderNotification($order, $orderReturn)
    {
        $superAdminEmails = $this->mailService->getAllSuperAdminEmails();
      
        try {
            // Send Email Return
            Mail::to($superAdminEmails)->send(new OrderReturnNotification($order, $orderReturn));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send return order notification: ' . $e->getMessage());
        }
    }
}
