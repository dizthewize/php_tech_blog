<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\Post;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $notification = array(
            'message' => 'Your comment has now posted', 
            'alert-type' => 'success'
        );

        $this->validate($request, [
           'comment' => 'required|min:5|max:1000'
        ]);

        $post = Post::find($post_id);

        $comment = new Comment;
        $comment->comment = $request->input('comment');
        $comment->user_id = auth()->user()->id;
        $comment->username = auth()->user()->username;
        $comment->post()->associate($post);
        $comment->save();

        return redirect()->action(
            'PostsController@show', ['id' => $post->id]
        )->with( $notification);

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
    public function edit($id, $post_id)
    {
        // $notification = array(
        //     'message' => 'Your comment has successfully been edited!', 
        //     'alert-type' => 'info'
        // );
        // $post = App\Post::find($post_id);
        // $comment = Comment::find($id);
        // // Check for correct user
        // if(Auth::user()->id !== $comment->user_id){
        //     return redirect('/posts')->with('post', $post)->with('error', 'Unauthorized Entry');
        // } else {

        // }
        // return view('posts.show/{$post->id}')->with('post', $post)-with($notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $post_id)
    {
        // $notification = array(
        //     'message' => 'Your comment has now been updated', 
        //     'alert-type' => 'info'
        // );

        // $this->validate($request, [
        //    'comment' => 'required|min:5|max:1000'
        // ]);

        // $post = App\Post::find($post_id);

        // $comment = Comment::find($id);
        // $comment->comment = $request->input('comment');
        // if(Auth::check()){
        //    $comment->save();
        // } else {
        //      return redirect('/posts.show/{$post->id}')->with('error', 'Unauthorized User');
        // }
        // return redirect('/posts.show/{$post->id}')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {   
        $notification = array(
            'message' => 'You post has successfully been deleted!', 
            'alert-type' => 'error'
        );

        $post = Post::find($id);
        $comment = Comment::find($post_id);
        if(Auth::user()->id !== $comment->user_id){
           return redirect()->action(
            'PostsController@show', ['id' => $post->id]
            )->with('error', 'Unauthorized User');
        } else {
            $comment->delete();
            return redirect()->action(
            'PostsController@show', ['id' => $post->id]
        )->with( $notification);
        }
        
    }
}
