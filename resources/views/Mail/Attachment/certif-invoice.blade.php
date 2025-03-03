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

        .header p {
            margin: 0.5rem 0 0;
            color: #64748b;
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

        .total-row td {
            background-color: #f8fafc;
            font-weight: 700;
            color: var(--accent-color);
        }

        .footer {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
            text-align: center;
            font-size: 10px;
            color: #64748b;
        }

        .footer a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .certif-image {
            max-width: 100px;
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
        {{--<p>36 Rue du Digital, 75012 Paris</p>
        <p>TVA Intracommunautaire: FR12345678901</p>--}}
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
            <th>Désignation</th>
            <th>Prix unitaire</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <div style="display: flex; align-items: center;">
                    @if($certif->image)
                        <img src="{{ $certif->image }}" alt="{{ $certif->nom }}" class="certif-image">
                    @endif
                    <div>
                        <strong>{{ $certif->nom }}</strong>
                        <p style="margin: 0.25rem 0 0; color: #64748b;">{{ $certif->description }}</p>
                    </div>
                </div>
            </td>
            <td>{{ number_format($certif->prix, 2, ',', ' ') }} FCFA</td>
        </tr>
        <tr class="total-row">
            <td>Total TTC</td>
            <td>{{ number_format($certif->prix, 2, ',', ' ') }} FCFA</td>
        </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Cette facture est établie électroniquement et vaut preuve d'achat.</p>
        <p>En cas de question: <a href="mailto:{{ env('MAIL_SUPPORT') }}">contact@lebonfax.com</a></p>
        <p style="margin-top: 1rem;">© {{ date('Y') }} LeBonFax · Tous droits réservés</p>
    </div>
</div>
</body>
</html>
