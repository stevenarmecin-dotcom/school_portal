<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login & Registration</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: flex-end; /* Moves container to the right */
            align-items: center;
            background-image:
                linear-gradient(135deg, rgba(21, 101, 192, .7), rgba(66, 165, 245, .7)),
                url('{{ asset("asset/keyboard.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 20px 80px 20px 20px; /* Extra space on the right */
        }

        main {
            width: 100%;
            max-width: 430px;
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            border-top: 6px solid #FFC107;
        }

        main.dashboard-layout {
            max-width: 1180px;
        }

        h1,
        h2 {
            text-align: center;
            color: #1565C0;
            margin-bottom: 12px;
            font-weight: 700;
        }

        p {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 2px solid #BBDEFB;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            background: #F8FBFF;
            transition: 0.3s;
        }

        input:focus {
            border-color: #1565C0;
            box-shadow: 0 0 10px rgba(21, 101, 192, 0.2);
        }

        button {
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #FFC107;
            color: #0D47A1;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #FFD54F;
            transform: translateY(-2px);
        }

        a {
            color: #1565C0;
            font-weight: 600;
            text-decoration: none;
        }

        a:hover {
            color: #0D47A1;
            text-decoration: underline;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 13px;
        }

        .error {
            color: #D32F2F;
            font-size: 13px;
            margin-top: -8px;
        }

        /* Center the card on small screens */
        @media (max-width: 600px) {
            body {
                justify-content: center;
                padding: 20px;
            }

            main {
                padding: 28px;
            }
        }
    </style>
</head>

<body>
    <main @class(['dashboard-layout' => request()->routeIs('dashboard')])>
        {{ $slot }}
    </main>
</body>
</html>