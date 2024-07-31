<!-- resources/views/emails/task_updated.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Updated Notification</title>
 <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .footer {
            font-size: 0.9em;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dear {{ $userName }},</h1>
        <p>We wanted to inform you that a task has been updated in your task management system.</p>

        <p><strong>Task Details:</strong></p>
        <p>
            <strong>Task Name:</strong> {{ $taskName }}<br>
            <strong>Update Date:</strong> {{ $updateDate }}<br>
        </p>

        <p>If you have any questions or need further assistance, please feel free to reach out to us.</p>

        <p>Thank you for using our task management system!</p>

        <p class="footer">Best regards,<br>ListEase</p>
    </div>
</body>
</html>
