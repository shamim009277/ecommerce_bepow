<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Logo;
use DB;
use Session;
use Response;
use Validator;

class LogoController extends Controller
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
        $logos = Logo::paginate(10);
        return view('admin.logo.List',compact('logos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.logo.add_edit');
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
            
                'title'=>'required | max:255',
                'logo'=>'mimes:jpeg,jpg,png,gif|required|max:2000'
                
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
        $input['title'] = $request->title;
        
        $logo = $request->file('logo');
        if ($logo) {
            //$img_name = $image->getClientOriginalName();
            $ext = strtolower($logo->getClientOriginalExtension());
            $image_full_name = uniqid().".".$ext;
            $image_path = 'frontend/images/logo/';
            $image_url = $image_path.$image_full_name;
            $success=$logo->move($image_path,$image_full_name);
            if ($success) {
                $input['logo'] = $image_full_name;
            }            
        }else{
            $input['logo'] = 'default.png';
        }

        try{
            $bug = 0;
            $insert = Logo::create($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Data Added Successfully !');
        return redirect('/admin/logo')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/logo')->with('status_color','danger');
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
        $single_logo = Logo::findOrFail($id);
        return view('admin.logo.add_edit',compact('single_logo'));
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
            
                'title'=>'required | max:255',
                'logo'=>'mimes:jpeg,jpg,png,gif|max:2000'
                
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

        $old_logo = Logo::findOrFail($id);
        $input = $request->all();
        //dd($input);
        $input['title'] = $request->title;
       
        if (($request->file('logo')) !== ($old_logo->logo)) {

         $logo = $request->file('logo');
           if ($logo) {
            //$img_name = $image->getClientOriginalName();
            $ext = strtolower($logo->getClientOriginalExtension());
            $image_full_name = uniqid().".".$ext;
            $image_path = 'frontend/images/logo/';
            $image_url = $image_path.$image_full_name;
            $success=$logo->move($image_path,$image_full_name);
            if ($success) {
                $old_image = $image_path.$old_logo->logo;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
                $input['logo'] = $image_full_name;
                
            }            
        }
            
        }else{
            $input['logo'] = $old_logo->logo;
        }

        try {
            $bug = 0;
            //$data = BikePart::update($input);
            $old_logo->update($input);
            
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Data Added Successfully !');
        return redirect('/admin/logo')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/logo')->with('status_color','danger');
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
        $logo = Logo::findOrFail($id);
        $image_path = 'frontend/images/logo/';
        $old_image = $image_path.$logo->logo;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }

        try{
            $bug=0;
            $logo->delete();
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
