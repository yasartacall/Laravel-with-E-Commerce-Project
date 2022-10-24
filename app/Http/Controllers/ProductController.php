<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $datalist = Product::where('user_id',Auth::id())->get();
        return view('home.user_product', ['datalist' => $datalist]);
    }

   
    public function create()
    {
        $datalist = Category::with('children')->get();
        return view('home.user_product_add', ['datalist' => $datalist]);
    }

   
    public function store(Request $request)
    {
        $data = new Product;
        $data->title = $request->input('title');
        $data->keywords = $request->input('keywords');
        $data->description = $request->input('description');
        $data->slug = $request->input('slug');
        $data->status = $request->input('status');
        $data->category_id = $request->input('category_id');
        $data->user_id = Auth::id();
        $data->price = $request->input('price');
        $data->quantity = $request->input('quantity');
        $data->minquantity = $request->input('minquantity');
        $data->tax = (int) $request->input('tax');
        $data->detail = $request->input('detail');
        $data->image = Storage::putFile('images', $request->file('image'));// File upload
        // config klasöründe ayar yapmamız lazım
        // filesystem de bunu yapmmaız lazım 'root' => storage_path('app/public'),
        $data->save();
        return redirect()->route('user_products')->with('success','Product Added Succesfully');


    }

   
    public function show(Product $product)
    {
        //
    }

    
    public function edit(Product $product, $id)
    {
        $data = Product::find($id);
        $datalist = Category::with('children')->get();

        return view('home.user_product_edit',['data' => $data, 'datalist' => $datalist]);
    }

   
    public function update(Request $request, Product $product, $id)
    {
        $data = Product::find($id);
        $data->title = $request->input('title');
        $data->keywords = $request->input('keywords');
        $data->description = $request->input('description');
        $data->slug = $request->input('slug');
        $data->status = $request->input('status');
        $data->category_id = $request->input('category_id');;
        $data->user_id = Auth::id();
        $data->price = $request->input('price');
        $data->quantity = $request->input('quantity');
        $data->minquantity = $request->input('minquantity');
        $data->tax = (int) $request->input('tax');
        $data->detail = $request->input('detail');
        if ($request->file('image'!=null)) // boş değilse yani bişey seçildiyse dikkate alıcak
        {
            $data->image = Storage::putFile('images', $request->file('image'));
        }
        $data->save();
        return redirect()->route('user_products');
    }

   
    public function destroy(Product $product, $id)
    {
        //DB::table('products')->where('id', '=', $id)->delete();
        $data = Product::find($id);
        $data->delete();

        return redirect()->route('user_products');
    }
}
