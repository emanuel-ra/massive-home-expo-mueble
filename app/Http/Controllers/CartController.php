<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
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
    public function get_items(){
        return 'hello world';
    }
    public function add($product_id){
        $product = Product::findOrFail((int)$product_id);
        
        if($product!=null){
            \Cart::add(array(
                'id' => md5($product->id),
                'name' => $product->name,
                'price' => $product->price1,                     
                'quantity' => 1 ,
                'attributes' => array(),
                'associatedModel' => $product
            ));
        }      
        return back()->withInput()->withSuccess('Articulo agregado a cesta');
    }
    public function minus($id){
        \Cart::update($id, array(
            'quantity' => -1, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
        ));

        return back()->withInput();
    }
    public function plus($id){
        \Cart::update($id, array(
            'quantity' => 1, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
        ));

        return back()->withInput();
    }
    public function remove($id){
        \Cart::remove($id);
        return back()->withInput();
    }
    public function update(Request $request){

        $this->validate($request, [               
            'id' => 'required',
            'qty' => 'required|numeric',
            
        ]);   

        \Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty
            ), // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
        ));

        return back()->withInput();

    }
    public function get(){

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
        //return $cart;
        return view('cart.basket',
            [
                'cart'=>$cart ,
                'sub_total'=>$sub_total ,
                'total'=>$total ,
                'type_price'=>$type_price ,
                'prices_labels' =>$prices_labels
            ]
        );

        //return view('layout.quote.cart', ['cart' => $cart,'prospects' => $prospects,'type_price'=>$type_price, 'total'=>$total, 'sub_total'=>$sub_total, 'total_descuento'=>$total_descuento, 'porcentage_descuento'=>$porcentage_descuento]);
    }
    public function set_price($type)
    {
        if(!(int)$type){
            return redirect()->back()->withErrors(['Error' => 'Parámetro incorrecto']);     
        }
        session(['type_price' => (int) $type]);
        return back()->withInput();
    }
}
