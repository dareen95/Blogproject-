<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CloudderController extends Controller
{
    public function getFile(){        
        return view('cloudder');
    }
    public function uploadFile(Request $request){
          if($request->hasFile('image_file')){  
            \Cloudder::upload($request->file('image_file'));
            $c=\Cloudder::getResult();             
            if($c){
               return back()
                    ->with('success','You have successfully upload images.')
                    ->with('image',$c['url']);
            }
            
        }
    }

}
