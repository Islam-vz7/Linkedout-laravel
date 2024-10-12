<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{

    public function create()
    {
       return view('user.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required','string'],
            'image'   => ['nullable','image','mimes:jpeg,png,jpg,gif,webp','max:10000'],
        ]);

        $data = [
            'content'=> $request['content'],
            'user_id' => Auth::user()->id,
        ];

        if($request->hasFile('image')){
            $image = $request->file('image');
            $data['image'] = $image->storeAs('/img', time() . '.' . $image->extension(), 'public');


        }


        Post::create($data);


        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function showEdit(){

        $posts=Post::all();
        return view('user.edit-profile',compact('post'));

    }

    public function deletePost(Request $request, $id){
        $post = Post::find($id);
        if($post){
            $post->delete();
        }
        return redirect()->back()->with('success', 'Post deleted successfully!');
    }

    public function editPost(Request $request, int $id){
        $post=Post::find($id);
        if($post){

            return view('user.edit-post',compact('post'));
        }
        else{
            echo 'hide';
        }
    }

    public function updatePost(Request $request , $id){
        $request->validate([
            'content' => ['required','string'],
            'image'   => ['nullable','image','mimes:jpeg,png,jpg,gif,webp','max:2048'],
        ]);
        
        $data=[
            'content' => $request['content'],
            'user_id' => Auth::user()->id,
        ];

        $post=Post::find($id);
        if($post){
            if ($request->hasFile('image')) {

                $image = $request->file('image');

                Storage::disk('public')->delete($post->image);

                $data['image'] = $image->storeAs('/img', time() . '.' . $image->extension(), 'public');
            }

            $post->update($data);
            return redirect('/users')->with('success', 'Post updated successfully!');

        }
        


    }

    public function index()
{
    $users = User::with('posts')->has('posts')->get();

    return view('user.index', compact('users'));
}

    public function showComment($id)
    {
        $post = Post::with('comments.user')->findOrFail($id);

        return view('post.show', compact('post'));
    }



}
