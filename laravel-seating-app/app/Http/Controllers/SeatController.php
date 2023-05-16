<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// やりとりするモデルを宣言する
use App\Models\Seat;


class SeatController extends Controller
{
    public function index() {        
        return view('seats.index');
    }
    // 作成ページ
    public function create() {
        return view('seats.create');
    }
    // 作成機能
    public function store(Request $request) {
        $seat = new Seat();
        // $seat->title = $request->input('title');
        // $seat->content = $request->input('content');
        $seat->studentId = $request->input('studentId');
        $seat->name = $request->input('name');
        $seat->ruby = $request->input('ruby');
        $seat->courceOld = $request->input('courceOld');
        $seat->courceNow = $request->input('courceNow');
        $seat->newStudent = $request->input('newStudent');
        $seat->forward = $request->input('forward');
        $seat->remarks = $request->input('remarks');
        $seat->save();

        return redirect()->route('seats.index')->with('flash_message', '更新が完了しました。');
    }
}


