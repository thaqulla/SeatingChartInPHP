<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }
    public function upload(Request $request) {     
        // ファイルを開く
        // r	読み込み専用
        // w	書き出し専用
        // a	追加書き出し
        $file = $request->file('scoreFiles');
        $filePath = $file->getPathname();

        // $data = []; // 表示するデータを格納する配列
        $headerSkipped = false;
        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                if (!$headerSkipped) {
                    $headerSkipped = true;
                    continue; // ヘッダー行をスキップして次のイテレーションへ
                }
                $score = new Score();
                $score->studentId = $row[0];
                $score->student_id = $row[0];
                $score->testName = $row[1];
                $score->fourScore = $row[2];
                $score->fourDeviation = floatval($row[3]);
                $score->mathScore = $row[4];
                $score->mathDeviation = floatval($row[5]);
                $score->JapaneseScore = $row[6];
                $score->JapaneseDeviation = floatval($row[7]);
                $score->scienceScore = $row[8];
                $score->scienceDeviation = floatval($row[9]);
                $score->societyScore = $row[10];
                $score->societyDeviation = floatval($row[11]);
                $score->save();
            }
    
            fclose($handle);
        }
        return redirect()->route('seats.index')->with('flash_message', '更新が完了しました。');
    }

    // public function import(Request $request)
    // {
    //     // バリデーションルールの定義
    //     $validator = Validator::make($request->all(), [
    //         'file' => 'required|mimes:csv,txt'
    //     ]);
    
    //     // バリデーションエラーの場合、エラーメッセージを返す
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator->errors());
    //     }
    
    //     // アップロードされたファイルを取得し、解析する
    //     $file = $request->file('file');
    //     $data = array_map('str_getcsv', file($file->path()));
    
    //     // 解析したデータをデータベースに保存する
    //     foreach ($data as $row) {
    //         Grade::create([
    //             'student_name' => $row[0],
    //             'subject' => $row[1],
    //             'score' => $row[2],
    //         ]);
    //     }
    
    //     // 成功時のリダイレクト先を指定する
    //     return redirect()->back()->with('success', '成績データが正常にインポートされました。');
    // }
}
