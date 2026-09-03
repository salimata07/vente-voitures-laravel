@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('cars.index') }}" class="btn btn-link mb-3">← Retour aux annonces</a>
        @if($car->images->count())
        <div id="carCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner rounded shadow-sm">
                @foreach($car->images as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" style="height: 400px; object-fit: cover;">
                    </div>
                @endforeach
            </div>
            @if($car->images->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#carCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            @endif
        </div>
    @endif

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
                @elseif($car->status === 'disponible')
                    <form action="{{ route('orders.store', $car) }}" method="POST" class="mt-3"
                          onsubmit="return confirm('Confirmer l\'achat de cette voiture ?');">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">💳 Acheter maintenant</button>
                    </form>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection