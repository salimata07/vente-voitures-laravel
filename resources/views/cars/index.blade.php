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