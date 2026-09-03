<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; font-size: 14px; }
        .header { text-align: center; border-bottom: 3px solid #0d6efd; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { color: #0d6efd; margin: 0; }
        .info-box { display: table; width: 100%; margin-bottom: 30px; }
        .info-left, .info-right { display: table-cell; width: 50%; vertical-align: top; }
        table.items { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        table.items th { background: #0d6efd; color: white; padding: 10px; text-align: left; }
        table.items td { padding: 10px; border-bottom: 1px solid #ddd; }
        .total-row { font-size: 18px; font-weight: bold; }
        .footer { margin-top: 50px; text-align: center; color: #888; font-size: 12px; }
        .status-paid { color: #198754; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🚗 VenteVoitures</h1>
        <p>Facture officielle</p>
    </div>

    <div class="info-box">
        <div class="info-left">
            <strong>Facture N° :</strong> {{ $order->invoice_number }}<br>
            <strong>Date :</strong> {{ $order->created_at->format('d/m/Y') }}<br>
            <strong>Statut :</strong> <span class="status-paid">{{ ucfirst($order->payment_status) }}</span>
        </div>
        <div class="info-right">
            <strong>Acheteur :</strong> {{ $order->buyer->name }}<br>
            <strong>Email :</strong> {{ $order->buyer->email }}<br>
            <strong>Vendeur :</strong> {{ $order->car->user->name }}
        </div>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Description</th>
                <th>Année</th>
                <th>Kilométrage</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order->car->brand }} {{ $order->car->model }}</td>
                <td>{{ $order->car->year }}</td>
                <td>{{ number_format($order->car->mileage) }} km</td>
                <td>{{ number_format($order->amount, 0, ',', ' ') }} MRU</td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">Total</td>
                <td>{{ number_format($order->amount, 0, ',', ' ') }} MRU</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Merci pour votre confiance — VenteVoitures<br>
        Cette facture a été générée automatiquement.
    </div>
</body>
</html>