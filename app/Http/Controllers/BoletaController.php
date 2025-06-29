<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use App\Models\Boleta;
use Barryvdh\DomPDF\Facade\Pdf;

class BoletaController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $cart = $user ? Cart::where('user_id', $user->id)->with('cartItems.product')->first() : null;
        $cartItems = $cart ? $cart->cartItems : collect();
        return view('boleta', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = $user ? Cart::where('user_id', $user->id)->with('cartItems.product')->first() : null;
        $cartItems = $cart ? $cart->cartItems : collect();

        $subtotal = $cartItems->sum(function($item) { return $item->quantity * $item->price_at_purchase; });
        $iva = $subtotal * 0.19;
        $total = $subtotal + $iva;

        $productos = $cartItems->map(function($item) {
            return [
                'nombre' => $item->product->name ?? '-',
                'cantidad' => $item->quantity,
                'precio_unitario' => $item->price_at_purchase,
                'total' => $item->quantity * $item->price_at_purchase,
            ];
        });

        $boleta = \App\Models\Boleta::create([
            'user_id' => $user->id,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'productos' => json_encode($productos->values()->all()),
        ]);

        return redirect()->route('boleta')->with('success', 'Boleta guardada correctamente.');
    }

    public function imprimirVoucher()
    {
        $printerIp = '192.168.0.101';
        $printerPort = 9100;
        $connector = null;
        $printer = null;

        try {
            $connector = new NetworkPrintConnector($printerIp, $printerPort);
            $profile = CapabilityProfile::load("default");
            $printer = new Printer($connector, $profile);

            // Obtener la última boleta guardada
            $boleta = Boleta::latest()->first();
            if (!$boleta) {
                return back()->with('error', 'No hay boleta para imprimir.');
            }
            $productos = json_decode($boleta->productos, true);

            // --- Encabezado ---
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("--- Riccharly Huami ---\n");
            $printer->text("Boleta Electrónica\n");
            $printer->text("------------------------------\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Fecha: " . $boleta->created_at->format('d/m/Y H:i:s') . "\n");
            $printer->text("Cliente: " . $boleta->user->name . "\n");
            $printer->text("------------------------------\n");

            // --- Productos ---
            foreach ($productos as $prod) {
                $printer->text($prod['nombre'] . " x" . $prod['cantidad'] . "\n");
                $printer->text("  S/ " . number_format($prod['precio_unitario'], 2) . "  Total: S/ " . number_format($prod['total'], 2) . "\n");
            }
            $printer->text("------------------------------\n");
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text("Subtotal: S/ " . number_format($boleta->subtotal, 2) . "\n");
            $printer->text("IVA: S/ " . number_format($boleta->iva, 2) . "\n");
            $printer->text("TOTAL: S/ " . number_format($boleta->total, 2) . "\n");
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("\n¡Gracias por su compra!\n");
            $printer->feed(2);
            $printer->cut();

            return back()->with('success', 'Boleta impresa correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al imprimir la boleta: ' . $e->getMessage());
        } finally {
            if ($printer) {
                $printer->close();
            }
        }
    }

    public function downloadPDF()
    {
        $user = Auth::user();
        $cart = $user ? Cart::where('user_id', $user->id)->with('cartItems.product')->first() : null;
        $cartItems = $cart ? $cart->cartItems : collect();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'No hay productos en el carrito para generar la boleta.');
        }

        $subtotal = $cartItems->sum(function($item) { return $item->quantity * $item->price_at_purchase; });
        $iva = $subtotal * 0.19;
        $total = $subtotal + $iva;

        // Generar número de boleta único
        $numeroBoleta = 'BOL-' . date('Y') . '-' . str_pad(Boleta::count() + 1, 6, '0', STR_PAD_LEFT);

        $data = [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'numeroBoleta' => $numeroBoleta,
            'fecha' => now()->format('d/m/Y'),
            'cliente' => $user->name,
            'rutCliente' => 'N/A', // Puedes agregar campo RUT al modelo User si lo necesitas
        ];

        $pdf = Pdf::loadView('boleta-pdf', $data);

        return $pdf->download('boleta-' . $numeroBoleta . '.pdf');
    }
}
