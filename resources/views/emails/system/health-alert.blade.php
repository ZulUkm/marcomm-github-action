<!-- filepath: c:\Users\zulfaris\Desktop\project ukm\marcomm\resources\views\emails\system\health-alert.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>System Health Alert</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #f44336;
            color: white;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            border-radius: 5px 5px 0 0;
        }

        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }

        ul {
            background-color: #f9f9f9;
            padding: 15px 15px 15px 40px;
            border-left: 4px solid #f44336;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="header">
        System Health Alert
    </div>
    <div class="content">
        <p>The system health check has detected the following issues:</p>

        <ul>
            @foreach ($issues as $issue)
                <li>{{ $issue }}</li>
            @endforeach
        </ul>

        <p>Please address these issues as soon as possible to ensure system stability.</p>
    </div>
    <div class="footer">
        This is an automated message from {{ config('app.name') }} monitoring system.
        Generated on {{ now()->format('Y-m-d H:i:s') }}
    </div>
</body>

</html>
