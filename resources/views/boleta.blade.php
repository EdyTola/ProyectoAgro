<x-layouts.app :title="__('Boleta')">
    <div class="p-6 bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen flex flex-col items-center justify-start">
        <div class="w-full max-w-2xl mx-auto boleta-container">
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
                    <div>contacto@riccharlyhuami.cl</div>
                </div>
                <div class="right">
                    BOLETA ELECTRÓNICA<br>
                    N° {{ $numeroBoleta ?? 'N/A' }}<br>
                    Fecha: {{ $fecha ?? 'N/A' }}
                </div>
            </div>
            <div class="boleta-info" style="margin-bottom: 0;">
                <div class="left">
                    {{-- Mostrar datos del cliente desde el controlador --}}
                    <strong>Cliente:</strong> {{ $cliente ?? 'N/A' }}<br>
                    <strong>RUT Cliente:</strong> {{ $rutCliente ?? 'N/A' }}<br>
                    <strong>Forma de Pago:</strong> Efectivo
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
                    $iva = $subtotal * 0.19; // Asumiendo 19% de IVA
                    $total = $subtotal + $iva;
                @endphp
                <span><strong>Subtotal:</strong> S/ {{ number_format($subtotal, 2) }}</span>
                <span><strong>IGV (19%):</strong> S/ {{ number_format($iva, 2) }}</span>
                <span style="font-size:1.2rem;"><strong>TOTAL:</strong> S/ {{ number_format($total, 2) }}</span>
            </div>
            <div class="boleta-actions">
                {{-- Botón Guardar Boleta --}}
                <form action="{{ route('boleta.store') }}" method="POST" style="display:inline-block;">
                    @csrf
                    <button type="submit" class="boleta-btn guardar">Guardar Boleta</button>
                </form>
                {{-- Botón Imprimir Boleta --}}
                <form action="{{ route('boleta.imprimir') }}" method="POST" style="display:inline-block;">
                    @csrf
                    <button type="submit" class="boleta-btn imprimir">Imprimir Boleta</button>
                </form>
                {{-- Enlace Descargar PDF --}}
                <a href="{{ route('boleta.pdf') }}" class="boleta-btn pdf">Descargar PDF</a>
                {{-- Botón Enviar por Email --}}
                <button class="boleta-btn email">Enviar por Email</button>
            </div>
        </div>
    </div>

    <style>
        /* Contenedor principal para la boleta */
        .boleta-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        /* Encabezado de la Boleta */
        .boleta-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 4px solid #837227;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .boleta-header .logo {
            display: flex;
            align-items: center;
        }
        .boleta-header .logo img {
            height: 55px; /* Ajustado para un logo un poco más grande */
            margin-right: 18px;
            border-radius: 8px; /* Pequeño borde redondeado para el logo */
        }
        .boleta-header .empresa {
            font-weight: bold;
            color: #837227;
            font-size: 1.4rem; /* Un poco más grande */
            letter-spacing: 0.5px;
        }

        /* Títulos y Subtítulos */
        .boleta-title {
            text-align: center;
            margin-bottom: 10px;
            font-size: 2.5rem; /* Más grande y prominente */
            font-weight: 800; /* Extra bold */
            color: #222;
            text-transform: uppercase;
        }
        .boleta-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1rem;
            font-style: italic;
        }

        /* Información de la Boleta (RUT, Dirección, Fecha, No. Boleta) */
        .boleta-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #ddd; /* Línea de separación sutil */
        }
        .boleta-info .left {
            color: #555;
            font-size: 1rem;
            line-height: 1.6;
        }
        .boleta-info .right {
            border: 2px solid #837227;
            border-radius: 10px; /* Bordes más redondeados */
            padding: 10px 28px;
            color: #837227;
            font-weight: bold;
            text-align: center;
            font-size: 1.1rem;
            line-height: 1.5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Tabla de Productos */
        .boleta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 1rem;
        }
        .boleta-table th, .boleta-table td {
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            text-align: left;
        }
        .boleta-table th {
            background: #837227;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .boleta-table td {
            background: #fafafa;
            color: #333;
        }
        .boleta-table tbody tr:nth-child(even) td {
            background: #f5f5f5; /* Color para filas pares */
        }
        .boleta-table td.text-center {
            text-align: center;
            font-style: italic;
            color: #777;
        }

        /* Totales */
        .boleta-totals {
            text-align: right;
            margin-bottom: 30px;
            font-size: 1.1rem;
            color: #333;
        }
        .boleta-totals span {
            display: block;
            margin-bottom: 8px;
        }
        .boleta-totals strong {
            color: #222;
        }
        .boleta-totals span:last-child {
            font-size: 1.5rem; /* Total final más grande */
            font-weight: bold;
            color: #837227;
            margin-top: 15px;
            border-top: 2px solid #837227;
            padding-top: 10px;
        }

        /* Acciones / Botones */
        .boleta-actions {
            display: flex;
            justify-content: center;
            gap: 20px; /* Mayor espacio entre botones */
            flex-wrap: wrap; /* Para que se ajusten en pantallas pequeñas */
        }
        .boleta-actions .boleta-btn {
            padding: 12px 30px; /* Más padding */
            border: none;
            border-radius: 8px; /* Bordes más redondeados */
            font-size: 1.05rem; /* Fuente ligeramente más grande */
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease; /* Transiciones suaves */
            text-decoration: none; /* Para los enlaces que parecen botones */
            display: inline-flex; /* Para centrar contenido si el texto es corto */
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Sombra para profundidad */
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1); /* Pequeña sombra de texto */
        }

        /* Estilos específicos para cada tipo de botón */
        .boleta-actions .guardar {
            background: #bdb76b; /* Color similar a tu logo */
            color: #fff;
        }
        .boleta-actions .guardar:hover {
            background: #a89c4a;
            transform: translateY(-2px); /* Efecto hover sutil */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .boleta-actions .imprimir {
            background: #3a7d2c; /* Verde distintivo */
            color: #fff;
        }
        .boleta-actions .imprimir:hover {
            background: #2e5e22;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .boleta-actions .pdf {
            background: #837227; /* Tu color principal */
            color: #fff;
        }
        .boleta-actions .pdf:hover {
            background: #6b5a1a;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .boleta-actions .email {
            background: #e0e0e0;
            color: #444;
            border: 1px solid #ccc; /* Borde sutil para distinguirlo */
        }
        .boleta-actions .email:hover {
            background: #bdbdbd;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }
    </style>
</x-layouts.app>