<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use DB;
use Session;
use Response;
use Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where('status',1)->paginate(10);
        return view('admin.blog_content.List',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog_content.add_edit');
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
            
                'title'=>'required',    
                'content'=>'required',    
                'image'=>'mimes:jpeg,jpg,png,gif|required'
                
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
        $input['status'] = 1;

        $image = $request->file('image');
        if ($image) {
            //$img_name = $image->getClientOriginalName();
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = uniqid().".".$ext;
            $image_path = 'frontend/images/blog/';
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
            $insert = Blog::create($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Blog Content Added Successfully !');
        return redirect('/admin/blogs')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/blogs')->with('status_color','danger');
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
        $blog = Blog::findOrFail($id);
        return view('admin.blog_content.add_edit',compact('blog'));
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
            
                'title'=>'required',    
                'content'=>'required',    
                'image'=>'mimes:jpeg,jpg,png,gif'
                
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
        $blog = Blog::findOrFail($id);
        $input = $request->all();
        //return $input;
        $input['title'] = $request->title;
        $input['content'] = $request->content;

        if (($request->file('image')) !== ($blog->product_image)) {

         $image = $request->file('image');
           if ($image) {
            //$img_name = $image->getClientOriginalName();
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = uniqid().".".$ext;
            $image_path = 'frontend/images/blog/';
            $image_url = $image_path.$image_full_name;
            $success=$image->move($image_path,$image_full_name);
            if ($success) {
                $old_image = $image_path.$blog->product_image;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
                $input['image'] = $image_full_name;
                
            }            
        }
            
        }else{
            $input['image'] = $blog->image;
        }
        try{
            $bug = 0;
            $blog->update($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Blog Content Updated Successfully !');
        return redirect('/admin/blogs')->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect('/admin/blogs')->with('status_color','danger');
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
        $sin_data = Blog::findOrFail($id);
        $image_path = 'frontend/images/blog/';
        $old_image = $image_path.$sin_data->image;
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
