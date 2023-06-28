<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

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
        //
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Score  $score
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Score $score)
    // {
    //     //
    // }


    










    public function upload(Request $request)
    {
        // アップロードされたファイルを取得
        $file = $request->file('file');

        // ファイルのバリデーションチェック
        if (!$file->isValid()) {
            return redirect()->back()->withErrors(['file' => 'ファイルのアップロードに失敗しました。']);
        }

        // ファイルの保存先パスを指定
        $path = $file->store('scores');

        // 成功時の処理やデータベースへの保存などを行う

        return redirect()->back()->with('success', 'ファイルが正常にアップロードされました。');
    }

    public function import(Request $request)
    {
        // バリデーションルールの定義
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt'
        ]);
    
        // バリデーションエラーの場合、エラーメッセージを返す
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
    
        // アップロードされたファイルを取得し、解析する
        $file = $request->file('file');
        $data = array_map('str_getcsv', file($file->path()));
    
        // 解析したデータをデータベースに保存する
        foreach ($data as $row) {
            Grade::create([
                'student_name' => $row[0],
                'subject' => $row[1],
                'score' => $row[2],
            ]);
        }
    
        // 成功時のリダイレクト先を指定する
        return redirect()->back()->with('success', '成績データが正常にインポートされました。');
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Score  $score
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Score $score)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Score  $score
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Score $score)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Score  $score
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Score $score)
    // {
    //     //
    // }
}
