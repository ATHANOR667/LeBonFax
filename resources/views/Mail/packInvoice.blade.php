<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'achat - LeBonFax</title>
    <style>
        :root {
            --primary-color: #2A5EE8;
            --secondary-color: #1A365D;
            --accent-color: #48BB78;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background: #f8fafc;
        }

        .container {
            max-width: 680px;
            margin: 2rem auto;
            padding: 2.5rem;
            background: white;
            border-radius: 1.25rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        h2 {
            color: var(--secondary-color);
            font-size: 1.75rem;
            margin: 0 0 1rem;
            font-weight: 700;
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, #3B82F6 100%);
            color: white;
            border-radius: 0.375rem;
            font-weight: 600;
            margin: 1rem auto;
            text-align: center;
        }

        .pack-details {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 0.75rem;
            margin: 2rem 0;
        }

        .certif-list {
            margin: 1rem 0;
        }

        .certif-item {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .certif-item:last-child {
            border-bottom: none;
        }

        .certif-image {
            width: 60px;
            height: 60px;
            border-radius: 0.5rem;
            object-fit: cover;
        }

        .price-breakdown {
            background: white;
            padding: 1.5rem;
            border-radius: 0.75rem;
            margin-top: 1.5rem;
        }

        .price-breakdown p {
            margin: 0.5rem 0;
        }

        .footer {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
            text-align: center;
            font-size: 0.875rem;
            color: #64748b;
        }

        .footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .notice {
            background: #f8fafc;
            padding: 1.25rem;
            border-radius: 0.75rem;
            margin: 2rem 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .notice-icon {
            flex-shrink: 0;
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Merci pour votre achat, M/Mme {{ $payment->nom }} {{ $payment->prenom }} !</h2>
    <div class="badge">Le payement de votre pack :  {{ $pack->nom }} est validé</div>

    <div class="pack-details">
        <h3>Contenu du pack :</h3>
        <div class="certif-list">
            @foreach($pack->certifs as $certif)
                <div class="certif-item">
                    <div>
                        <strong>{{ $certif->nom }}</strong>
                        <p style="margin: 0.25rem 0; color: #64748b;">{{ $certif->description }}</p>
                        <small style="color: #94a3b8;">Catégorie : {{ $certif->categorie }}</small>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="price-breakdown">
            <p>Total avant réduction : {{ number_format($totalAvantReduction, 2, ',', ' ') }} FCFA</p>
            <p>Réduction appliquée :  {{ $pack->reduction }}% (-{{ number_format($totalAvantReduction - $montantReduction, 2, ',', ' ') }} FCFA)</p>
            <p style="font-weight: 700; color: var(--accent-color);">Prix final : {{ number_format($pack->calculerPrix(), 2, ',', ' ') }} FCFA</p>
        </div>
    </div>

    <div class="notice">
        <div class="notice-icon">📄</div>
        <div>
            <p style="margin:0;font-weight:500;">Votre facture PDF est jointe à cet email</p>
            <small style="color:#64748b;">Conservez ce document pour vos dossiers</small>
        </div>
    </div>

    <div class="footer">
        <p>Une question ? <a href="mailto:{{ env('MAIL_SUPPORT') }}">Contactez notre équipe</a></p>
        <p style="margin-top:1rem;font-size:0.75rem;color:#94a3b8;">© {{ date('Y') }} LeBonFax · Tous droits réservés</p>
    </div>
</div>
</body>
</html>
