<?php

namespace App\Http\Controllers;

use App\Http\Resources\GetAllPostResource;
use App\Http\Resources\SearchResource;
use App\Models\Post;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $posts = Post::with('pembuatPost')->get();

        return GetAllPostResource::collection($posts);
    }

    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        $search = Post::where('judulPost', 'like', '%' . $keyword . '%')->orWhere('postingan', 'like', '%' . $keyword . '%')->get();

        return response()->json(['Hasil Pencarian' => SearchResource::collection($search)]);
    }
}
