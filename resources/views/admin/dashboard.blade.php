@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📊 Dashboard Admin</h2>

    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Total Voitures</h6>
                    <h2>{{ $stats['total_cars'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Disponibles</h6>
                    <h2>{{ $stats['available_cars'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-secondary shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Vendues</h6>
                    <h2>{{ $stats['sold_cars'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Utilisateurs</h6>
                    <h2>{{ $stats['total_users'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-light border">
        <strong>Valeur totale du stock disponible :</strong>
        {{ number_format($stats['total_value'], 0, ',', ' ') }} MRU
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header">Répartition par marque</div>
                <div class="card-body">
                    @forelse($carsByBrand as $item)
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span>{{ $item->brand }}</span>
                                <span>{{ $item->total }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" style="width: {{ ($item->total / $stats['total_cars']) * 100 }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Aucune donnée</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header">Dernières annonces</div>
                <ul class="list-group list-group-flush">
                    @forelse($recentCars as $car)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('cars.show', $car) }}">{{ $car->brand }} {{ $car->model }}</a>
                            <span class="badge bg-{{ $car->status === 'disponible' ? 'success' : 'secondary' }}">
                                {{ ucfirst($car->status) }}
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Aucune annonce</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection