<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Models\Product\Order;
use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Admin\AdminsController;

class AdminsController extends Controller
{
    //
    public function viewLogin()
    {
        return view('admins.login');
    }

    public function checkLogin(Request $request)
    {
        $remember_me=$request->has('remember_me')? true:false;

        if(auth()->guard('admin')->attempt(['email'=>$request->input("email"),'password'=>$request->input("password")],$remember_me))
        {
            return redirect()->route('admins.dashboard');
        
        }
        return redirect()->back()->with(['errr'=>'error logging in']);

    }

    public function index()
    {
        $productsCount=Product::select()->count();
        $ordersCount=Order::select()->count();
        $categoriesCount=Category::select()->count();
        $adminsCount=Admin::select()->count();
                return view('admins.index',compact('productsCount','ordersCount','categoriesCount','adminsCount'));
    }

    public function logout()
   {
    Auth::guard('admin')->logout();
    return redirect('/');
   }
   
   public function displayAdmins()
    {
             $allAdmins=Admin::all();
                return view('admins.alladmins',compact('allAdmins'));
    }

    public function createAdmins()
    {
             
            return view('admins.createadmins');
    }
    public function storeAdmins(Request $request)
    {
          $storeAdmins=Admin::create([
            "email"=>$request->email,
            "name"=>$request->name,
            "password"=>Hash::make($request->password),
          ]);
             
          if($storeAdmins)
          {
            return Redirect::route('admins.all')->with(['success'=>'admin created successfully']);
          }
            
    }

    public function displayCategories()
    {
        $allCategories=Category::select()->orderBy('id','desc')->get();
        
         return view('admins.allcategories',compact('allCategories'));
            
    }
    public function createCategories()
    {
       
         return view('admins.createcategories');
            
    }

    public function storeCategories(Request $request)
    {

          $destinationPath='assets/img/';
          $myimage=$request->image->getClientOriginalName();
          $request->image->move(public_path($destinationPath),$myimage);

          $storeCategories=Category::create([
            "icon"=>$request->icon,
            "name"=>$request->name,
            "image"=>$myimage,
          ]);
             
          if($storeCategories)
          {
            return Redirect::route('categories.all')->with(['success'=>'category created successfully']);
          }
            
    }
 
    public function editCategories($id)
    {
       $category=Category::find($id);
         return view('admins.editcategories',compact('category'));
            
    }
    

    public function updateCategories(Request $request,$id)
    {
          $category=Category::find($id);

          $category->update($request->all());
             
          if($category)
          {
            return Redirect::route('categories.all')->with(['update'=>'category updated successfully']);
          }
            
    }

    public function deleteCategories($id)
    {
          $category=Category::find($id);
          if(File::exists(public_path('assets/img/'.$category->image))){
            File::delete(public_path('assets/img/'.$category->image));
          }else{
            
          }

          $category->delete();
             
          if($category)
          {
            return Redirect::route('categories.all')->with(['delete'=>'category deleted successfully']);
          }
            
    }

    //products
    public function displayProducts()
    {
        $allProducts=Product::select()->orderBy('id','desc')->get();
        
         return view('admins.allproducts',compact('allProducts'));
            
    }

    public function createProducts()
    {
        $allCategories=Category::all();
       
         return view('admins.createproducts',compact('allCategories'));
            
    }

    public function storeProducts(Request $request)
    {

          $destinationPath='assets/img/';
          $myimage=$request->image->getClientOriginalName();
          $request->image->move(public_path($destinationPath),$myimage);

          $storeProducts=Product::create([
            "price"=>$request->price,
            "name"=>$request->name,
            "description"=>$request->description,
            "category_id"=>$request->category_id,
            "exp_date"=>$request->exp_date,
            "image"=>$myimage,
          ]);
             
          if($storeProducts)
          {
            return Redirect::route('products.all')->with(['success'=>'product created successfully']);
          }
            
    }

    public function deleteProducts($id)
    {
          $product=Product::find($id);
          if(File::exists(public_path('assets/img/'.$product->image))){
            File::delete(public_path('assets/img/'.$product->image));
          }else{
            
          }

          $product->delete();
             
          if($product)
          {
            return Redirect::route('products.all')->with(['delete'=>'product deleted successfully']);
          }
            
    }

    //orders
    public function allOrders()
    {
        $allOrders=Order::select()->orderBy('id','desc')->get();
        
         return view('admins.allorders',compact('allOrders'));
            
    }

    public function editOrders($id)
    {
       $order=Order::find($id);

        return view('admins.editorders',compact('order'));
            
    }


    public function updateOrders(Request $request,$id)
    {
          $order=Order::find($id);

          $order->update($request->all());
             
          if($order)
          {
            return Redirect::route('orders.all')->with(['update'=>'Order updated successfully']);
          }
            
    }

}
