<!-- resources/views/users/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show Logging Activity</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .log-entry {
            background-color: #fafafa;
            border-left: 4px solid #4CAF50;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .log-entry:hover {
            background-color: #e8f5e9;
        }

        .log-entry p {
            margin: 5px 0;
            color: #555;
        }

        .log-entry .causer {
            font-weight: bold;
            color: #333;
        }

        .log-entry .action {
            color: #4CAF50;
            font-style: italic;
        }

        .log-entry .timestamp {
            font-size: 12px;
            color: #999;
            text-align: right;
        }

    </style>
</head>
<body>

<div class="container">
        <h1>Activity Logs</h1>

        @foreach($logs as $log)
            <div class="log-entry">
            <p>
            @if($log->causer)
                <span class="causer">{{ $log->causer->name }}</span>
            @else
                <span class="causer">Anonymous</span>
            @endif
            performed the action: <span class="action">{{ $log->description }}</span>
        </p>
        <p class="timestamp">{{ $log->created_at->format('F j, Y, g:i a') }}</p>
            </div>
        @endforeach
    </div>

</body>
</html>
