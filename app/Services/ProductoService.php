<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductoService
{
    /**
     * Obtener todos los productos.
     */
    public function getAllProductos($perPage = 10)
    {
        // return Producto::all();
        return Producto::paginate($perPage);
    }

    /**
     * Obtener un producto por ID.
     */
    public function getProductoById(int $id)
    {
        try {
            return Producto::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new \Exception("Producto con ID: $id no encontrado.", 404);
        }
    }

    /**
     * Crear un nuevo producto.
     */
    public function createProducto(array $data)
    {
        return Producto::create($data);
    }

    /**
     * Actualizar un producto existente.
     */
    public function updateProducto(int $id, array $data)
    {
        $producto = $this->getProductoById($id);
        $producto->update($data);

        return $producto;
    }

    /**
     * Eliminar un producto.
     */
    public function deleteProducto(int $id)
    {
        $producto = $this->getProductoById($id);
        return $producto->delete();
    }
}
