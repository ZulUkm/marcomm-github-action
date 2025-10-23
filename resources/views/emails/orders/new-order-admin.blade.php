<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Notification</title>
</head>

<body
    style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f9f9f9; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <!-- Header -->
        <div
            style="background-color: #2575fc; background-image: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); padding: 30px; text-align: center; color: white;">
            <h1
                style="margin: 0; font-size: 24px; font-weight: 600; color: white; text-shadow: 0 1px 2px rgba(0,0,0,0.2);">
                New Order Requires Approval</h1>
            <p style="margin: 10px 0 0; color: white;">{{ date('F d, Y h:i A') }}</p>
        </div>

        <!-- Order Info Card -->
        <div style="padding: 30px; background-color: white;">
            <div
                style="background-color: #f7fafc; border-left: 4px solid #2575fc; padding: 20px; border-radius: 4px; margin-bottom: 30px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold; width: 40%;">Order Number:</td>
                        <td style="padding: 8px 0;">{{ $order->order_number }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Date Submitted:</td>
                        <td style="padding: 8px 0;">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Customer:</td>
                        <td style="padding: 8px 0;">{{ $order->customer->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Department:</td>
                        <td style="padding: 8px 0;">{{ $order->customer->department ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Items Table -->
            <h2
                style="font-size: 18px; margin-top: 30px; margin-bottom: 15px; color: #444; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                Requested Items
            </h2>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                <thead>
                    <tr style="background-color: #f1f5f9;">
                        <th style="text-align: left; padding: 12px; border-bottom: 2px solid #e2e8f0;">Product</th>
                        <th style="text-align: center; padding: 12px; border-bottom: 2px solid #e2e8f0;">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">
                                {{ $item->product->name ?? 'Unknown Product' }}</td>
                            <td style="text-align: center; padding: 12px; border-bottom: 1px solid #e2e8f0;">
                                {{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($order->notes)
                <!-- Notes Section -->
                <div
                    style="background-color: #fffbea; border-left: 4px solid #f6ad55; padding: 15px; border-radius: 4px; margin-bottom: 30px;">
                    <h3 style="margin-top: 0; margin-bottom: 10px; font-size: 16px; color: #744210;">Customer Notes:
                    </h3>
                    <p style="margin: 0; color: #744210;">{{ $order->notes }}</p>
                </div>
            @endif

            <!-- Action Button -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('orders.show', $order->id) }}"
                    style="background-color: #2575fc; color: white; padding: 12px 30px; text-decoration: none; border-radius: 4px; font-weight: 600; display: inline-block; letter-spacing: 0.5px; transition: background-color 0.3s;">
                    Review Order
                </a>
            </div>

            <!-- Footer Message -->
            <p
                style="text-align: center; color: #718096; font-size: 14px; border-top: 1px solid #edf2f7; padding-top: 20px; margin-top: 20px;">
                This order will remain pending until approved or rejected by an administrator.
            </p>
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
