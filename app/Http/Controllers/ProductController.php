<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->has('search') && !empty($request->get('search'))) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }
        $products = $query->paginate(10);

        return view('product.index', compact(
            'products'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $action = route('products.store');
        $product = null;
        $options = Option::all();

        return view('product.form', compact(
            'action',
            'product',
            'options'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validateForm($request);

        $product = Product::create($request->all());
        $product->options()->sync($request->input('options'));

        Session::flash('success', __('Product has been created successfully!'));

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $action = route('products.update', $product);
        $options = Option::all();

        foreach ($options as $option) {
            foreach ($product->options as $productOption) {
                if ($option->id == $productOption->pivot->option_id) {
                    $option->value = $productOption->pivot->value;
                }
            }
        }

        return view('product.form', compact(
            'action',
            'product',
            'options'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return void
     */
    public function update(Request $request, Product $product)
    {
        $this->validateForm($request);

        $product->fill($request->all());
        $product->options()->sync($request->input('options'));
        $product->save();

        Session::flash('success', __('Product has been updated successfully!'));

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        $product->options()->detach();
        $product->delete();

        Session::flash('success', __('Product has been deleted successfully!'));

        return back();
    }

    private function validateForm(Request $request)
    {
        $options = Option::all();
        $rules = [
            'name' => 'required|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ];

        foreach ($options as $option) {
            $rules['options.' . $option->id . '.value'] = 'max:255';
        }

        $this->validate($request, $rules);
    }
}
