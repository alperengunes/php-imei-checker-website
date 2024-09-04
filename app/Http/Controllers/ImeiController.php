<?php

namespace App\Http\Controllers;

use App\Http\Traits\eDevletTrait;
use Illuminate\Http\Request;

class ImeiController extends Controller
{
    use eDevletTrait;
    public function imeiCheck(Request $request){
        $this->validate($request,[
           'imei' => 'required|numeric'
        ],
        [
            'imei.numeric' => 'IMEI numarası sadece rakamlardan oluşabilir.'
        ]);
        $imei = $request->imei;
        $check = $this->check($imei);
        return response()->json([
            'imei' => $imei,
            'check' => $check
        ]);
    }
}
