<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_cars' => Car::count(),
            'available_cars' => Car::where('status', 'disponible')->count(),
            'sold_cars' => Car::where('status', 'vendu')->count(),
            'total_users' => User::count(),
            'total_value' => Car::where('status', 'disponible')->sum('price'),
        ];

        $recentCars = Car::latest()->take(5)->get();

        $carsByBrand = Car::selectRaw('brand, count(*) as total')
            ->groupBy('brand')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentCars', 'carsByBrand'));
    }
}
