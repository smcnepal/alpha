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

    public function uploadImageView(){
        // return view('template.layout');
        return view('ajax-image-upload2');
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
public function imageUpload(Request $request){

    $validator = Validator::make($request->all(), [

        'title' => 'required',

        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',

      ]);


      if ($validator->passes()) {


        $input = $request->all();

        $input['image'] = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $input['image']);


        AjaxImage::create($input);


        return response()->json(['success'=>'done']);

      }


      return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function imageUpload2(Request $request)
    {
         
        $validatedData = $request->validate([
         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
 
        ]);
 
        $name = $request->file('image')->getClientOriginalName();
 
        $path = $request->file('image')->store('public/images');
        dd($name);
 
        // $save = new Photo;
 
        // $save->name = $name;
        // $save->path = $path;
 
        // $save->save();
 
        return response()->json($path);
 
    }
}
