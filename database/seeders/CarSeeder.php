<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()->id;

        $cars = [
            ['brand' => 'BMW', 'model' => 'X5', 'year' => 2021, 'price' => 850000, 'mileage' => 30000, 'fuel_type' => 'diesel', 'transmission' => 'automatique', 'description' => 'SUV puissant et confortable, très bien entretenu.'],
            ['brand' => 'Mercedes', 'model' => 'Classe C', 'year' => 2019, 'price' => 620000, 'mileage' => 55000, 'fuel_type' => 'essence', 'transmission' => 'automatique', 'description' => 'Berline élégante, intérieur cuir.'],
            ['brand' => 'Toyota', 'model' => 'Hilux', 'year' => 2022, 'price' => 950000, 'mileage' => 15000, 'fuel_type' => 'diesel', 'transmission' => 'manuelle', 'description' => 'Pick-up robuste, idéal tout-terrain.'],
            ['brand' => 'Hyundai', 'model' => 'Tucson', 'year' => 2020, 'price' => 480000, 'mileage' => 40000, 'fuel_type' => 'essence', 'transmission' => 'automatique', 'description' => 'SUV compact, faible consommation.'],
            ['brand' => 'Kia', 'model' => 'Sportage', 'year' => 2018, 'price' => 350000, 'mileage' => 70000, 'fuel_type' => 'essence', 'transmission' => 'manuelle', 'description' => 'Bon état général, entretien à jour.'],
            ['brand' => 'Toyota', 'model' => 'Land Cruiser', 'year' => 2023, 'price' => 1200000, 'mileage' => 8000, 'fuel_type' => 'diesel', 'transmission' => 'automatique', 'description' => 'Comme neuf, garantie constructeur.'],
            ['brand' => 'Renault', 'model' => 'Duster', 'year' => 2019, 'price' => 280000, 'mileage' => 60000, 'fuel_type' => 'essence', 'transmission' => 'manuelle', 'description' => 'Voiture familiale économique et fiable.'],
            ['brand' => 'Nissan', 'model' => 'Qashqai', 'year' => 2021, 'price' => 420000, 'mileage' => 25000, 'fuel_type' => 'hybride', 'transmission' => 'automatique', 'description' => 'Hybride économique, très peu de kilomètres.'],
        ];

        foreach ($cars as $car) {
            Car::create(array_merge($car, ['user_id' => $userId, 'status' => 'disponible']));
        }
    }
}
