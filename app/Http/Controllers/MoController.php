<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MoController extends Controller
{
    
    public function index(Request $request)
    {
        $comments = Comment::latest()->paginate(15);
        if ($request->ajax()) {
            $view = view('test.load', compact('comments'))->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $comments->nextPageUrl()]);
        }
        return view('test.index', compact('comments'));
    }

    // public function show()
    // {
    //     $comments=Comment::latest()->paginate(15);
    //     return view('comments.showTable' , compact('comments'));

    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'comment' => 'required',
        ]);

        $comment = Comment::create([
            'name' => $request->name,
            'comment' => $request->comment,
        ]);

        return response()->json($comment);
    }

    public function update(Request $request)
    {
        $comment = Comment::findOrFail($request->id);

        $request->validate([
            'id'=>'exists:comments,id',
            'name' => 'required',
            'comment' => 'required',
        ]);

        $comment->update([
            'name' => $request->name,
            'comment' => $request->comment,
        ]);

        return response()->json($comment);
    }

    public function destroy(Request $request)
    {
         Comment::destroy($request->id);
        return response()->json(['message' => 'Comment deleted successfully']);
    }

}
