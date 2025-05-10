<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Faktur Pesanan #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
        }

        h2 {
            margin-bottom: 0;
        }

        .info {
            margin-top: 5px;
            margin-bottom: 20px;
        }

        .info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }

        .header {
            text-align: center;
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
        }

        .title {
            color: #324c64;
            font-size: 24px;
            font-weight: bold;
        }

        .subtitle {
            color: #666;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- Header Branding -->
    <div class="header">
        <div class="title">TelEatz</div>
        <div class="subtitle">Telkom University</div>
        <small class="">Halimun Raya No.2, Guntur, Setiabudi, Jakarta Selatan. </small>
    </div>

    <h2>Faktur Pesanan</h2>
    <div class="info">
        <p><strong>No. Pesanan:</strong> {{ $order->id }}</p>
        <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
        <p><strong>Pembeli:</strong> {{ $order->buyer->name ?? 'Tidak diketahui' }}</p>
        <p><strong>Metode Pesan:</strong> {{ ucfirst($order->dine_option) }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ ucfirst($order->payment) }}</p>
        <p><strong>Seller:</strong> {{ $order->order_items->first()?->product->user->name ?? '-' }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->order_items as $item)
                <tr>
                    <td>{{ $item->product->nama_product }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total Bayar: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
    <img src="{{ public_path('img/telkom.png') }}" alt="Logo" style="width: 100px; margin-bottom: 20px;">

</body>

</html>
