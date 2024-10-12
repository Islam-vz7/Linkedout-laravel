<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
{
    $request->validate([
        'content' => 'required|string',
    ]);

    $comment = Comment::create([
        'post_id' => $postId,
        'user_id' => Auth::user()->id,
        'content' => $request->input('content'),
    ]);

    $userName = Auth::user()->name;
    $createdAt = $comment->created_at->diffForHumans(); 

    return response()->json([
        'success' => true,
        'user' => $userName,
        'comment' => [
            'content' => $comment->content,
            'created_at' => $createdAt
        ]
    ]);
}

    public function deleteComment($id){
        $comment = Comment::find($id);
        if($comment){
            $comment->delete();
            
        }
        return redirect()->back()->with('success', 'Comment deleted successfully');
    }



}
