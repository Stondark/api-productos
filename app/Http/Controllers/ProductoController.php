<?php

namespace App\Http\Controllers;


use App\Services\ProductoService;
use App\Http\Requests\Producto\ProductoIdRequest;
use App\Http\Requests\Producto\StoreProductoRequest;
use App\Http\Requests\Producto\UpdateProductoRequest;

class ProductoController extends Controller
{

    protected $productoService;

    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    public function index()
    {
        return response()->json(["success" => true, "data" => $this->productoService->getAllProductos()]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $producto = $this->productoService->createProducto($validatedData);
            return response()->json(["success" => true, "data" => $producto], 201);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "error" => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductoIdRequest $request)
    {
        try {
            $product = $this->productoService->getProductoById($request->id);
            return response()->json(["success" => true, "data" => $product]);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "error" => "Producto no encontrado"], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, $id)
    {
        try {
            $product = $this->productoService->updateProducto($id, $request->validated());
            return response()->json(["success" => true, "data" => $product]);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "error" => $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductoIdRequest $request, $id)
    {
        try {
            $product = $this->productoService->deleteProducto($request->id);
            return response()->json(["success" => $product]);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "error" => $e->getMessage()], 404);
        }
    }
}
