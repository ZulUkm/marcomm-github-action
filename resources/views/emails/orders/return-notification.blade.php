<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Return Notification</title>
</head>

<body
    style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f9f9f9; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <!-- Header -->
        <div style="background-color: #FFA500; padding: 30px; text-align: center; color: white;">
            <h1
                style="margin: 0; font-size: 24px; font-weight: 600; color: white; text-shadow: 0 1px 2px rgba(0,0,0,0.2);">
                Order Return Notification
            </h1>
            <p style="margin: 10px 0 0; color: white;">{{ date('F d, Y h:i A') }}</p>
        </div>

        <!-- Order Info Card -->
        <div style="padding: 30px; background-color: white;">
            <div
                style="background-color: #f7fafc; border-left: 4px solid #FFA500; padding: 20px; border-radius: 4px; margin-bottom: 30px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold; width: 40%;">Order Number:</td>
                        <td style="padding: 8px 0;">{{ $order->order_number }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Return Date:</td>
                        <td style="padding: 8px 0;">
                            {{ \Carbon\Carbon::parse($orderReturn->return_date)->format('d M Y, h:i A') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Customer:</td>
                        <td style="padding: 8px 0;">{{ $order->customer->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Return Reason:</td>
                        <td style="padding: 8px 0;">{{ $orderReturn->reason }}</td>
                    </tr>
                </table>
            </div>

            <!-- Items Table -->
            <h2
                style="font-size: 18px; margin-top: 30px; margin-bottom: 15px; color: #444; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                Returned Items
            </h2>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                <thead>
                    <tr style="background-color: #f1f5f9;">
                        <th style="text-align: left; padding: 12px; border-bottom: 2px solid #e2e8f0;">Product</th>
                        <th style="text-align: center; padding: 12px; border-bottom: 2px solid #e2e8f0;">Quantity</th>
                        <th style="text-align: center; padding: 12px; border-bottom: 2px solid #e2e8f0;">Condition</th>
                        <th style="text-align: center; padding: 12px; border-bottom: 2px solid #e2e8f0;">Restocked</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderReturn->items as $item)
                        <tr>
                            <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">
                                {{ $item->product->name ?? 'Unknown Product' }}
                            </td>
                            <td style="text-align: center; padding: 12px; border-bottom: 1px solid #e2e8f0;">
                                {{ $item->quantity }}
                            </td>
                            <td style="text-align: center; padding: 12px; border-bottom: 1px solid #e2e8f0;">
                                <span
                                    style="display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; 
                                  background-color: {{ $item->condition === 'good' ? '#e6f7e6' : '#fdf2f2' }}; 
                                  color: {{ $item->condition === 'good' ? '#2e7d32' : '#c53030' }};">
                                    {{ ucfirst($item->condition) }}
                                </span>
                            </td>
                            <td style="text-align: center; padding: 12px; border-bottom: 1px solid #e2e8f0;">
                                @if ($item->restocked)
                                    <span style="color: #2e7d32; font-weight: bold;">✓</span>
                                @else
                                    <span style="color: #c53030; font-weight: bold;">✗</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td style="text-align: right; padding: 12px; font-weight: bold;">Total Returned Items:</td>
                        <td style="text-align: center; padding: 12px; font-weight: bold; color: #FFA500;">
                            {{ $orderReturn->items->sum('quantity') }}
                        </td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>

            @if ($orderReturn->notes)
                <!-- Notes Section -->
                <div
                    style="background-color: #fffbea; border-left: 4px solid #f6ad55; padding: 15px; border-radius: 4px; margin-bottom: 30px;">
                    <h3 style="margin-top: 0; margin-bottom: 10px; font-size: 16px; color: #744210;">Return Notes:</h3>
                    <p style="margin: 0; color: #744210;">{{ $orderReturn->notes }}</p>
                </div>
            @endif

            <!-- Action Button -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('orders.show', $order->id) }}"
                    style="background-color: #FFA500; color: white; padding: 12px 30px; text-decoration: none; border-radius: 4px; font-weight: 600; display: inline-block; letter-spacing: 0.5px;">
                    View Order Details
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div style="background-color: #1a202c; color: white; padding: 20px; text-align: center; font-size: 14px;">
            <p style="margin: 0 0 10px;">Thank you, {{ config('app.name') }} Admin System</p>
            <p style="margin: 0; color: #a0aec0;">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </div>
</body>

</html>
