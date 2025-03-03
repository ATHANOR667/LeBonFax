<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accusé de réception</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
            height: auto;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        p {
            font-size: 16px;
            margin: 15px 0;
            color: #555;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        strong {
            font-weight: bold;
            color: #3498db;
        }

        .recap {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            margin-top: 20px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 30px;
        }

        .footer a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 14px;
            }

            .logo img {
                max-width: 120px;
            }
        }
    </style>
</head>
<body>
<div class="container">

    <div class="logo">
        <img src="https://via.placeholder.com/150" alt="Logo">
    </div>

    <h1>Merci pour votre message !</h1>

    <p>Bonjour M. {{ $name }},</p>
    <p>Nous avons bien reçu votre message. Voici un récapitulatif :</p>

    <div class="recap">
        <p><strong>Vous avez entendu parler de nous via :</strong> {{ $sujet }}</p>
        <p><strong>Vous nous venez du pays :</strong> {{ $pays }}</p>
        <p><strong>Votre contact est  :</strong> {{ $contact }}</p>
        <p><strong>Votre message était :</strong></p>
        <p>{{ $content }}</p>
    </div>

    <p>Nous vous contacterons sous peu.</p>
    <p>Merci,</p>
    <p>L'équipe.</p>

</div>
</body>
</html>
