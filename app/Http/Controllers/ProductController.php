<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
    public function index(Request $request)
    {
        $query = Product::query();

        $query = $query->where('status_id',1);        

        if(isset($request->keyword)){
            $query = $query->Where('code', 'LIKE', "%".$request->keyword."%")
            ->orWhere('name', 'LIKE', "%".$request->keyword."%");            
        }

        $query->orderByDesc('id');
        
        $data = $query->paginate(15)->withQueryString();; 

        //$data = Product::where('status_id',1)->orderByDesc('id')->paginate(15);       
        
        return view('products.list',
            ['data'=>$data,'keyword'=>$request->keyword]
        );
        
    }
    public function grid(Request $request)
    {
        $query = Product::query();

        $query = $query->where('status_id',1);        

        if(isset($request->keyword)){
            $query = $query->Where('code', 'LIKE', "%".$request->keyword."%")
            ->orWhere('name', 'LIKE', "%".$request->keyword."%");            
        }

        $query->orderByDesc('id');
        
        $data = $query->paginate(18)->withQueryString();; 
        
        return view('products.grid',
            ['data'=>$data,'keyword'=>$request->keyword]
        );
        
    }
    public function view($id){
        $data = Product::with('Gallery:product_id,image')
            ->with('Content:product_id,title,description')
            ->with('Description:product_id,title,description')
            ->with('Specifications:id,product_id,title')
            ->findOrFail($id);
        
        return view('products.view',
            ['data'=>$data]
        );
    }
}
