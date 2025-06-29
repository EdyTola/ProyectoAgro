<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Boleta Electrónica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #837227;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .empresa {
            font-size: 18px;
            font-weight: bold;
            color: #837227;
            margin-bottom: 5px;
        }
        .boleta-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .boleta-subtitle {
            color: #666;
            font-size: 11px;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .info-left {
            width: 50%;
        }
        .info-right {
            width: 45%;
            border: 1px solid #837227;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            color: #837227;
        }
        .cliente-info {
            margin-bottom: 15px;
        }
        .cliente-info strong {
            display: inline-block;
            width: 120px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #837227;
            color: white;
            font-weight: bold;
        }
        .totals {
            text-align: right;
            margin-bottom: 20px;
        }
        .totals span {
            display: block;
            margin-bottom: 5px;
        }
        .total-final {
            font-size: 14px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="empresa">Riccharly Huami</div>
        <div class="boleta-title">Boleta Electrónica</div>
        <div class="boleta-subtitle">Documento tributario para sus registros</div>
    </div>

    <div class="info-section">
        <div class="info-row">
            <div class="info-left">
                <div>RUT: 76.543.210-8</div>
                <div>Av. Providencia 1234, Santiago</div>
<<<<<<< HEAD
                <div>contacto@comercialSantiago.cl</div>
=======
<<<<<<< HEAD
                <div>contacto@comercialSantiago.cl</div>
=======
                <div>contacto@riccharlyhuami.cl</div>
>>>>>>> 85c14eef84e259704571025b118ad81ff111bb3f
>>>>>>> 86a17ae0358a35db8b35923fc16fb784ba8f0c55
            </div>
            <div class="info-right">
                BOLETA ELECTRÓNICA<br>
                N° {{ $numeroBoleta }}<br>
                Fecha: {{ $fecha }}
            </div>
        </div>
    </div>

    <div class="cliente-info">
        <div><strong>Cliente:</strong> {{ $cliente }}</div>
        <div><strong>RUT Cliente:</strong> {{ $rutCliente }}</div>
        <div><strong>Forma de Pago:</strong> Efectivo</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>S/ {{ number_format($item->price_at_purchase, 2) }}</td>
                    <td>S/ {{ number_format($item->quantity * $item->price_at_purchase, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No hay productos en la boleta.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="totals">
        <span><strong>Subtotal:</strong> S/ {{ number_format($subtotal, 2) }}</span>
        <span><strong>IVA (19%):</strong> S/ {{ number_format($iva, 2) }}</span>
        <span class="total-final"><strong>TOTAL:</strong> S/ {{ number_format($total, 2) }}</span>
    </div>

    <div class="footer">
        <p>¡Gracias por su compra!</p>
<<<<<<< HEAD
        <p>Este documento es una representación impresa de una boleta electrónica</p>
        <p>Riccharly Huami - Todos los derechos reservados</p>
=======
<<<<<<< HEAD
        <p>Este documento es una representación impresa de una boleta electrónica</p>
        <p>Riccharly Huami - Todos los derechos reservados</p>
=======
        <p>Riccharly Huami - @Todos los derechos reservados</p>
>>>>>>> 85c14eef84e259704571025b118ad81ff111bb3f
>>>>>>> 86a17ae0358a35db8b35923fc16fb784ba8f0c55
    </div>
</body>
</html>
