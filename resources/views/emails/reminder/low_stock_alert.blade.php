<!-- filepath: c:\Users\zulfaris\Desktop\project ukm\marcomm\resources\views\emails\low-stock-alert.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Low Stock Alert</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .low-stock {
            color: #dc3545;
            font-weight: bold;
        }

        .action-button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>⚠️ Low Stock Alert</h1>
            <p>The following products are currently low in stock and require attention.</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Current Stock</th>
                    <th>Min Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lowStockProducts as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                        <td class="low-stock">{{ $product->total_quantity }}</td>
                        <td>{{ $product->stock ? $product->stock->alert_quantity : 5 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>Please take action to restock these items as soon as possible to avoid inventory shortages.</p>

        <a href=" route('admin.low-stocks') }}" class="action-button">View Low Stock Products</a>

        <p>This is an automated notification from the MarComm System.</p>
    </div>
</body>

</html>
