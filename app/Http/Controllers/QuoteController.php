<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\QuoteDetail;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $query->with('user');
        $query->with('prospect');

        $query->orderByDesc('id');
        
        $data = $query->paginate(15)->withQueryString(); 
        //$data = Product::where('status_id',1)->orderByDesc('id')->paginate(15);       
        
        $typePrices[1] = 'Menudeo';
        $typePrices[2] = 'Mayoreo';
        $typePrices[3] = 'Distribuidor';
        $typePrices[4] = 'Caja';

        return view('quote.list',
            [
                'data'=>$data,
                'typePrices'=> $typePrices , 
                'keyword'=>$request->keyword
            ]
        );
        
    }
    public function pdf($id)
    {
        $data = Quote::with('user')->with('prospect')->with('Detail')->find($id);

        //view()->share('quotes.pdf',$data);
        $pdf = Pdf::loadView('pdf.quote', ['data'=>$data]);
        return $pdf->stream();
    }
    public function store(Request $request)
    {
        $type_price = session('type_price', 1);
        $prospect_id = session('prospect_id',0);
        $cart = \Cart::getContent();

        if(!$prospect_id){
            return redirect()->back()->withErrors(['Error' => 'Seleccione un cliente']);     
        }

        if(!count($cart)){
            return redirect()->back()->withErrors(['Error' => 'Agregue artículos a su cesta']);     
        }
        
        $total = 0;   
        foreach($cart as $row)
        {            
            if($type_price==1){ $total += $row->price*$row->quantity; }
            if($type_price==2){ $total += $row->associatedModel->price2*$row->quantity; }
            if($type_price==3){ $total += $row->associatedModel->price3*$row->quantity; }
            if($type_price==4){ $total += $row->associatedModel->price4*$row->quantity; }
        }


        $new = new Quote;
        $new->prospect_id = $prospect_id;
        $new->commentary = $request->commentary;
        $new->attended_by = $request->user()->id;
        $new->total_discount = 0;
        $new->discount_percentage = 0;
        $new->total = $total;
        $new->type_price = $type_price;
        $new->status_id = 1;        
        if($new->save())
        {
            foreach($cart as $row)
            {
                $price = $row->price;                
                if($type_price==2){ $price = $row->associatedModel->price2; }
                if($type_price==3){ $price = $row->associatedModel->price3; }
                if($type_price==4){ $price = $row->associatedModel->price4; }
                
                $d = new QuoteDetail;
                $d->quote_id = $new->id;
                $d->product_id = $row->associatedModel->id;
                $d->price = $price;
                $d->quantity = $row->quantity;

                $d->save();

            }
            session(['type_price' => (int) 1]);
            \Cart::clear();
            return redirect()->back()->withSuccess('Información guardada correctamente'); 
        }
        return redirect()->back()->withErrors(['Error' => 'ERROR AL GENERAR COTIZACIÓN']);     
    }
}
