@extends('layouts.app')

@section('content')
<div class="bg-primary text-white text-center py-5 mb-5 rounded">
    <div class="container">
        <h1 class="display-4 fw-bold">🚗 VenteVoitures</h1>
        <p class="lead">La plateforme mauritanienne pour acheter et vendre des voitures d'occasion</p>
        <a href="{{ route('cars.index') }}" class="btn btn-light btn-lg mt-3">Voir les annonces</a>
        @guest
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg mt-3">Créer un compte</a>
        @endguest
    </div>
</div>

<div class="container">
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <h3>🔍</h3>
            <h5>Recherche facile</h5>
            <p class="text-muted">Filtrez par marque, prix et carburant pour trouver la voiture idéale.</p>
        </div>
        <div class="col-md-4">
            <h3>📸</h3>
            <h5>Photos réelles</h5>
            <p class="text-muted">Consultez plusieurs photos de chaque véhicule avant de contacter le vendeur.</p>
        </div>
        <div class="col-md-4">
            <h3>✅</h3>
            <h5>Simple et rapide</h5>
            <p class="text-muted">Publiez votre annonce en quelques minutes, gratuitement.</p>
        </div>
    </div>

    <h3 class="mb-4">Dernières annonces</h3>
    <div class="row">
        @forelse($latestCars ?? [] as $car)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($car->images->first())
                        <img src="{{ asset('storage/' . $car->images->first()->path) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                            <span class="text-muted">Pas de photo</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                        <p class="fw-bold">{{ number_format($car->price, 0, ',', ' ') }} MRU</p>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-outline-primary btn-sm">Voir détails</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Aucune annonce pour le moment.</p>
        @endforelse
    </div>
</div>
@endsection