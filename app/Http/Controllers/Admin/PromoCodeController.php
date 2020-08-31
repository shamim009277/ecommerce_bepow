<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductItem;
use App\PromoCode;
use DB;
use Session;
use Response;
use Validator;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = PromoCode::where('status',1)->paginate(10);
        return view('admin.promo.List',compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_items = ProductItem::where('status',1)->get();
        return view('admin.promo.add_edit',compact('product_items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*return $input = $request->all();*/
        $validator = Validator::make($request->all(),[
            
                'product_id'=>'required',    
                'name'=>'required|max:200',
                'code'=>'required|max:10',
                'type'=>'required',
                'value'=>'required',
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
        $input['name'] = $request->name;
        $input['code'] = strtoupper($request->code);
        $input['type'] = $request->type;
        $input['value'] = $request->value;
        $input['status'] = 1;

        try{
            $bug = 0;
            $insert = PromoCode::create($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Promo Code Added Successfully !');
        return redirect('/admin/promo_code')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/promo_code')->with('status_color','danger');
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
        $product_items = ProductItem::where('status',1)->get();
        $code = PromoCode::findOrFail($id);
    return view('admin.promo.add_edit',compact('product_items','code'));
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
                'name'=>'required|max:200',
                'code'=>'required|max:10',
                'type'=>'required',
                'value'=>'required',
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
        $code = PromoCode::findOrFail($id);
        $input = $request->all();
        //return $input;
        $input['product_id'] = $request->product_id;
        $input['name'] = $request->name;
        $input['code'] = strtoupper($request->code);
        $input['type'] = $request->type;
        $input['value'] = $request->value;

        try{
            $bug = 0;
            $code ->update($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Promo Code Edit Successfully !');
        return redirect('/admin/promo_code')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/promo_code')->with('status_color','danger');
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
        $code = PromoCode::findOrFail($id);

        try{
            $bug=0;
            $delete = $code->delete();
        }
        catch(\Exception $e)
        {
            $bug=$e->errorInfo[1];
        }

        if($bug==0){

            Session::flash('flash_message','Data Deleted Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');

        }else{

            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
