<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Comment;
use App\Http\Controllers\CommentsController;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * $value = str_limit('posts', 50)
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        $this->validate($request, [
           'title' => 'required',
           'body' => 'required',
           'cover_image' => 'image|nullable|max:1999'
        ]);

        $notification = array(
            'message' => 'You have successfully made a new post!',
            'alert-type' => 'success'
        );

        if ($request->hasFile('cover_image')) {
          $file = $request->file('cover_image');
          $post = new Post;
          $post->title = $request->input('title');
          $post->body = $request->input('body');
          $post->user_id = auth()->user()->id;
          $post->cover_image = $file->move('img', $file->getClientOriginalName());
          $post->save();

          return redirect('/posts')->with($notification);
        } else {
          $post = new Post;
          $post->title = $request->input('title');
          $post->body = $request->input('body');
          $post->user_id = auth()->user()->id;
          $post->cover_image = 'img/noimage.jpg';
          $post->save();

          return redirect('/posts')->with($notification);
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


        $post = Post::find($id);
        $comments = DB::table('comments')
                        ->where('post_id', '=', $post->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('posts.show', ['post' => $post])->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = array(
            'message' => 'Unauthorized Page',
            'alert-type' => 'error'
        );

        $notificationUnAuth = array(
            'message' => 'Unauthorized Page',
            'alert-type' => 'error'
        );

        $post = Post::find($id);
        // Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('post', $post)->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
           'title' => 'required',
           'body' => 'required'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')) {
            // Get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get filename only
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        $notification = array(
            'message' => 'You post has successfully been updated!',
            'alert-type' => 'info'
        );

        // Update Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }
        if(Auth::check()){
           $post->save();
        } else {
             return redirect('/posts')->with('post', $post)->with('error', 'Unauthorized Page');
        }

        return redirect('/posts')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = array(
            'message' => 'You post has successfully been deleted!',
            'alert-type' => 'error'
        );

            // Uncomment to switch to popup notification
        // $notificationUnAuth = array(
        //     'message' => 'Unauthorized Page',
        //     'alert-type' => 'error'
        // );

        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('post', $post)->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'noimage.jpg') {
            // Erase Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with($notification);
    }
}
