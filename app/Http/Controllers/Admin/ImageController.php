<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ImageController extends Controller
{
   
    public function index()
    {
        //
    }

   
    public function create($product_id) // ürüne bağlı resim eklicez o yüzden id yi parametre olarak göndermemiz lazım
    {
        $data = Product::find($product_id);
        $images = DB::table('images')->where('product_id','=', $product_id)->get();//modelle getiremedik // gönderdiğimiz id ye eşit olan resimler
        //   print_r($images);
        //   exit();
        return view('admin.image_add',['data' => $data,'images' => $images]);
    }

   
    public function store(Request $request, $product_id)
    {
        $data = new Image;
        $data->title = $request->input('title');
        $data->product_id = $request->input('product_id');;
        $data->image = Storage::putFile('images', $request->file('image'));
        
        $data->save();
        return redirect()->route('admin_image_add',['product_id'=>$product_id]);
    }

   
    public function show(Image $image)
    {
        //
    }

   
    public function edit(Image $image)
    {
        //
    }

   
    public function update(Request $request, Image $image)
    {
        //
    }

   
    public function destroy(Image $image, $id, $product_id)
    {
        $data = Image::find($id);
        $data->delete();

        return redirect()->route('admin_image_add',['product_id'=>$product_id]);
    }
}
