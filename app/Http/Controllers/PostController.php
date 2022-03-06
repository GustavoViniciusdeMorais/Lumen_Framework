<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        try {
            $posts = Post::all();

            $result['data'] = $posts;
            $result['status'] = 'success';

            return response()->json($result);
        } catch (Exception $e) {
            $result = [
                'msg' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTrace()
            ];

            return response()->json($result);
        }
    }

    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);

            $result['data'] = $post;
            $result['status'] = 'success';

            return response()->json($result);
        } catch (Exception $e) {
            $result = [
                'msg' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTrace()
            ];

            return response()->json($result);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required',
                'body' => 'required'
            ]);
            
            $post = new Post();
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->save();

            $result['data'] = $post;
            $result['status'] = 'success';

            return response()->json($result);
        } catch (Exception $e) {
            $result = [
                'msg' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTrace()
            ];

            return response()->json($result);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'title' => 'required',
                'body' => 'required'
            ]);
            
            $post = Post::findOrFail($id);
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->save();

            $result['data'] = $post;
            $result['status'] = 'success';

            return response()->json($result);
        } catch (Exception $e) {
            $result = [
                'msg' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTrace()
            ];

            return response()->json($result);
        }
    }
}
