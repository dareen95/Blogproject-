<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
 

class PostsController extends Controller
{


     
   public function __construct()
   {
       $this->middleware('auth',['except'=>['index','show']]);
   }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts =   Post::orderBy('created_at','desc')->take(1)->get();
    //    $posts =   Post::orderBy('created_at','desc')->get();
    $posts =   Post::orderBy('created_at','desc')->paginate(5);
       //$posts =   DB::select('select * FROM posts');
        
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request ,[
         'subject'=>'required',
         'firstname'=>'required',
         'lastname'=>'required',
         'body'=>'required',
         'post_image'=>'image|nullable|max:1024',
        ]);


        if($request->hasFile('post_image')){  

    $filenameWithExtention = $request->file('post_image')->getClientOriginalName();
    $fileName = pathinfo($filenameWithExtention,PATHINFO_FILENAME);
    $extension = $request->file('post_image')->getClientOriginalExtension();
    $fileNameStore = $fileName .'_'.time().'.'.$extension;

    $path = $request->file('post_image')->move(base_path() . '/public/images/', $fileNameStore);
  
 
            
        }else{
                $fileNameStore = 'noImage.jpg';
              }
 
// if($request->hasFile('post_image')){
//     $filenameWithExtention = $request->file('post_image')->getClientOriginalName();
//     $fileName = pathinfo($filenameWithExtention,PATHINFO_FILENAME);
//     $extension = $request->file('post_image')->getClientOriginalExtension();
//     $fileNameStore = $fileName .'_'.time().'.'.$extension;
//     $path = $request->file('post_image')->storeAs('public/post_image',$fileNameStore);
// }else{
//     $fileNameStore = 'noImage.jpg';
// }





 
$post = new Post;
$post->subject   = $request->input('subject');
$post->firstname = $request->input('firstname');
$post->lastname  = $request->input('lastname');
$post->body      = $request->input('body');
$post->user_id      =  auth()->user()->id;
$post->post_image      =  $fileNameStore;
$post->save();

        return redirect('/posts')->with('success', 'Done successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
       $post  =   Post::find($id);
       
       return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post  =   Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized');
        }

       
        
        return view('posts.edit')->with('post',$post);
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
        $this->validate($request ,[
            'subject'=>'required',
            'firstname'=>'required',
            'lastname'=>'required',
            'body'=>'required'
           ]);

           if($request->hasFile('post_image')){
            $filenameWithExtention = $request->file('post_image')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtention,PATHINFO_FILENAME);
            $extension = $request->file('post_image')->getClientOriginalExtension();
            $fileNameStore = $fileName .'_'.time().'.'.$extension;
          
            $path = $request->file('post_image')->move(base_path() . '/public/images/', $fileNameStore);
            // $path = $request->file('post_image')->storeAs('public/post_image',$fileNameStore);
        } 
        $post =   Post::find($id);
        $post->subject   = $request->input('subject');
        $post->firstname = $request->input('firstname');
        $post->lastname  = $request->input('lastname');
        if($request->hasFile('post_image')){
            $post->post_image      =   $fileNameStore;
        }
        $post->body      = $request->input('body');
        $post->save();
        
                return redirect('/posts')->with('success', 'Done successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =   Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized');
        }


if($post->post_image != 'noImage.jpg'){
    Storage::delete('public/images/'.$post->post_image);
 
}


        $post->delete() ;   
       
        return redirect('/posts')->with('success', 'Done successfully');
    }
}
