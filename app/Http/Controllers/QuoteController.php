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
        
        $data = $query->paginate(15)->withQueryString(); 

        //$data = Product::where('status_id',1)->orderByDesc('id')->paginate(15);       
        
        return view('quote.list',
            ['data'=>$data,'keyword'=>$request->keyword]
        );
        
    }
    public function register()
    {
        $type_price = session('type_price', 1);
        $prices_labels = array();

        $prices_labels[1] = 'Precio Menudeo';
        $prices_labels[2] = 'Precio Mayoreo';
        $prices_labels[3] = 'Precio Distribuidor';
        $prices_labels[4] = 'Precio Caja';

        $cart = \Cart::getContent();

        $total = 0;   
        foreach($cart as $row)
        {            
            if($type_price==1){ $total += $row->price*$row->quantity;; }
            if($type_price==2){ $total += $row->associatedModel->price2*$row->quantity; }
            if($type_price==3){ $total += $row->associatedModel->price3*$row->quantity; }
            if($type_price==4){ $total += $row->associatedModel->price4*$row->quantity; }
        }
        
        $sub_total = $total;
        //$total = $total-$total_descuento;
        
        return view('quote.register',
            [
                'cart'=>$cart ,
                'sub_total'=>$sub_total ,
                'total'=>$total ,
                'type_price'=>$type_price ,
                'prices_labels' =>$prices_labels
            ]
        );
    }
}
