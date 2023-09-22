<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
class PostController extends Controller
{
    public function index(){
       // $posts=Post::all();
        /**
         * for making authentication
         *  dd($posts);
         */

        //$posts=auth()->user()->posts;
        //to make pagination i should make posts as method not as a proparty this will give me the ability to use paginate()
        $posts=auth()->user()->posts()->paginate(5);


        return view('admin.posts.index',['posts'=>$posts]);
    }

    public function show(Post $post)
    {

        return view('blog-post', ['post' => $post]);
    }

    public function create()
    {
        $this->authorize('create',Post::class);
        return view('admin.posts.create');
    }

    public function store()
    {
        //i can access user with helper fn like this to associate the use with post
        // Auth::user();
        //or
       // auth()->user();
        // dd(request()->all());
        $this->authorize('create',Post::class);
        $inputs = request()->validate([
            'title' => 'required|min:8',
            'post_image' => 'file',
            'body' => 'required'
        ]);
        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }
        auth()->user()->posts()->create($inputs);
        session()->flash('post-created-message','Post with title '.$inputs['title'].' was created');
        return redirect()->route('post.index');
    }

    public function edit(Post $post){
        //i will make this in route
       // $this->authorize('view',$post);
        /**
         * or
       *   if(auth()->user()->can('view',$post)){
            return view('admin.posts.edit',['post'=>$post]);
           }
         * */
        return view('admin.posts.edit',['post'=>$post]);
    }

    public function update(Post $post){

        $inputs = request()->validate([
            'title' => 'required|min:8',
            'post_image' => 'file',
            'body' => 'required'
        ]);
        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image=$inputs['post_image'];
        }
        $post->title=$inputs['title'];
        $post->body=$inputs['body'];
        //authorization from PostPolicy
        //to update i should pass the post model to work as if i don't put the post model every post wiil not update if it's not mine
        $this->authorize('update',$post);
        $post->update();
        //or  $post->save();
        Session::flash('post-updated-message','Post with title '.$inputs['title'].' was updated');
        return redirect()->route('post.index');
    }

    public function destroy(Post $post/*,Request $request*/){
        $this->authorize('delete',$post);
        $post->delete();
        //or
        /*
        $request->session()->flash('message','Post was deleted');
        */
        Session::flash('message','Post was deleted');
        return back();
    }

}

//    public function store(Request $request){
////        //i can access user with helper fn like this to associate the use with post
////        // Auth::user();
////        //or
////        auth()->user();
////        // dd(request()->all());
////        $inputs= request()->validate([
////            'title'=>'required|min:8',
////            'post_image'=>'file',
////            'body'=>'required'
////        ]);
////        if(request('post_image')){
////            $inputs['post_image']=request('post_image')->store('images');
////        }
////        dd($request->post_image);
////        //or
////        dd($request->input('post_image'));
////    }
//}
