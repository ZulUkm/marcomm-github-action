<?php

namespace App\Http\Controllers;
use App\Services\OrderService;
use App\Models\Order;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CalendarController extends Controller
{

    protected $orderService;
    /**
     * Constructor with dependency injection
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $orders = $this->orderService->getAllOrders();

        // foreach ($orders as $order) {
        //    dd($order->event->event_name);
        // }

        return view('calendar.index', compact('orders'));
        // return view('calendar.index');
    }

    public function getOrders()
    {
        // echo 'habis';die;
        $orders = $this->orderService->getAllOrders();

        $events = [];

        foreach ($orders as $order) {

            if($order->status != 'Pending'){
                $events[] = [
                    'id' => $order->id,
                    'title' => $order->event->event_name ?? 'No Event Name',
                    'start' => Carbon::parse($order->event->event_start_date)->toDateString(),
                    'end' => Carbon::parse($order->event->event_end_date)->toDateString(),
                    'location' => $order->event->location ?? '',
                    'description' => $order->event->description ?? '',
                    'backgroundColor' => '#28a745',
                    'borderColor' => '#28a745',
                    'textColor' => '#ffffff'
                ];
            }
            
        }

        return response()->json($events);
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
        //
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
}
