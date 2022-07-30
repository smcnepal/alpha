<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use Validator;

class TestController extends Controller
{
    public function index(){
        // return view('template.layout');
        return view('testing');
    }

    public function store(Request $request){
    //    $data= $request->all();
    $validator = Validator::make($request->all(), [

        'first_name' => 'required',

        'last_name' => 'required',

        'email' => 'required|email',

        'address' => 'required',

    ]);
    if ($validator->passes()) {
        // dd("Success");
        return response()->json(['success'=>'Added new records.']);

    }

    // dd($validator->errors()->all());
    return response()->json(['error'=>$validator->errors()->all()]);

}
}
