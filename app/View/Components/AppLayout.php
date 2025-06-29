<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        // ¡ESTO ES LO CLAVE! La ruta de la vista ahora apunta a la ubicación EXACTA
        // donde está tu app.blade.php, según la imagen que enviaste.
        return view('components.layouts.app.app');
    }
}