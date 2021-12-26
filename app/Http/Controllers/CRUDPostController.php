<?php

namespace App\Http\Controllers;

use App\Models\CommentModels;
use App\Models\PostModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CRUDPostController extends Controller
{
    public function CreatePost()
    {
        return view('create-post');
    }

    public function StorePost(Request $request)
    {
        $rule = [
            'title' => 'required',
            'detail' => 'required'
        ];
        $request->validate($rule);

        $post = new PostModels();
        $post->title = $request->title;
        $post->detail =$request->detail;
        $post->view = 0;
        $post->ans = 0;
        $post->userid = Auth::user()->id;
        $post->save();

        session()->flash('success', 'ตั้งกระทู้เรียบร้อยแล้ว');
        if (Auth::user()->role == 'ADM') {
            return redirect()->route('admin.index');
        }
        else
            return redirect()->route('user.index');
    }

    public function viewer($id)
    {
        $post = PostModels::join('users', 'users.id', 'post_models.userid')
            ->where('post_models.id',$id)
            ->select('post_models.*', 'users.name')
            ->first();

        $comments = CommentModels::where('idPost', $id)
            ->join('users', 'users.id', 'comment_models.userid')
            ->select('comment_models.*', 'users.name')
            ->orderBy('comment_models.id', 'ASC')->get();

        $post->view = $post->view+1;
        $post->save();
        
        return view('view-post', ['post'=>$post, 'comments' => $comments]);
    }


    public function CommentPost(Request $request)
    {
        $rule = [
            'detail' => 'required'
        ];

        $request->validate($rule);

        $comment = new CommentModels();
        $comment->idPost = $request->idPost;
        $comment->detail = $request->detail;
        $comment->userid = Auth::user()->id;
        $comment->save();

        $ans = PostModels::find($request->idPost);
        $ans->ans = $ans->ans+1;
        $ans->save();

        session()->flash('success', 'แสดงความคิดเห็นเรียบร้อยแล้ว');
        if (Auth::user()->role == 'ADM') {
            return redirect()->route('admin.viewpost', ['id' => $request->idPost]);
        } else {
            return redirect()->route('user.viewpost', ['id' => $request->idPost]);
        }
        
    }


    public function DeletePost($id)
    {
        $post = PostModels::find($id);
        $post->delete();

        $comment = CommentModels::where('idPost', $id);
        $comment->delete();


        return redirect()->route('admin.index');
    }
}
