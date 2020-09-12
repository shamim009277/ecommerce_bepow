<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeatureOverview;
use Response;
use Validator;
use Session;
use App\FeatureTitle;
use App\ProductItem;
use App\ProductImage;
use App\BikePart;
use App\Blog;
use App\About;
use App\Testimonial;
use App\Contact;

class FrontendController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show_home()
    {
        
        function processURL($url)
        {
            $ch = curl_init();
            curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2
            ));
         
           $result = curl_exec($ch);
           curl_close($ch);
           return $result;
        }   

        $url = "https://v1.nocodeapi.com/towhid009/instagram/MENhHevwrPiMSPsp";

        $all_result = processURL($url);
        $decoded_results = json_decode($all_result, true);
        $posts = $decoded_results['data'];
        
        
        $testimonials = Testimonial::where('status',1)->get();
        $parts = BikePart::where('status',1)->get();
        $tittles = FeatureOverview::with(['feature'])->where('status',1)->get();
        //$product = ProductItem::where('status',1)
        $product_images = ProductImage::where('status',1)->get();
        return view('frontend.home',compact('tittles','product_images','parts','posts','testimonials'));
    }

    public function show_about(){
        $about = About::first();
        $testimonials = Testimonial::where('status',1)->get();
        return view('frontend.about',compact('about','testimonials'));
    }

    public function show_blog(){

       $blogs = Blog::where('status',1)->paginate(2); 
       return view('frontend.blog',compact('blogs'));
    }

    public function show_contact(){
        return view('frontend.contact');
    }

    public function blog_details($id){
        $blog = Blog::where('id',$id)->first();
        $titles = Blog::where('title','!=',$blog->title)->get(); 
       return view('frontend.blog_details',compact('blog','titles'));
    }

    public function show_product_details(){

        $product_images = ProductImage::where('status',1)->get();
        $testimonials = Testimonial::where('status',1)->get();
       return view('frontend.product_details',compact('product_images','testimonials'));
    }

    public function messageStore(Request $request){

        $validator = Validator::make($request->all(),[
            
            'first_name'=>'required | regex:/^[A-Za-z]+/',
            'last_name' =>'required | regex:/^[A-Za-z]+/',
            'email'     =>'required',
            'phone'     =>'required | regex:/^[0-9_]{11}/',
            'message'   =>'required'   
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
        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['email'] = $request->email;
        $input['phone'] = $request->phone;
        $input['message'] = $request->message;
        $input['status'] = 1;

        try{
            $bug = 0;
            $insert = Contact::create($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
        Session::flash('flash_message','Your Message Send Successfully ! We Will Contact You Shortly--');
        return redirect()->back()->with('status_color','success');
        }else{
        Session::flash('flash_message','Something Error Found.');
        return redirect()->back()->with('status_color','danger');
        }
    }

}
