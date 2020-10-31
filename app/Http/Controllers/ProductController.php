<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show add product page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $categories = Category::get();
        return view('product.create',compact('categories'));
    }


    /**
     * store product.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(ProductRequest $request)
    {
        $productData =  Product::where('product_name',$request->product_name)
           ->where('product_code',$request->product_code)
           ->first();

       if( !$productData )
       {
           if(  $request->product_image )
           {
               $fileImage =  $request->file('product_image');
               $imgName=  Str::random(10).date('_Y-m-d').'.'.$fileImage->clientExtension();
               $path = "uploads/product_img/".$imgName;
               Storage::disk('myDisk')->put($path,file_get_contents($fileImage));
           }
           else
           {
               $imgName ='demo.png';
           }

           $productData =  new Product();
           $productData->category_id = $request->category_id  ;
           $productData->product_name = $request->product_name  ;
           $productData->product_code = $request->product_code  ;
           $productData->quantity = $request->quantity  ;
           $productData->price = $request->price  ;
           $productData->description = $request->description  ;
           $productData->product_img = $imgName  ;
           $productData->save() ;

           session()->flash('status','success');
           session()->flash('message','Product Saved Successfully!');
           return  redirect()->route('home');
       }


        return view('product.create',compact('categories'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
      public function edit($id)
    {
        $productData = Product::find($id);
        $categories = Category::get();
        $path = url("uploads/product_img/".$productData->product_img);

        return view('product.edit',compact('productData','categories','path'));
    }



    /**
     * Show the product edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update($id , ProductUpdateRequest $request)
    {
        $productData = Product::where('id',$id)->first();

        if(  $request->product_image )
        {
            $fileImage =  $request->file('product_image');
            $imgName=  Str::random(10).date('_Y-m-d').'.'.$fileImage->clientExtension();
            $path = "uploads/product_img/".$imgName;
            Storage::disk('myDisk')->put($path,file_get_contents($fileImage));
        }
        else
        {
            $imgName =$productData->product_img?$productData->product_img:"demo.png";
        }

        $productData->category_id = $request->category_id  ;
        $productData->product_name = $request->product_name  ;
        $productData->product_code = $request->product_code  ;
        $productData->quantity = $request->quantity  ;
        $productData->price = $request->price  ;
        $productData->description = $request->description  ;
        $productData->product_img = $imgName  ;
     //   return $productData ;
        $productData->save() ;

        session()->flash('status','success');
        session()->flash('message','Product Updated Successfully!');
        return  redirect()->route('home');
    }



    /**
     * Show delete the product.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($id)
    {
        $productData = Product::where('id',$id)->first();
        $productData->delete();
        session()->flash('status','success');
        session()->flash('message','Product Delete Successfully!');
        return  redirect()->route('home');
    }

}
