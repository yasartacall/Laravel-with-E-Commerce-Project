<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Message;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public static function categoryList()
    {
        return Category::where('parent_id', '=', 0)->with('children')->get();// parent id si 0 olanları getir childları ile alt kategırileri ile beraber // yani sadece ana kategoriler
    }

    public static function getSetting()
    {
        return Setting::first();
    }

    public function index()
    {
        $setting = Setting::first();
        $slider = Product::select('id','title','image','price','slug')->limit(4)->get();
        // print_r($setting);
        // exit();
        $data = [
        'setting' => $setting,
        'slider' => $slider,
        'page' => 'home' // sadece anasayfada page değişkeni dolu gidiyo bu sayede bu değişkenin gittiği yerin anasayfa olduğunu anlıyoruz
        ];

        return view('home.index', $data );
    }

    public function product($id, $slug) // ürün detay sayfası için
    {
        $data = Product::find($id);
        $datalist = Image::where('product_id', $id)->get();//detay resimleri için id si bu id olanlar
        return view('home.product_detail', ['data'=>$data, 'datalist'=>$datalist] );

    }

    public function getproduct(Request $request)
    {
        $search=$request->input('search');

        $count = Product::where('title', 'like', '%'.$search.'%')->get()->count();
        if ($count==1) // gelen search sorgusuna uyan ürün bi tane ise  sorgumuuzu yapıp productdetaile yolladık yukarıya
        {
            $data = Product::where('title', 'like', '%'.$search.'%')->first();
            return redirect()->route('product',['id'=>$data->id,'slug'=>$data->slug]);
        }
        else // birden fazla ürün var ise productlist fonk. a yollluyoruz
        {
            return redirect()->route('productlist',['search'=>$search]);
        }
    }

    public function productlist($search) //gelen searchü sorguluyoruz tekrar
    {
        $datalist =Product::where('title', 'like', '%'.$search.'%')->get();
        return view('home.search_products',['search'=>$search,'datalist'=>$datalist]);// search kelimesini de yolluyoruz.
    }

    // public function addtocart($id)
    // {
    //     echo "Add to Cart <br>";
    //     $data = Product::find($id);
    //     print_r($data);
    //     exit();


    // }

    public function aboutus()
    {
        $setting = Setting::first();
        return view('home.about', ['setting'=>$setting]);
    }

    public function references()
    {
        $setting = Setting::first();
        return view('home.references', ['setting'=>$setting]);
    }

    public function contact()
    {
        $setting = Setting::first();
        return view('home.contact', ['setting'=>$setting]);
    }

    public function sendmessage(Request $request)
    {
        $data = new Message();
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->subject = $request->input('subject');
        $data->message = $request->input('message');
      
        $data->save();
        return redirect()->route('contact')->with('success', 'Mesajınız kaydedilmiştir, Teşekkür ederiz');
    }

    public function fag()
    {
        return view('home.about');
    }

    public function login()
    {
        return view('admin.login');
    }


    public function logincheck(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended('admin');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        else
        {
            return view('admin.login');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function test($id, $name)
    {
        return view('home.test',['id'=>$id, 'name'=>$name]);// viewe yolladık
        /*
        echo "Id Number :", $id;
        echo "          Name:", $name;
        for ($i=1;$i<=$id;$i++){
            echo "<br> $i $name";
        }
        */
    }
}
