<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductItem;
use App\ProductImage;
use DB;
use Session;
use Response;
use Validator;

class ProductImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductImage::where('status',1)->paginate(5);
        return view('admin.product_image.List',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $product_items = ProductItem::where('status',1)->get();
        return view('admin.product_image.add_edit',compact('product_items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            
                'product_id'=>'required',    
                'product_image'=>'mimes:jpeg,jpg,png,gif|required|max:2000'
                
            ]);
        if($validator->fails())
        {
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $input = $request->all();
        //return $input;
        $input['product_id'] = $request->product_id;
        $input['status'] = 1;

        $image = $request->file('product_image');
        if ($image) {
            //$img_name = $image->getClientOriginalName();
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = uniqid().".".$ext;
            $image_path = 'frontend/images/product/';
            $image_url = $image_path.$image_full_name;
            $success=$image->move($image_path,$image_full_name);
            if ($success) {
                $input['product_image'] = $image_full_name;
            }            
        }else{
            $input['product_image'] = 'default.png';
        }

        try{
            $bug = 0;
            $insert = ProductImage::create($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Image Added Successfully !');
        return redirect('/admin/pro_image')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/pro_image')->with('status_color','danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $single_products = ProductImage::findOrFail($id);
        $product_items = ProductItem::where('status',1)->get();
        return view('admin.product_image.add_edit',compact('single_products','product_items'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            
                'product_id'=>'required',    
                'product_image'=>'mimes:jpeg,jpg,png,gif|max:2000'
                
            ]);
        if($validator->fails())
        {
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
        $single = ProductImage::findOrFail($id);
        $input = $request->all();
        //return $input;
        $input['product_id'] = $request->product_id;

        if (($request->file('product_image')) !== ($single->product_image)) {

         $image = $request->file('product_image');
           if ($image) {
            //$img_name = $image->getClientOriginalName();
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = uniqid().".".$ext;
            $image_path = 'frontend/images/product/';
            $image_url = $image_path.$image_full_name;
            $success=$image->move($image_path,$image_full_name);
            if ($success) {
                $old_image = $image_path.$single->product_image;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
                $input['product_image'] = $image_full_name;
                
            }            
        }
            
        }else{
            $input['product_image'] = $single->image;
        }
        try {
            $bug = 0;
            //$data = BikePart::update($input);
            $single->update($input);
            
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Data Added Successfully !');
        return redirect('/admin/pro_image')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/pro_image')->with('status_color','danger');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sin_data = ProductImage::findOrFail($id);
        $image_path = 'frontend/images/product/';
        $old_image = $image_path.$sin_data->product_image;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }

        try{
            $bug=0;
            $sin_data->delete();
        }
        catch(\Exception $e)
        {
            $bug=$e->errorInfo[1];
        }

        if($bug==0){

            Session::flash('flash_message','Data Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');

        }else{

            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
