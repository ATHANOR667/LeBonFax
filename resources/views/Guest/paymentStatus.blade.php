<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status de Paiement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJjR8u7/5I3vfR6I7fPBAYC0tFhpjLf4owk6yHoFTrR9DaO8cfnHY9g9JAcj" crossorigin="anonymous">
    <style>
        .alert-info {
            background-color: #17a2b8;
            color: white;
        }
        .alert-success {
            background-color: #28a745;
            color: white;
        }
        .alert-danger {
            background-color: #dc3545;
            color: white;
        }
        .alert-warning {
            background-color: #ffc107;
            color: black;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Vérification de Paiement</h4>
                </div>
                <div class="card-body">
                    <!-- Message d'état -->
                    @if(session('status') && session('message'))
                        <div class="alert
                                @if(session('status') == 'success') alert-success
                                @elseif(session('status') == 'error') alert-danger
                                @elseif(session('status') == 'info') alert-info
                                @elseif(session('status') == 'warning') alert-warning
                                @endif">
                            <strong>{{ ucfirst(session('status')) }}: </strong>{{ session('message') }}
                            @if(session('status') == 'success' && session('reference'))
                                <p><strong>Référence de paiement:</strong> {{ session('reference') }}</p>
                            @endif
                            @if(session('status') == 'error' && session('error'))
                                <p><strong>Détails de l'erreur:</strong> {{ session('error') }}</p>
                            @endif
                        </div>
                    @endif

                    @if(session('status') == 'success' && session('reference'))
                        {{--<div class="text-center">
                            <a href="{{ route('home') }}" class="btn btn-primary">Retour à l'accueil</a>
                        </div>--}}
                    @else
                        <div class="text-center">
                            <a href="{{ back() }}" class="btn btn-warning">Réessayer</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybB6CkMxL08b4j5ma7gF28sbw5pV8b8CkzVo6D0xX5w39Bu5I" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0m3LJJhR+YfYhXwE9AdT9FfRjqS+Q1zrbKaqL47nzYviQvM2" crossorigin="anonymous"></script>
</body>
</html>
