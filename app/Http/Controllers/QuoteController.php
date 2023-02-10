<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;

class QuoteController extends Controller
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
        $query = Quote::query();

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
}
