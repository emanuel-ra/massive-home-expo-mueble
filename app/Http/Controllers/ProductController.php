<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSheetSpecifications;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Product::where('status_id',1)->orderByDesc('id')->paginate(15);       
        
        return view('products.list',
            ['data'=>$data]
        );
        
    }
    public function view($id){
        $data = Product::with('Gallery:product_id,image')
            ->with('Content:product_id,title,description')
            ->with('Description:product_id,title,description')
            ->with('Specifications:id,product_id,title')
            ->findOrFail($id);
        
            //return $data;
        return view('products.view',
            ['data'=>$data]
        );
    }
}
