@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🚗 Nos Voitures</h2>
        @auth
            <a href="{{ route('cars.create') }}" class="btn btn-primary">+ Ajouter une voiture</a>
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

        <form method="GET" action="{{ route('cars.index') }}" class="card p-3 mb-4 shadow-sm">
        <div class="row g-2">
            <div class="col-md-3">
                <input type="text" name="brand" class="form-control" placeholder="Marque " value="{{ request('brand') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="min_price" class="form-control" placeholder="Prix min" value="{{ request('min_price') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="max_price" class="form-control" placeholder="Prix max" value="{{ request('max_price') }}">
            </div>
            <div class="col-md-3">
                <select name="fuel_type" class="form-select">
                    <option value="">Tous les carburants</option>
                    <option value="essence" {{ request('fuel_type') === 'essence' ? 'selected' : '' }}>Essence</option>
                    <option value="diesel" {{ request('fuel_type') === 'diesel' ? 'selected' : '' }}>Diesel</option>
                    <option value="hybride" {{ request('fuel_type') === 'hybride' ? 'selected' : '' }}>Hybride</option>
                    <option value="électrique" {{ request('fuel_type') === 'électrique' ? 'selected' : '' }}>Électrique</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filtrer</button>
            </div>
        </div>
    </form>

    <div class="row">
        @forelse($cars as $car)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($car->images->first())
                        <img src="{{ asset('storage/' . $car->images->first()->path) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">Pas de photo</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <span class="badge bg-{{ $car->status === 'disponible' ? 'success' : 'secondary' }} mb-2">
                            {{ ucfirst($car->status) }}
                        </span>
                        <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                        <p class="card-text text-muted">{{ $car->year }} • {{ number_format($car->mileage) }} km</p>
                        <p class="card-text fw-bold fs-5">{{ number_format($car->price, 0, ',', ' ') }} MRU</p>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-outline-primary btn-sm">Voir détails</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Aucune voiture disponible pour le moment.</p>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $cars->links() }}
    </div>
</div>
@endsection