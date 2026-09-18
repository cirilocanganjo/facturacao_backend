<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Listar todos os produtos
     */
    public function index()
    {
        $products = Product::with(['category', 'company'])->latest()->get();

        return response()->json([
            'message' => 'Lista de produtos',
            'data' => $products,
        ]);
    }

    /**
     * Criar novo produto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'company_id'  => 'required|exists:companies,id',
            'unit_price'  => 'required|numeric|min:0',
            'tax_rate'    => 'nullable|integer|min:0|max:100',
            'unit'        => 'nullable|string|max:255',
        ], [
            'description.required' => 'A descrição do produto é obrigatória',
            'category_id.required' => 'A categoria é obrigatória',
            'category_id.exists' => 'A categoria selecionada não existe',
            'company_id.required' => 'A empresa é obrigatória',
            'company_id.exists' => 'A empresa selecionada não existe',
            'unit_price.required' => 'O preço unitário é obrigatório',
            'unit_price.numeric' => 'O preço unitário deve ser um número',
            'unit_price.min' => 'O preço unitário não pode ser negativo',
            'tax_rate.integer' => 'A taxa de imposto deve ser um número inteiro',
            'tax_rate.min'  => 'A taxa de imposto não pode ser negativa',
            'tax_rate.max' => 'A taxa de imposto não pode ser superior a 100',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Produto criado com sucesso',
            'data' => $product->load(['category', 'company']),
        ], 201);
    }

    /**
     * Mostrar um produto específico
     */
    public function show($id)
    {
        $product = Product::with(['category', 'company'])->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Produto não encontrado',
            ], 404);
        }

        return response()->json([
            'message' => 'Detalhes do produto',
            'data' => $product,
        ]);
    }

    /**
     * Atualizar produto
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Produto não encontrado',
            ], 404);
        }

        $validated = $request->validate([
            'description' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'company_id'  => 'sometimes|required|exists:companies,id',
            'unit_price' => 'sometimes|required|numeric|min:0',
            'tax_rate' => 'nullable|integer|min:0|max:100',
            'unit' => 'nullable|string|max:255',
        ], [
            'description.required' => 'A descrição do produto é obrigatória',
            'category_id.required' => 'A categoria é obrigatória',
            'category_id.exists'  => 'A categoria selecionada não existe',
            'company_id.required' => 'A empresa é obrigatória',
            'company_id.exists' => 'A empresa selecionada não existe',
            'unit_price.required' => 'O preço unitário é obrigatório',
            'unit_price.numeric' => 'O preço unitário deve ser um número',
            'unit_price.min' => 'O preço unitário não pode ser negativo',
            'tax_rate.integer' => 'A taxa de imposto deve ser um número inteiro',
            'tax_rate.min' => 'A taxa de imposto não pode ser negativa',
            'tax_rate.max' => 'A taxa de imposto não pode ser superior a 100',
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Produto atualizado com sucesso',
            'data'    => $product->load(['category', 'company']),
        ]);
    }

    /**
     * Eliminar produto
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Produto não encontrado',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Produto eliminado com sucesso',
        ]);
    }
}