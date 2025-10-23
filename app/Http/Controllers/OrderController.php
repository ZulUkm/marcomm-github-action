<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\OrderService;
use App\Services\EventService;
use App\Services\MailService;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderReturn;
use App\Models\OrderReturnItem;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $productService;
    protected $orderService;
    protected $eventService;
    protected $mailService;

    //test
    /**
     * Constructor with dependency injection
     */
    public function __construct(ProductService $productService, OrderService $orderService, EventService $eventService, MailService $mailService)
    {
        $this->middleware('auth');
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->eventService = $eventService;
        $this->mailService = $mailService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $orders = $this->orderService->getOrderByAuthUser(Auth::id());

        return view('order.index', compact('orders'));
    }

    public function order()
    {
        return view('pos.order');
    }

    public function list_orders()
    {
        // Logic to list orders
        return view('pos.pos-orders');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = $this->productService->getProductCategories();
        $categories = Category::with('products.attachments')->get();
        $products = Product::with('category', 'attachments')->get();
        return view('order.pos', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        // Validate the request
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date|after_or_equal:today',
            'event_end_date' => 'required|date|after_or_equal:event_date',
            'event_location' => 'nullable|string|max:255',
            // 'notes' => 'nullable|string|max:1000',
            // 'items' => 'required|array|min:1',
            // 'items.*.product_id' => 'required|exists:products,id',
            // 'items.*.quantity' => 'required|integer|min:1',
            // 'items.*.price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();
            

            $order = $this->orderService->createOrder($request->all());

            $order->addStatus('Pending', 'Order Successfully Created');

            $this->orderService->createOrderItems($order, $request->items);

            // Create event associated with the order
            $event = $this->eventService->createEvent([
                'order_id' => $order->id,
                'event_name' => $request->event_name,
                'event_start_date' => $request->event_date,
                'event_end_date' => $request->event_end_date,
                'location' => $request->event_location ?? 'Not location',
                'description' => $request->notes,
            ]);

            $this->orderService->sendNewOrderNotification($order);
     
            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withErrors('Error placing order: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resourceaa
     */
    public function show(string $id)
    {
        $order = $this->orderService->getOrderById($id);

        return view('order.show', compact('order'));
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
        // dd($order);
        // // Ensure user is admin
        // if (!auth()->user() || !auth()->user()->isAdmin()) {
        //     abort(403, 'Unauthorized action.');
        // }

        echo "Processing order ID: " . $order->id . " with action: " . $request->action;die;

        // Validate input
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

                \Illuminate\Support\Facades\Mail::to('zulfaris966@gmail.com')->cc('cc@example.com')->send(new \App\Mail\OrderApprovedNotification($order, $comments));

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

            return redirect()->route('orders.show', $order->id)->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors('Error updating order status: ' . $e->getMessage());
        }
    }
}
