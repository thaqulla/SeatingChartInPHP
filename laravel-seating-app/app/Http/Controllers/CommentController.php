<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seat $seat) {
        $cources = Seat::
            select('courceNow')
            ->orderBy('courceNow','asc')
            ->distinct() //重複除外
            ->get()
            ->pluck('courceNow') //値のみ取得
            ->toArray();

        $seats = Seat::orderBy('ruby','asc')->get();
        $comments = Auth::user()->comments;
        
        return view('seats.index', compact('seats','cources','comments'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'comment' => 'required',
        ]);

        // dd($request);
        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->user_id = Auth::id();
        $comment->save();

        $comment->seats()->sync($request->input('seat_ids'));

        return redirect()->route('seats.report');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment, Seat $seat)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment->title = $request->input('comment');
        $comment->user_id = Auth::id();
        $comment->seat_id = $seat->id;
        $comment->save();

        return redirect()->route('comments.index');  
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index');
    }
}
