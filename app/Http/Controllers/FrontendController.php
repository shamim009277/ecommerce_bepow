<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeatureOverview;
use App\FeatureTitle;
use App\ProductItem;
use App\ProductImage;
use App\BikePart;

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
        

        $parts = BikePart::where('status',1)->get();
        $tittles = FeatureOverview::with(['feature'])->where('status',1)->get();
        //$product = ProductItem::where('status',1)
        $product_images = ProductImage::where('status',1)->get();
        return view('frontend.home',compact('tittles','product_images','parts','posts'));
    }

    public function show_about(){
        return view('frontend.about');
    }

    public function show_blog(){
       return view('frontend.blog');
    }

    public function show_product_details(){

        $product_images = ProductImage::where('status',1)->get();
       return view('frontend.product_details',compact('product_images'));
    }

}
