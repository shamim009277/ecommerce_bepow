<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BikePart;
use App\Blog;
use App\Testimonial;
use App\Contact;
use DB;
use Session;
use Response;
use Validator;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showStatusForm($id){
        $id = $id;
    	return view('admin.order_status_change',compact('id'));
    }

    public function changeOrderStatus(Request $request){

        $validator = Validator::make($request->all(),[
            
                'status'=>'required',   
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
        try {

        $id=$request->order_id;
        $value=$request->status;
        
        DB::table('oreders')
    	      ->where('id',$id)
    	      ->update(['status'=>$value]);

    	Session::flash('flash_message','Status Changed Successfully !');
        return redirect('/admin/manage_orders')->with('status_color','success');
        	
        } catch (Exception $e) {
        	Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }      
    	
    }

    public function unactiveParts($id){

        BikePart::where('id',$id)
                 ->update(['status'=>0]);
        Session::flash('flash_message','Status Changed Successfully');
        return redirect()->back()->with('status_color','success');
    }

    public function activeParts($id){

        BikePart::where('id',$id)
                 ->update(['status'=>1]);
        Session::flash('flash_message','Status Changed Successfully');
        return redirect()->back()->with('status_color','success');
    }

    public function unactiveBlogs($id){

        Blog::where('id',$id)
                 ->update(['status'=>0]);
        Session::flash('flash_message','Status Changed Successfully');
        return redirect()->back()->with('status_color','success');
    }

    public function activeBlogs($id){

        Blog::where('id',$id)
                 ->update(['status'=>1]);
        Session::flash('flash_message','Status Changed Successfully');
        return redirect()->back()->with('status_color','success');
    }

    public function unactiveTestimonial($id){

        Testimonial::where('id',$id)
                 ->update(['status'=>0]);
        Session::flash('flash_message','Status Changed Successfully');
        return redirect()->back()->with('status_color','success');
    }

    public function activeTestimonial($id){

        Testimonial::where('id',$id)
                 ->update(['status'=>1]);
        Session::flash('flash_message','Status Changed Successfully');
        return redirect()->back()->with('status_color','success');
    }

    public function activeContact($id){
        Contact::where('id',$id)
                 ->update(['status'=>0]);
        Session::flash('flash_message','Status Changed Successfully');
        return redirect()->back()->with('status_color','success');
    }

    public function destroy($id){
        $message = Contact::findOrFail($id);

        try{
            $bug=0;
            $delete = $message->delete();
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

    public function serve(){
        return view('admin.404');
    }
}
