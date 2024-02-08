<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailPostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // Memeriksa apakah user sudah login
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'judulPost' => 'required|string',
            'postingan' => 'required',
            'pembuat_post' => 'required',
        ]);

        Post::create([
            'judulPost' => $request->judulPost,
            'postingan' => $request->postingan,
            'pembuat_post' => Auth::user()->id,
        ]);

        return response()->json(['message' => 'Postingan berhasil dibuat'], 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Memeriksa apakah user memiliki hak untuk mengupdate
        if ($post->pembuat_post != Auth::user()->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'judulPost' => 'required|string',
            'postingan' => 'required',
        ]);

        $post->update([
            'judulPost' => $request->judulPost,
            'postingan' => $request->postingan,
        ]);

        return response()->json(['message' => 'Postingan berhasil diperbarui'], 200);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->pembuat_post != Auth::user()->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $post->delete();

        return response()->json(['message' => 'Postingan berhasil dihapus'], 200);
    }

    // * Lihat Detail Postingan + (Komentar)
    public function read($id)
    {
        $postingan =  Post::with('komen')->findOrFail($id);

        return new DetailPostResource($postingan);
    }
}
