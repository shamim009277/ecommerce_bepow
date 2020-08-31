<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductItem;
use DB;
use Session;
use Response;
use Validator;

class ProductItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductItem::where('status',1)->paginate(5);
        return view('admin.product_item.List',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product_item.add_edit');
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
            
                'item_name'=>'required | max:255 | unique:product_items',
                'overview'=>'required | max:1000',
                'rating'=>'required',
                'price'=>'required'
                
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
        $input['item_name'] = $request->item_name;
        $input['overview'] = $request->overview;
        $input['price'] = $request->price;
        $input['rating'] = $request->rating;
        $input['status'] = 1;

        try{
            $bug = 0;
            $insert = ProductItem::create($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Product Item Added Successfully !');
        return redirect('/admin/pro_item')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/pro_item')->with('status_color','danger');
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
        $product = ProductItem::findOrFail($id);
        return view('admin.product_item.add_edit',compact('product'));
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
            
                'item_name'=>'required | max:255 ',
                'overview'=>'required | max:1000',
                'rating'=>'required',
                'price'=>'required'
                
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
        
        $product = ProductItem::findOrFail($id);
        $input = $request->all();
        //return $input;
        $input['item_name'] = $request->item_name;
        $input['overview'] = $request->overview;
        $input['price'] = $request->price;
        $input['rating'] = $request->rating;
        $input['status'] = 1;

        try{
            $bug = 0;
            $product->update($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Product Item Edit Successfully !');
        return redirect('/admin/pro_item')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/pro_item')->with('status_color','danger');
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
        $data = ProductItem::findOrFail($id);

        try{
            $bug=0;
            $delete = $data->delete();
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
