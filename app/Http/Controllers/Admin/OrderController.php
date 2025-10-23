<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\OrderService;
use App\Services\EventService;
use App\Services\MailService;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderReturn;
use App\Models\OrderReturnItem;
use App\Models\OrderItem;
use App\Mail\OrderApprovedNotification;
use App\Mail\OrderRejectedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    protected $productService;
    protected $orderService;
    protected $eventService;
    protected $mailService;

    /**
     * Constructor with dependency injection
     */
    public function __construct(ProductService $productService, OrderService $orderService, EventService $eventService, MailService $mailService)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->eventService = $eventService;
        $this->mailService = $mailService;
    }

    public function index()
    {
        $orders = $this->orderService->getAllOrders();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = $this->orderService->getOrderById($id);
        if (!$order) {
            return redirect()->route('admin.orders.index')->withErrors('Order not found.');
        }
        return view('admin.orders.show', compact('order'));
    }

    public function approve(Request $request, Order $order)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'comments' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            $comments = $request->comments;

            if ($request->action === 'approve') {
                // Update order status
                $this->orderService->updateOrder($order, ['status' => 'Approved']);

                // Deduct inventory
                $this->orderService->deductInventory($order);

                // Add status history entry
                $order->addStatus('Approved', $comments ?: 'Order approved by admin.');

              

                Mail::to('zulfaris966@gmail.com')->cc('cc@example.com')->send(new \App\Mail\OrderApprovedNotification($order, $comments));

                $message = 'Order has been approved successfully and inventory has been updated.';
            } elseif ($request->action === 'reject') {
                // Update order status
                $this->orderService->updateOrder($order, ['status' => 'Rejected']);

                // Add status history entry
                $order->addStatus('Rejected', $comments ?: 'Order rejected by admin.');

                // Notify customer
                \Illuminate\Support\Facades\Mail::to('zulfaris966@gmail.com')->send(new \App\Mail\OrderRejectedNotification($order, $comments));

                $message = 'Order has been rejected.';
            }

            DB::commit();

            return redirect()->route('admin.orders.show', $order->id)->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors('Error updating order status: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function processApproval(Request $request, Order $order)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'comments' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            $comments = $request->comments;

            if ($request->action === 'approve') {
                // Update order status
                $this->orderService->updateOrder($order, ['status' => 'Approved']);

                // Deduct inventory
                $this->orderService->deductInventory($order);

                // Add status history entry
                $order->addStatus('Approved', $comments ?: 'Order approved by admin.');

                // Notify customer and admins
                $adminEmails = $this->mailService->getAllAdminEmails();
              
                Mail::to($order->customer->email)->cc($adminEmails)->send(new OrderApprovedNotification($order, $comments));

                $message = 'Order has been approved successfully and inventory has been updated.';
            } elseif ($request->action === 'reject') {
                // Update order status
                $this->orderService->updateOrder($order, ['status' => 'Rejected']);

                // Add status history entry
                $order->addStatus('Rejected', $comments ?: 'Order rejected by admin.');

                // Notify customer
                Mail::to($order->customer->email)->send(new OrderRejectedNotification($order, $comments));

                $message = 'Order has been rejected.';
            }

            DB::commit();

            return redirect()->route('admin.orders.show', $order->id)->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors('Error updating order status: ' . $e->getMessage());
        }
    }

    public function processReturn(Request $request, Order $order)
    {
        // Validate input
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            // Create order return record
            $orderReturn = $this->orderService->createOrderReturn($order, $request->all());

            // Process each returned item
            foreach ($request->returns as $itemId => $returnData) {
                $quantity = (int) $returnData['quantity'];

                // Get the order item
                $orderItem = $this->orderService->getOrderItem($order, $itemId);

                // Ensure return quantity doesn't exceed ordered quantity
                $this->orderService->checkQuantityExceed($quantity, $orderItem);

                // Get the product
                $product = $this->productService->getProductById($orderItem->product_id);

                echo ' -lama ' . $product->stock->quantity . '<br/>';

                // Create return item record using the service
                $returnItem = $this->orderService->createOrderReturnItem($orderReturn, $orderItem, $quantity);

                if ($quantity > 0) {
                    // Restock the product
                    $product = $this->productService->restockProduct($product, $quantity);
                }
                echo ' -baru ' . $product->stock->quantity . '<br/>';
            }

            // Update order status
            $order->status = 'Returned';
            $order->save();

            // Add status history entry
            $order->addStatus('Returned', $request->reason);
            
            // Notify Admin about return
            $this->orderService->sendReturnOrderNotification($order, $orderReturn);

             DB::commit();

            return redirect()->route('admin.orders.show', $order->id)->with('success', 'Order has been marked as returned.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors('Error processing return: ' . $e->getMessage());
        }
    }
}
