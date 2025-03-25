<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blade Mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .content {
            padding: 20px 0;
        }

        .content h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #ddd;
            font-size: 14px;
            color: #777;
        }

        .footer a {
            color: #007BFF;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Blade Mail</h1>
        </div>

        <div class="content">
            <h2>Welcome to Blade Mail</h2>
            <p>
                Thank you for choosing Blade Mail for your communication needs. We are committed to providing you with the best service and support.
            </p>
            <p>
                If you have any questions or need assistance, please feel free to contact us at <a href="mailto:support@blademail.com">support@blademail.com</a>.
            </p>

            <table>
                <tr>
                    <th>id</th>
                    <th>name</th>
                </tr>
                @forelse ($users as $user )
                <tr>
                    <th>{{$user->id}}</th>
                    <th>{{$user->name}}</th>
                   
                </tr>
                @empty
                    
                @endforelse
            </table>
        </div>


        <div class="footer">
            <p>&copy; 2023 Blade Mail. All rights reserved.</p>
            <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </div>
</body>
</html>