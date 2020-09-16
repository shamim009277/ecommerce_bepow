<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MainBanner;
use DB;
use Session;
use Response;
use Validator;

class MainBannerController extends Controller
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
        $main_banners = MainBanner::paginate(10);
        return view('admin.main_banner.List',compact('main_banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.main_banner.add_edit');
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
            
                'title'  =>'required | max:70',
                'content'=>'required | max:200',
                'image'  =>'mimes:jpeg,jpg,png,gif|required|max:2000'
                
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
        $input['content'] = $request->content;

        $image = $request->file('image');
        if ($image) {
            //$img_name = $image->getClientOriginalName();
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = uniqid().".".$ext;
            $image_path = 'frontend/images/banner/';
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
            $insert = MainBanner::create($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Data Added Successfully !');
        return redirect('/admin/main_banners')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/main_banners')->with('status_color','danger');
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
        $single_banner = MainBanner::findOrFail($id);
        return view('admin.main_banner.add_edit',compact('single_banner'));
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
            
                'title'  =>'required | max:70',
                'content'=>'required | max:200',
                'image'  =>'mimes:jpeg,jpg,png,gif|max:2000'
                
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

        $banner = MainBanner::findOrFail($id);
        $input = $request->all();
        //return $input;
        $input['title'] = $request->title;
        $input['content'] = $request->content;

        if (($request->file('image')) !== ($banner->image)) {

         $image = $request->file('image');
           if ($image) {
            //$img_name = $image->getClientOriginalName();
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = uniqid().".".$ext;
            $image_path = 'frontend/images/banner/';
            $image_url = $image_path.$image_full_name;
            $success=$image->move($image_path,$image_full_name);
            if ($success) {
                $old_image = $image_path.$banner->image;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
                $input['image'] = $image_full_name;
                
            }            
        }
            
        }else{
            $input['image'] = $banner->image;
        }

        try {
            $bug = 0;
            //$data = BikePart::update($input);
            $banner->update($input);
            
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Data Added Successfully !');
        return redirect('/admin/main_banners')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/main_banners')->with('status_color','danger');
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
        $banner = MainBanner::findOrFail($id);
        $image_path = 'frontend/images/banner/';
        $old_image = $image_path.$banner->image;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }

        try{
            $bug=0;
            $banner->delete();
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
