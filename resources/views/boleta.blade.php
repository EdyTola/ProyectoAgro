<x-layouts.app :title="__('Boleta')">
    <div class="p-6 bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen flex flex-col items-center justify-start">
        <div class="w-full max-w-2xl mx-auto">
            <div class="boleta-header">
                <div class="logo">
                    <img src="{{ asset('images/logo-riccharly.png') }}" alt="Riccharly Huami Logo">
                    <div class="empresa">Riccharly Huami</div>
                </div>
            </div>
            <div class="boleta-title">Boleta Electrónica</div>
            <div class="boleta-subtitle">Documento tributario para sus registros</div>
            <div class="boleta-info">
                <div class="left">
                    <div>RUT: 76.543.210-8</div>
                    <div>Av. Providencia 1234, Santiago</div>
                    <div>contacto@comercialSantiago.cl</div>
                </div>
                <div class="right">
                    BOLETA ELECTRÓNICA<br>
                    N° 00123456<br>
                    Fecha: 15/06/2023
                </div>
            </div>
            <div class="boleta-info" style="margin-bottom: 0;">
                <div class="left">
                    <strong>Cliente:</strong><br>
                    <strong>RUT Cliente:</strong><br>
                    <strong>Forma de Pago:</strong>
                </div>
                <div class="right" style="border:none;"></div>
            </div>
            <table class="boleta-table">
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
                            <td colspan="4" class="text-center">No hay productos en la boleta.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="boleta-totals">
                @php
                    $subtotal = $cartItems->sum(function($item) { return $item->quantity * $item->price_at_purchase; });
                    $iva = $subtotal * 0.19;
                    $total = $subtotal + $iva;
                @endphp
                <span><strong>Subtotal:</strong> S/ {{ number_format($subtotal, 2) }}</span>
                <span><strong>IVA (19%):</strong> S/ {{ number_format($iva, 2) }}</span>
                <span style="font-size:1.2rem;"><strong>TOTAL:</strong> S/ {{ number_format($total, 2) }}</span>
            </div>
            <div class="boleta-actions">
                <form action="{{ route('boleta.store') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="guardar">Guardar Boleta</button>
                </form>
                <form action="{{ route('boleta.imprimir') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="imprimir">Imprimir Boleta</button>
                </form>
                <a href="{{ route('boleta.pdf') }}" class="pdf">Descargar PDF</a>
                <button class="email">Enviar por Email</button>
            </div>
        </div>
    </div>
    <style>
        .boleta-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 4px solid #837227;
            padding-bottom: 12px;
            margin-bottom: 24px;
        }
        .boleta-header .logo {
            display: flex;
            align-items: center;
        }
        .boleta-header .logo img {
            height: 48px;
            margin-right: 16px;
        }
        .boleta-header .empresa {
            font-weight: bold;
            color: #837227;
            font-size: 1.2rem;
        }
        .boleta-title {
            text-align: center;
            margin-bottom: 8px;
            font-size: 2rem;
            font-weight: bold;
            color: #222;
        }
        .boleta-subtitle {
            text-align: center;
            color: #888;
            margin-bottom: 24px;
        }
        .boleta-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .boleta-info .left {
            color: #444;
            font-size: 0.95rem;
        }
        .boleta-info .right {
            border: 2px solid #837227;
            border-radius: 8px;
            padding: 8px 24px;
            color: #837227;
            font-weight: bold;
            text-align: center;
            font-size: 1rem;
        }
        .boleta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }
        .boleta-table th, .boleta-table td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: left;
        }
        .boleta-table th {
            background: #837227;
            color: #fff;
            font-weight: bold;
        }
        .boleta-table td {
            background: #faf9f6;
        }
        .boleta-totals {
            text-align: right;
            margin-bottom: 24px;
        }
        .boleta-totals span {
            display: block;
            margin-bottom: 4px;
        }
        .boleta-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
        }
        .boleta-actions button,.boleta-actions .pdf {
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .boleta-actions .guardar {
            background: #bdb76b;
            color: #fff;
        }
        .boleta-actions .guardar:hover {
            background: #a89c4a;
        }
        .boleta-actions .imprimir {
            background: #3a7d2c;
            color: #fff;
        }
        .boleta-actions .imprimir:hover {
            background: #2e5e22;
        }
        .boleta-actions .pdf {
            background: #837227;
            color: #fff;
            text-decoration: none;
            display: inline-block;
            border
        }
        .boleta-actions .pdf:hover {
            background: #6b5a1a;
        }
        .boleta-actions .email {
            background: #e0e0e0;
            color: #444;
        }
        .boleta-actions .email:hover {
            background: #bdbdbd;
        }
    </style>
</x-layouts.app>
