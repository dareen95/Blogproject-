<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //

    public function index(){
        $name= 'index';
        return view('pages.index')->with('name',$name );
    }

    function about() {
        $name= 'about';
        return view('pages.about')->with('name',$name );
      }

      function proLanguage() {
        
        $myname= array('J'=>'JAVA','C'=>'C++','P'=>'PHP');
        return view('pages.prolanguage')->with('myname', $myname );
      }
 
}
