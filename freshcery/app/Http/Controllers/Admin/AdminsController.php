<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Models\Product\Order;
use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            return Redirect::route('admins.all')->with(['success'=>'admin create successfully']);
          }
            
    }

    public function displayCategories()
    {
        $allCategories=Category::select()->orderBy('id','desc')->get();
        
         return view('admins.allcategories',compact('allCategories'));
            
    }
}
