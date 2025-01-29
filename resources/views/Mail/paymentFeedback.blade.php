<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Paiement</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
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
        h2 {
            color: #2c3e50;
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 700;
        }
        p {
            color: #555;
            font-size: 16px;
            margin: 15px 0;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        .details {
            margin-top: 25px;
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
        }
        .details h4 {
            color: #2c3e50;
            font-size: 20px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .details p {
            margin: 10px 0;
            font-size: 16px;
        }
        .price {
            font-weight: bold;
            color: #3498db;
            font-size: 18px;
        }
        .highlight {
            color: #3498db;
            font-weight: bold;
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
    </style>
</head>
<body>
<div class="container">
    <h2>Merci pour votre achat, {{ $prenom }} {{ $nom }} !</h2>
    <p>Nous vous remercions pour votre paiement. Vous avez acheté le pack <strong class="highlight">{{ $pack->nom }}</strong>.</p>
    <p>Votre référence de paiement est : <strong class="highlight">{{ $reference }}</strong></p>

    <div class="details">
        <h4>Détails de votre commande :</h4>
        <p><strong>Nom du Pack:</strong> {{ $pack->nom }}</p>
        <p><strong>Prix:</strong> <span class="price">{{ number_format($pack->prix, 2, ',', ' ') }} FCFA</span></p>
        <p><strong>Référence de paiement:</strong> {{ $reference }}</p>
    </div>

    <div class="footer">
        <p>Nous vous remercions de votre confiance et espérons vous satisfaire pleinement.</p>
        <p>Si vous avez des questions, n'hésitez pas à <a href="mailto:support@votreentreprise.com">nous contacter</a>.</p>
    </div>
</div>
</body>
</html>
