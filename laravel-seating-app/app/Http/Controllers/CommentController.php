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
    public function index() {

        $seats = Seat::orderBy('ruby','asc')->get();
        $comments = Auth::user()->comments;
        return view('seats.index', compact('seats','comments'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->user_id = Auth::id();
        // $comment->seat_id = $request->input('seat_id');
        $comment->save();

        return redirect()->route('comments.index');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Comment  $comment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Comment $comment)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Comment  $comment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Comment $comment)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment->title = $request->input('comment');
        $comment->user_id = Auth::id();
        // $comment->seat_id = $request->input('seat_id');
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
