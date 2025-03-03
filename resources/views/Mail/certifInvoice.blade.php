<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Paiement - LeBonFax</title>
    <style>
        :root {
            --primary-color: #2A5EE8;
            --secondary-color: #1A365D;
            --accent-color: #48BB78;
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
            border: 1px solid #e2e8f0;
        }

        .header {
            text-align: center;
            padding-bottom: 1.5rem;
            border-bottom: 3px solid var(--primary-color);
            margin-bottom: 2rem;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--accent-color);
        }

        h2 {
            color: var(--secondary-color);
            font-size: 1.75rem;
            margin: 0 0 1rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, #3B82F6 100%);
            color: white;
            border-radius: 0.375rem;
            font-weight: 600;
            margin: 1rem 0;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 0.75rem;
            margin: 2rem 0;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .detail-icon {
            width: 24px;
            height: 24px;
            color: var(--primary-color);
        }

        .price-tag {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-color);
            background: #f0fff4;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 0.875rem;
            color: #64748b;
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

        @media (max-width: 640px) {
            .container {
                margin: 1rem;
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Merci pour votre confiance, M/Mme {{ $payment->nom }}{{ $payment->prenom }} ! 🎉</h2>
        <div class="badge">Transaction réussie</div>
    </div>

    <p>Votre achat de la certification <strong>{{ $certif->nom }}</strong> a bien été enregistré.</p>

    <div class="detail-grid">
        <div class="detail-item">
            <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
            <div>
                <div>Méthode de paiement</div>
                <strong>{{ $payment->methode }}</strong>
            </div>
        </div>

        <div class="detail-item">
            <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <div>
                <div>Date de transaction</div>
                <strong>{{ $payment->created_at->format('d/m/Y H:i') }}</strong>
            </div>
        </div>
    </div>

    <div class="notice">
        <div class="notice-icon">📄</div>
        <div>
            <p style="margin:0;font-weight:500;">Votre facture PDF est jointe à cet email</p>
            <small style="color:#64748b;">Conservez ce document pour toute réclamation</small>
        </div>
    </div>

    <div class="footer">
        <p>Une question ? <a href="mailto:{{ env('MAIL_SUPPORT') }}" style="color: var(--primary-color); text-decoration: none; font-weight: 500;">Contactez notre équipe</a></p>
        <div style="margin-top:1rem;font-size:0.75rem;color:#94a3b8;">
            © {{ date('Y') }} LeBonFax · Tous droits réservés
        </div>
    </div>
</div>
</body>
</html>
