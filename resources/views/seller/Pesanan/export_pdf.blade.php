<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan #{{ $order->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px; border: 1px solid #ccc; text-align: left; }
    </style>
</head>
<body>
    <h2>Histori Pesanan</h2>
    <p><strong>ID:</strong> {{ $order->id }}</p>
    <p><strong>Tanggal:</strong> {{ $order->created_at }}</p>
    <p><strong>Pembeli:</strong> {{ $order->buyer->name }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Metode Bayar:</strong> {{ ucfirst($order->payment) }}</p>
    <p><strong>Dine Option:</strong> {{ ucfirst($order->dine_option) }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->order_items as $item)
            <tr>
                <td>{{ $item->product->nama_product }}</td>
                <td>Rp {{ number_format($item->product->harga, 0, ',', '.') }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 20px;"><strong>Total:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
</body>
</html>
