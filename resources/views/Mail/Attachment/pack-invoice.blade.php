<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Facture {{ $payment->transaction_id }} - LeBonFax</title>
    <style>
        :root {
            --primary-color: #2A5EE8;
            --secondary-color: #1A365D;
            --accent-color: #48BB78;
            --color-cyan-100: #813240;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 2rem;
            color: var(--secondary-color);
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background: white;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid var(--primary-color);
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 24px;
            margin: 0;
            font-weight: 700;
        }

        .company-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-block {
            padding: 1rem;
            background: #f8fafc;
            border-radius: 8px;
        }

        .info-block h3 {
            margin: 0 0 0.5rem;
            font-size: 14px;
            color: var(--primary-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
        }

        .category-header {
            background-color: #f0f4f8;
            font-weight: 700;
            color: var(--secondary-color);
            text-transform: uppercase;
            font-size: 12px;
        }

        .total-row td {
            background-color: #f8fafc;
            font-weight: 700;
            color: var(--accent-color);
        }

        .reduc-row td {
            background-color: #f8fafc;
            font-weight: 700;
            color: var(--color-cyan-100);
        }

        .footer {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
            text-align: center;
            font-size: 10px;
            color: #64748b;
        }

        .certif-image {
            max-width: 80px;
            height: auto;
            border-radius: 4px;
            margin-right: 1rem;
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <div class="header">
        <h1>LeBonFax</h1>
    </div>

    <div class="company-info">
        <div class="info-block">
            <h3>Facture à</h3>
            <p>{{ $payment->prenom }} {{ $payment->nom }}</p>
        </div>
        <div class="info-block">
            <h3>Détails de la facture</h3>
            <p>N°: {{ $payment->transaction_id }}</p>
            <p>Date: {{ $payment->created_at->format('d/m/Y') }}</p>
            <p>Pack : {{ $pack->nom }}</p>
        </div>
        <div class="info-block">
            <h3>Paiement</h3>
            <p>Méthode: {{ $payment->methode }}</p>
            <p>Devise: {{ $payment->devise }}</p>
        </div>
    </div>

    <table>
        <thead>
        <tr>
            <th>Certification</th>
            <th>Description</th>
            <th>Catégorie</th>
            <th>Prix unitaire</th>
        </tr>
        </thead>
        <tbody>
        @php
            // Grouper les certificats par catégorie
            $groupedCertifs = $pack->certifs->groupBy('categorie');
        @endphp

        @foreach($groupedCertifs as $categorie => $certifs)
            <tr class="category-header">
                <td colspan="5">{{ $categorie }}</td>
            </tr>
            @foreach($certifs as $certif)
                <tr>
                    <td><strong>{{ $certif->nom }}</strong></td>
                    <td>{{ $certif->description }}</td>
                    <td>{{ $certif->categorie }}</td>
                    <td>{{ number_format($certif->prix, 2, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
        @endforeach

        <tr class="reduc-row">
            <td colspan="3">Total avant réduction</td>
            <td>{{ number_format($totalAvantReduction, 2, ',', ' ') }} FCFA</td>
        </tr>
        <tr class="reduc-row">
            <td colspan="3">Réduction appliquée</td>
            <p>Réduction appliquée : {{ $pack->reduction }}% (-{{ number_format($totalAvantReduction - $montantReduction, 2, ',', ' ') }} FCFA)</p>        </tr>
        <tr class="total-row">
            <td colspan="3">Total TTC</td>
            <td>{{ number_format($pack->calculerPrix(), 2, ',', ' ') }} FCFA</td>
        </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Cette facture est établie électroniquement et vaut preuve d'achat.</p>
        <p>En cas de question: <a href="mailto:{{ env('MAIL_SUPPORT') }}">contact@lebonfax.com</a></p>
    </div>
</div>
</body>
</html>
