<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Code OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
            width: 100%;
            max-width: 600px;
        }

        .card-header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 12px 12px 0 0;
        }

        .card-header h3 {
            margin: 0;
            font-weight: 700;
            font-size: 24px;
        }

        .card-body {
            padding: 30px;
        }

        .otp-code {
            font-size: 50px;
            font-weight: bold;
            color: #3498db;
            margin: 20px 0;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .footer-text {
            font-size: 14px;
            color: #777;
            text-align: center;
            margin-top: 20px;
        }

        .footer-text a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-text a:hover {
            color: #2980b9;
            text-decoration: underline;
        }
        h3 {
            text-align: justify;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header text-center text-white">
            <h3>Votre Code OTP</h3>
        </div>

        <div class="card-body">
            <p>Bonjour,</p>
            <p>Voici votre code OTP pour vérifier votre identité :</p>

            <h1 class="text-center otp-code">
                {{ $otp }}
            </h1>

            <p class="text-center">Entrez ce code pour continuer votre processus de vérification.</p>

            <p>Cordialement,</p>
            <p>L'équipe de Lebonfax</p>
        </div>
    </div>

    <div class="footer-text">
        <p>Si vous n'avez pas demandé ce code, veuillez ignorer cet e-mail ou <a href="">contacter le support</a>.</p>
    </div>
</div>
</body>
</html>
