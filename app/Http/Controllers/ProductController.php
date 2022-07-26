<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'name', 'status', 'price', 'thumbnail_url')->paginate(5);;
        return view('list', ['products' => $products]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('product.list');
    }

    public function edit(Product $product)
    {
        return view('edit', ['product' => $product]);
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->fill($request->all());
        $product->save();
        return redirect()->route('product.list');
    }
    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }


    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $products = DB::table('products')->where('name', 'LIKE', '%' . $request->search . '%')->get();
            if ($products) {
                foreach ($products as $key => $product) {
                    $output .= '
            <tr>
            <th scope="row">' . $product->id . '</th>
            <td>' . $product->name . '</td>
            <td>' . $product->price . '</td>
            <td><img src="' . $product->thumbnail_url . '" alt="" width="100px"></td>
            if($product->status == 0)
                <td>
                    <a href="' . route('product.updateStatus', ['id' => $product->id, 'status' => 1]) . '" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                </td>
                @else
                <td>
                    <a href="' . route('product.updateStatus', ['id' => $product->id, 'status' => 0]) . '" class="btn btn-warning"><i class="fa-solid fa-eye-slash"></i></a>
                </td>
            <td>
                <a href="' . route('product.edit', $product->id) . '" class="btn btn-success">Edit</a>
                <a href="' . route('product.delete', $product->id) . '" class="btn btn-danger btnDelete">Delete</a>
            </td>
        </tr>
            ';
                }
            }

            return Response($output);
        }
    }

    public function updateStatus(Product $product, Request $request)
    {
        // dd($request->all());
        $product = Product::find($request->id);
        $product->fill($request->all());
        $product->save();
        return redirect()->route('product.list');
    }
}
