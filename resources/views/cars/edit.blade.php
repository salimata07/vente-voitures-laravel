@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Modifier l'annonce</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cars.update', $car) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Marque</label>
                <input type="text" name="brand" class="form-control" value="{{ old('brand', $car->brand) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Modèle</label>
                <input type="text" name="model" class="form-control" value="{{ old('model', $car->model) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Année</label>
                <input type="number" name="year" class="form-control" value="{{ old('year', $car->year) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Prix (MRU)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $car->price) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Kilométrage</label>
                <input type="number" name="mileage" class="form-control" value="{{ old('mileage', $car->mileage) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Carburant</label>
                <select name="fuel_type" class="form-select" required>
                    @foreach(['essence', 'diesel', 'hybride', 'électrique'] as $type)
                        <option value="{{ $type }}" {{ old('fuel_type', $car->fuel_type) === $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Transmission</label>
                <select name="transmission" class="form-select" required>
                    @foreach(['manuelle', 'automatique'] as $type)
                        <option value="{{ $type }}" {{ old('transmission', $car->transmission) === $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Statut</label>
                <select name="status" class="form-select" required>
                    @foreach(['disponible', 'vendu'] as $s)
                        <option value="{{ $s }}" {{ old('status', $car->status) === $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $car->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('cars.show', $car) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection