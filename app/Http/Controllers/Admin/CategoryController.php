<?php
// php artisan make:controller Admin/CategoryController --resource diyerek direkt fonkları ile oluştu
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    protected $appends = [ // bu tanım heryerden erişilebilmesi için
        'getParentsTree',
    ];


    // static yapmazsak dışarıdan erişim olmuyo.
    public static function getParentsTree($category, $title) // bu fonk. category.blade de kullanıldı.
    {
        if ($category->parent_id == 0) // parent_id 0 ise ana kategoridir 
        {
            return $title; // direkt kendisini yazarız.
        }

        $parent = Category::find($category->parent_id); // kategorininn parent_id sini buluyoruz.$parent
        $title = $parent->title . ' > ' . $title; // parentın titleı > kendi titleı olarak  yazıyoruz.(Bilgisayar > Laptop) gibi

        return CategoryController::getParentsTree($parent, $title);// sonra tekrar çağırıyoruz. yani burda ki parent artık üst kategori onun da üstü var mı diye tekrar bakıyoruz.
    }


    public function index()
    { 
        $datalist = Category::with('children')->get(); // çağırımları bu şekilde yapıyoruz sebebini bilmiyorum.
        return view('admin.category', ['datalist' => $datalist]);
    }

    // ADD
    public function add()
    {
        $datalist = Category::with('children')->get(); 
        return view('admin.category_add', ['datalist' => $datalist]);
    }

    // CREATE
    public function create(Request $request)
    {
        // echo $name = $request->input('title');// gelen veriyi bu şekilde alabiliyoruz

        DB::table('categories')->insert([
            'parent_id' => $request->input('parent_id'),
            'title' => $request->input('title'),
            'keywords' => $request->input('keywords'),
            'description' => $request->input('description'),
            'slug' => $request->input('slug'),
            'status' => $request->input('status')
        ]);

        return redirect()->route('admin_category');// işlem tamamlanınca categorilere geri döner

    }

  
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

 
    // EDİT
    public function edit(Category $category, $id)
    {
        $data = Category::find($id);// modele bağlı çağırma aslında bu data edit olan ürünün id sine ait categorinin bilgileri
        $datalist = Category::with('children')->get(); 

        return view('admin.category_edit',['data' => $data, 'datalist' => $datalist]);
    }

   
    // UPDATE
    public function update(Request $request, Category $category, $id)
    {
        $data = Category::find($id);
        $data->parent_id = $request->input('parent_id');
        $data->title = $request->input('title');
        $data->keywords = $request->input('keywords');
        $data->description = $request->input('description');
        $data->slug = $request->input('slug');
        $data->status = $request->input('status');
        $data->save();
        return redirect()->route('admin_category');
    }

    // DELETE
    public function destroy(Category $category, $id)
    {
        DB::table('categories')->where('id', '=', $id)->delete();// id si gönderilen şeyi categories de sil

        return redirect()->route('admin_category');
    }
}
