<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// やりとりするモデルを宣言する
use App\Models\Seat;
// 大規模ファイルのダウンロードに使用
use Symfony\Component\HttpFoundation\StreamedResponse;


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
    //csvダウンロード機能
    public function downloadcsv() {
        $seats = Seat::all();
        $csvHeader = [
            'id',
            'studentId',
            'name',
            'ruby',
            'courceOld',
            'courceNow',
            'newStudent',
            'forward',
            'remarks',
            'created_at',
            'updated_at'
        ];
        $csvData = $seats->toArray();
        
        $filename = 'studentLists'. date('Ymd_His') .'.csv';

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);

        return $response;
    }

    // 作成機能
    public function store(Request $request) {
        $request->validate([
            'studentId' => 'required',
            'name' => 'required',
            'ruby' => 'required',
            'courceOld' => 'required',
            'courceNow' => 'required',
            'newStudent' => 'required',
            'forward' => 'required',
            'remarks' => 'required',
        ]);
        
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
        $request->validate([
            'studentId' => 'required',
            'name' => 'required',
            'ruby' => 'required',
            'courceOld' => 'required',
            'courceNow' => 'required',
            'newStudent' => 'required',
            'forward' => 'required',
            'remarks' => 'required',
        ]);

        $seat->studentId = $request->input('studentId');
        $seat->name = $request->input('name');
        $seat->ruby = $request->input('ruby');
        $seat->courceOld = $request->input('courceOld');
        $seat->courceNow = $request->input('courceNow');
        $seat->newStudent = boolval($request->input('newStudent'));
        $seat->forward = boolval($request->input('forward'));
        $seat->remarks = $request->input('remarks');
        $seat->save();

        return redirect()->route('seats.show', $seat)->with('flash_message', '生徒情報を編集しました。');
    }
    // 削除機能
    public function destroy(Seat $seat) {
        $seat->delete();

        return redirect()->route('seats.index')->with('flash_message', '生徒情報を削除しました。');
    }
}


