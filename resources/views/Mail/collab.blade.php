<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #389ad5;
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 600;
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
            color: #333;
        }

        .divider {
            border-top: 1px solid #e0e0e0;
            margin: 20px 0;
        }

        .content {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            margin-top: 10px;
            word-wrap: break-word;
            overflow-wrap: break-word;
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
                word-wrap: break-word;
                overflow-wrap: break-word;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Nouveau message</h1>

    <p><strong>Expéditeur :</strong> {{ $name }}</p>
    <p><strong>Source de la prise de contact :</strong> {{ $sujet }}</p>

    <div class="divider"></div>

    <p><strong>Message :</strong></p>
    <div class="content">
        <p>{{ $content }}</p>
    </div>
</div>
</body>
</html>
