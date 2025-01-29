<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture - {{ $reference }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .header, .footer {
            text-align: center;
            margin: 20px 0;
        }
        .details {
            margin-top: 30px;
            width: 100%;
            border-collapse: collapse;
        }
        .details td, .details th {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .details th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Facture</h2>
        <p>Référence de paiement : {{ $reference }}</p>
    </div>

    <div class="details">
        <table style="width: 100%">
            <tr>
                <th>Nom du Client</th>
                <th>{{ $prenom }} {{ $nom }}</th>
            </tr>
            <tr>
                <th>Nom du Pack</th>
                <td>{{ $pack->nom }}</td>
            </tr>
            <tr>
                <th>Prix</th>
                <td>{{ number_format($pack->prix, 2, ',', ' ') }} FCFA</td>
            </tr>
            <tr>
                <th>Référence de Paiement</th>
                <td>{{ $reference }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Merci pour votre achat !</p>
    </div>
</div>
</body>
</html>
