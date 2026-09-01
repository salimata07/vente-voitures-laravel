<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Affiche la liste de toutes les voitures
    public function index(Request $request)
    {
        $query = Car::query();

        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        $cars = $query->latest()->paginate(9)->withQueryString();

        return view('cars.index', compact('cars'));
    }

    // Affiche le formulaire d'ajout
    public function create()
    {
        return view('cars.create');
    }

    // Enregistre une nouvelle voiture
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'fuel_type' => 'required|in:essence,diesel,hybride,électrique',
            'transmission' => 'required|in:manuelle,automatique',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:4096',
        ]);

        $validated['user_id'] = auth()->id();

        $car = Car::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'Voiture ajoutée avec succès !');
    }

    // Affiche le détail d'une voiture
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    // Affiche le formulaire de modification
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    // Met à jour une voiture
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'fuel_type' => 'required|in:essence,diesel,hybride,électrique',
            'transmission' => 'required|in:manuelle,automatique',
            'description' => 'nullable|string',
            'status' => 'required|in:disponible,vendu',
        ]);

        $car->update($validated);

        return redirect()->route('cars.index')->with('success', 'Voiture mise à jour !');
    }

    // Supprime une voiture
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Voiture supprimée !');
    }
}
