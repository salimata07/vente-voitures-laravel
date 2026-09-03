<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Créer une commande (achat)
    public function store(Car $car)
    {
        if ($car->status === 'vendu') {
            return back()->with('error', 'Cette voiture a déjà été vendue.');
        }

        $order = Order::create([
            'car_id' => $car->id,
            'buyer_id' => auth()->id(),
            'invoice_number' => 'FAC-' . strtoupper(uniqid()),
            'amount' => $car->price,
            'payment_status' => 'payé',
        ]);

        $car->update(['status' => 'vendu']);

        return redirect()->route('orders.invoice', $order)->with('success', 'Achat confirmé !');
    }

    // Afficher/télécharger la facture PDF
    public function invoice(Order $order)
    {
        $pdf = Pdf::loadView('orders.invoice', compact('order'));
        return $pdf->stream('facture-' . $order->invoice_number . '.pdf');
    }
}
