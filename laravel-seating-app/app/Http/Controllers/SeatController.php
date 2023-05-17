<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// やりとりするモデルを宣言する
use App\Models\Seat;


class SeatController extends Controller
{
    public function index() {        
        $seats = Seat::latest()->get();
        
        return view('seats.index',compact('seats'));
    }
    // 作成ページ
    public function create() {
        return view('seats.create');
    }
    // 作成機能
    public function store(Request $request) {
        $seat = new Seat();
        $seat->studentId = $request->input('studentId');
        $seat->name = $request->input('name');
        $seat->ruby = $request->input('ruby');
        $seat->courceOld = $request->input('courceOld');
        $seat->courceNow = $request->input('courceNow');
        $seat->newStudent = boolval($request->input('newStudent'));
        $seat->forward = boolval($request->input('forward'));
        $seat->remarks = $request->input('remarks');
        $seat->save();

        return redirect()->route('seats.index')->with('flash_message', '更新が完了しました。');
    }
    // 詳細ページ
    public function show(Seat $seat) {
        return view('seats.show', compact('seat'));
    }
    // 更新ページ
    public function edit(Seat $seat) {
        return view('seats.edit', compact('seat'));
    }
    // 更新機能
    public function update(Request $request, Seat $seat) {
        $seat->studentId = $request->input('studentId');
        $seat->name = $request->input('name');
        $seat->ruby = $request->input('ruby');
        $seat->courceOld = $request->input('courceOld');
        $seat->courceNow = $request->input('courceNow');
        $seat->newStudent = boolval($request->input('newStudent'));
        $seat->forward = boolval($request->input('forward'));
        $seat->remarks = $request->input('remarks');
        $seat->save();

        return redirect()->route('seats.show', $seat)->with('flash_message', '投稿を編集しました。');
    }
}


