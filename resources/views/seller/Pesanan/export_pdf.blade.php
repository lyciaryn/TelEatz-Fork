<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            margin: 40px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }
        .header-left h2 {
            margin: 0;
        }
        .header-right {
            text-align: right;
        }
        .metadata {
            margin-top: 10px;
        }
        .metadata p {
            margin: 2px;
        }
        .total {
            font-size: 16px;
            font-weight: bold;
            color: #003366;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            color: #333;
        }
        th, td {
            padding: 8px 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        thead {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="header-left">
            <h2>Histori Pesanan</h2>
            <div class="metadata">
                <p><strong>ID:</strong> {{ $order->id }}</p>
                <p><strong>Tanggal:</strong> {{ $order->created_at }}</p>
                <p><strong>Pembeli:</strong> {{ $order->buyer->name }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Metode Bayar:</strong> {{ ucfirst($order->payment) }}</p>
                <p><strong>Dine Option:</strong> {{ ucfirst($order->dine_option) }}</p>
            </div>
        </div>
        <div class="header-right">
            <p class="total">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
        </div>
    </div>

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

</body>
</html>
