<?php

namespace App\Http\Controllers;

use App\Models\PostModels;
use Illuminate\Http\Request;

class WebindexController extends Controller
{
    public function index()
    {
        $posts = PostModels::join('users', 'users.id', 'post_models.userid')
        ->select('post_models.*', 'users.name')
        ->orderBy('post_models.id', 'DESC')
        ->paginate(10);

        return view('webboard', ['posts' => $posts]);
    }
}
