<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FeatureTitle;
use DB;
use Session;
use Response;
use Validator;

class FeatureTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = FeatureTitle::where('status',1)->paginate(10);
        return view('admin.feature_title.List',compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feature_title.add_edit');
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
                'image'=>'mimes:jpeg,jpg,png,gif|required|max:2000'
                
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
        $input['status'] = 1;

        $image = $request->file('image');
        if ($image) {
            //$img_name = $image->getClientOriginalName();
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = uniqid().".".$ext;
            $image_path = 'frontend/images/product/';
            $image_url = $image_path.$image_full_name;
            $success=$image->move($image_path,$image_full_name);
            if ($success) {
                $input['image'] = $image_full_name;
            }            
        }else{
            $input['image'] = 'default.png';
        }

        try{
            $bug = 0;
            $insert = FeatureTitle::create($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Image Added Successfully !');
        return redirect('/admin/title')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/title')->with('status_color','danger');
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
        $single_title = FeatureTitle::findOrFail($id);
        return view('admin.feature_title.add_edit',compact('single_title'));

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
                'image'=>'mimes:jpeg,jpg,png,gif|max:2000'
                
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
        
        $part = FeatureTitle::findOrFail($id);
        $input = $request->all();
        //return $input;
        $input['title'] = $request->title;
        $input['status'] = 1;

        if (($request->file('image')) !== ($part->image)) {

         $image = $request->file('image');
           if ($image) {
            //$img_name = $image->getClientOriginalName();
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = uniqid().".".$ext;
            $image_path = 'frontend/images/product/';
            $image_url = $image_path.$image_full_name;
            $success=$image->move($image_path,$image_full_name);
            if ($success) {
                $old_image = $image_path.$part->image;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
                $input['image'] = $image_full_name;
                
            }            
        }
            
        }else{
            $input['image'] = $part->image;
        }

        try {
            $bug = 0;
            //$data = BikePart::update($input);
            $part->update($input);
            
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Data Added Successfully !');
        return redirect('/admin/title')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/title')->with('status_color','danger');
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
        $title = FeatureTitle::findOrFail($id);
        $image_path = 'frontend/images/parts/';
        $old_image = $image_path.$title->image;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }

        try{
            $bug=0;
            $title->delete();
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
