<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
// Eliminadas las dependencias de impresora de red (no compatible con entorno web/Canvas)
// use Mike42\Escpos\Printer;
// use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
// use Mike42\Escpos\CapabilityProfile;
use App\Models\Boleta; // Asegúrate de que el modelo Boleta exista
use Barryvdh\DomPDF\Facade\Pdf; // Para la generación de PDF
use Illuminate\Support\Carbon; // Para manejar fechas

class BoletaController extends Controller
{
    /**
     * Muestra la vista de la boleta con los datos del usuario y del carrito.
     */
    public function show()
    {
        // Asegurarse de que el usuario esté autenticado
        if (!Auth::check()) {
            // Puedes redirigir a la página de inicio de sesión o mostrar un mensaje de error
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu boleta.');
        }

        $user = Auth::user();

        // 1. Obtener los datos del cliente
        $cliente = $user->name;
        // Si tu modelo User tiene un campo 'rut', úsalo. Si no, usa el email como placeholder.
        // Se recomienda añadir un campo 'rut' a tu tabla 'users' si es necesario.
        $rutCliente = $user->rut ?? $user->email; // Usa el RUT si existe, si no, el email

        // 2. Obtener los ítems del carrito activo del usuario
        // Asumiendo que tienes un modelo Cart y que un usuario tiene un carrito 'activo'.
        $cart = Cart::with('cartItems.product') // Cargar los ítems del carrito y sus productos asociados
                    ->where('user_id', $user->id)
                    // ->where('is_active', true) // Si usas un campo 'is_active' para el carrito actual
                    ->first(); // Busca el primer carrito para este usuario

        $cartItems = collect(); // Inicializar como colección vacía
        if ($cart) {
            $cartItems = $cart->cartItems;
        } else {
            // Si no hay carrito activo, puedes decidir:
            // a) Redirigir al carrito o a una página de error
            // b) Mostrar un mensaje de "carrito vacío" en la boleta
            // c) Para demostración, usar datos de ejemplo si no hay items
             $cartItems = collect([
                 (object)['product' => (object)['name' => 'Producto de Ejemplo A'], 'quantity' => 2, 'price_at_purchase' => 10.00],
                 (object)['product' => (object)['name' => 'Producto de Ejemplo B'], 'quantity' => 1, 'price_at_purchase' => 25.50],
             ]);
            // return redirect()->route('cart.index')->with('info', 'Tu carrito está vacío. Añade productos para generar una boleta.');
        }

        // 3. Generar datos de la boleta (estos son de ejemplo para la visualización web)
        // En una aplicación real, estos podrían venir de una boleta ya guardada en la BD.
        $numeroBoleta = '001-' . str_pad(Boleta::count() + 1, 6, '0', STR_PAD_LEFT); // Número de boleta basado en el conteo de boletas
        $fecha = Carbon::now()->format('d/m/Y');

        return view('boleta', compact('cartItems', 'cliente', 'rutCliente', 'numeroBoleta', 'fecha'));
    }

    /**
     * Guarda la boleta en la base de datos.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return back()->with('error', 'No se pudo guardar la boleta. Usuario no autenticado.');
        }

        $cart = Cart::where('user_id', $user->id)->with('cartItems.product')->first();
        if (!$cart || $cart->cartItems->isEmpty()) {
            return back()->with('error', 'No hay productos en el carrito para guardar la boleta.');
        }

        $cartItems = $cart->cartItems;
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

        // Generar un número de boleta único para el registro en la BD
        $numeroBoleta = 'BOL-' . date('YmdHis') . rand(100, 999); // Ejemplo: BOL-20231026153045123

        $boleta = Boleta::create([
            'user_id' => $user->id,
            'numero_boleta' => $numeroBoleta, // Guardar el número de boleta generado
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'productos' => json_encode($productos->values()->all()),
            // Otros campos como 'fecha' se establecerían automáticamente si 'created_at' existe
        ]);

        // Opcional: limpiar el carrito después de guardar la boleta
        // $cart->delete(); // Esto eliminaría el carrito y sus items

        return redirect()->route('boleta')->with('success', 'Boleta guardada correctamente.');
    }

    /**
     * Simula la impresión de un voucher. (Funcionalidad de impresora de red no compatible con Canvas)
     */
    public function imprimirVoucher()
    {
        // Para el entorno de Canvas, la impresión directa a una impresora de red no es posible.
        // Aquí puedes redirigir a una vista con un mensaje o a la descarga de PDF.
        return back()->with('info', 'La funcionalidad de impresión directa a impresora de red no está disponible en este entorno. Por favor, descarga el PDF y luego imprime.');
        /*
        // CÓDIGO ORIGINAL (NO FUNCIONARÁ EN CANVAS):
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
                $printer->text("   S/ " . number_format($prod['precio_unitario'], 2) . "   Total: S/ " . number_format($prod['total'], 2) . "\n");
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
        */
    }

    /**
     * Descarga la boleta en formato PDF.
     * Asume que tienes una vista 'boleta-pdf.blade.php' para el PDF.
     */
    public function downloadPDF()
    {
        // Asegurarse de que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para descargar tu boleta.');
        }

        $user = Auth::user();

        // Obtener el carrito actual para generar el PDF con los datos del momento
        $cart = Cart::with('cartItems.product')
                    ->where('user_id', $user->id)
                    // ->where('is_active', true) // Si usas un campo 'is_active' para el carrito actual
                    ->first();

        $cartItems = $cart ? $cart->cartItems : collect();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'No hay productos en el carrito para generar la boleta.');
        }

        $subtotal = $cartItems->sum(function($item) { return $item->quantity * $item->price_at_purchase; });
        $iva = $subtotal * 0.19;
        $total = $subtotal + $iva;

        // Generar número de boleta único (puede ser el mismo que se guardó en DB si ya se guardó)
        // Para el PDF, usamos un número de boleta generado al momento si no se ha guardado aún.
        $numeroBoleta = 'BOL-' . date('Y') . '-' . str_pad(Boleta::count() + 1, 6, '0', STR_PAD_LEFT);

        $data = [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'numeroBoleta' => $numeroBoleta,
            'fecha' => Carbon::now()->format('d/m/Y'), // Usar Carbon para la fecha
            'cliente' => $user->name,
            'rutCliente' => $user->rut ?? $user->email, // Usar el RUT o el email
        ];

        $pdf = Pdf::loadView('boleta-pdf', $data); // Carga la vista 'boleta-pdf.blade.php'

        return $pdf->download('boleta-' . $numeroBoleta . '.pdf');
    }
}