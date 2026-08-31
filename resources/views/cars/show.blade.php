@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('cars.index') }}" class="btn btn-link mb-3">← Retour aux annonces</a>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="badge bg-{{ $car->status === 'disponible' ? 'success' : 'secondary' }} mb-2">
                        {{ ucfirst($car->status) }}
                    </span>
                    <h2>{{ $car->brand }} {{ $car->model }}</h2>
                </div>
                <h3 class="text-primary">{{ number_format($car->price, 0, ',', ' ') }} MRU</h3>
            </div>

            <hr>

            <div class="row mb-4">
                <div class="col-md-3">
                    <strong>Année</strong><br>{{ $car->year }}
                </div>
                <div class="col-md-3">
                    <strong>Kilométrage</strong><br>{{ number_format($car->mileage) }} km
                </div>
                <div class="col-md-3">
                    <strong>Carburant</strong><br>{{ ucfirst($car->fuel_type) }}
                </div>
                <div class="col-md-3">
                    <strong>Transmission</strong><br>{{ ucfirst($car->transmission) }}
                </div>
            </div>

            @if($car->description)
                <h5>Description</h5>
                <p>{{ $car->description }}</p>
            @endif

            <p class="text-muted small">Publiée par {{ $car->user->name }}</p>

            @auth
                @if(auth()->id() === $car->user_id)
                    <div class="mt-3">
                        <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer cette annonce ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection