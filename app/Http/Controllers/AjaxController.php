<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prospect;

class AjaxController extends Controller
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

    public function get_prospects(Request $request)
    {
        if($request->keyword===''){
            return '';
        }
        
        $data = Prospect::where('name','like','%'.$request->keyword.'%')->get();

       
        return Response()->json($data,200);
    }
}
