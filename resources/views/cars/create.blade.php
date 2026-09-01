@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Ajouter une voiture</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Marque</label>
                <input type="text" name="brand" class="form-control" value="{{ old('brand') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Modèle</label>
                <input type="text" name="model" class="form-control" value="{{ old('model') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Année</label>
                <input type="number" name="year" class="form-control" value="{{ old('year') }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Prix (MRU)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Kilométrage</label>
                <input type="number" name="mileage" class="form-control" value="{{ old('mileage') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Carburant</label>
                <select name="fuel_type" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <option value="essence">Essence</option>
                    <option value="diesel">Diesel</option>
                    <option value="hybride">Hybride</option>
                    <option value="électrique">Électrique</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Transmission</label>
                <select name="transmission" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <option value="manuelle">Manuelle</option>
                    <option value="automatique">Automatique</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

                <div class="mb-3">
            <label class="form-label">Photos (plusieurs possibles)</label>
            <input type="file" name="images[]" class="form-control" multiple accept="image/*">
            <small class="text-muted">Formats acceptés : JPG, PNG. Tu peux sélectionner plusieurs fichiers.</small>
        </div>

        <button type="submit" class="btn btn-primary">Publier l'annonce</button>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection