<?php

namespace App\Http\Controllers;

use App\Models\Komen;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomenController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // Memeriksa apakah user sudah login
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $postIds = $request->validate([
            'post_id' => 'required',
            'pembuat_komen' => 'required',
            'isi_komen' => 'required',
        ]);

        $post = Post::findOrFail($postIds['post_id']);

        $komen = $post->komen()->create([
            'post_id' => $postIds['post_id'],
            'pembuat_komen' => $postIds['pembuat_komen'],
            'isi_komen' => $postIds['isi_komen'],
        ]);

        return response()->json(['message' => 'Komen berhasil di posting'], 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Memeriksa apakah user sudah login
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $komen = Komen::findOrFail($id);

        // Memeriksa apakah user memiliki hak untuk mengupdate komen
        if ($komen->pembuat_komen != $user->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'isi_komen' => 'required',
        ]);

        $komen->update([
            'isi_komen' => $request->isi_komen,
        ]);

        return response()->json(['message' => 'Komen diperbarui'], 200);
    }

    public function destroy($id)
    {
        $user = Auth::user();

        // Memeriksa apakah user sudah login
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $komen = Komen::findOrFail($id);

        if ($komen->pembuat_komen != $user->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $komen->delete();

        return response()->json(['message' => 'Komentar berhasil dihapus'], 200);
    }
}
