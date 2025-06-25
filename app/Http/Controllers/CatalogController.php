<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Muestra una lista de productos para el catálogo público, con opciones de búsqueda, filtro y orden.
     */
    public function index(Request $request)
    {
        // Obtener la búsqueda, categoría y orden de la URL
        $searchTerm = $request->query('search');
        $filterCategory = $request->query('category');
        $orderBy = $request->query('order_by', 'name'); // Default order by name
        $orderDirection = $request->query('order_direction', 'asc'); // Default ascending

        // Iniciar la consulta de productos
        $productsQuery = Product::query();

        // Aplicar búsqueda si existe
        if ($searchTerm) {
            $productsQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Aplicar filtro por categoría si existe y no es 'Todos los productos'
        if ($filterCategory && $filterCategory !== 'Todos los productos') {
            $productsQuery->where('category', $filterCategory);
        }

        // Aplicar orden
        $productsQuery->orderBy($orderBy, $orderDirection);

        // Ejecutar la consulta y obtener los productos
        $allProducts = $productsQuery->get();

        // Las categorías que quieres mostrar, en el orden deseado
        // Asegúrate de que estos nombres coincidan EXACTAMENTE con los valores en tu columna 'category' de la BD
        $orderedCategories = [
            'Productos agrícolas',
            'Producto Animal',
            'Insumos agrícolas',
            'Otros productos',
        ];

        // Crear un array asociativo para agrupar productos por categoría
        $groupedProducts = [];
        foreach ($orderedCategories as $categoryName) {
            $groupedProducts[$categoryName] = [];
        }

        // Asignar productos a sus categorías, incluyendo las no definidas si aparecieran
        foreach ($allProducts as $product) {
            $category = $product->category;
            // Asegurarse de que la categoría exista en nuestro array agrupado, si no, crearla
            if (!isset($groupedProducts[$category])) {
                $groupedProducts[$category] = [];
            }
            $groupedProducts[$category][] = $product;
        }

        // Pasar los datos a la vista
        return view('catalogo', [
            'groupedProducts' => $groupedProducts,
            'searchTerm' => $searchTerm,
            'filterCategory' => $filterCategory,
            'orderBy' => $orderBy,
            'orderDirection' => $orderDirection,
            'availableCategories' => array_keys($groupedProducts), // O un array fijo si prefieres
            'orderedCategories' => $orderedCategories, // Las categorías en el orden deseado
        ]);
    }
}