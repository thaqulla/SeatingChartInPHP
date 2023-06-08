<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// やりとりするモデルを宣言する
use App\Models\Seat;
use App\Models\Score;
// 大規模ファイルのダウンロードに使用
use Symfony\Component\HttpFoundation\StreamedResponse;
// バリデーションを行う
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
// phpMyAdmin上のカラム名の取得
use Illuminate\Support\Facades\Schema;
// graph
$JpGraph = base_path('vendor/jpgraph/src/');
require_once $JpGraph . 'jpgraph.php'; 
require_once $JpGraph . 'jpgraph_line.php';

class SeatController extends Controller
{
    public function index(Request $request) {            
        $request->validate([
            'studentId' => '',//required
            'name' => '',
            'ruby' => '',
        ]);

        $selectedStudentId = $request->input('studentId');
        $selectedName= $request->input('name');
        $selectedRuby = $request->input('ruby');

        $seats = Seat::orderBy('ruby','asc')->get();
        if ($selectedStudentId || $selectedName || $selectedRuby) {
            $seats = Seat::
            orderBy('ruby','asc')
            ->where('studentId','=', $selectedStudentId)
            ->orWhere('name' ,$selectedName)
            ->orWhere('ruby' ,$selectedRuby)
            ->get();

            $columns = Schema::getColumnListing('seat');
        }
        else {
            $seats = Seat::orderBy('ruby','asc')->get();
        }
        return view('seats.index',compact('seats'));
    }
    public function report(Request $request, Seat $seat) {        

        $selectedAlphabet = $request->input('alphabet');
        // 選択されたコースと一致するレコードを取得
        $seats = Seat::
            orderBy('ruby','asc')
            ->select('studentId','name','ruby','newStudent','forward')
            ->where('courceNow', $selectedAlphabet)
            ->get();
        
        $cources = Seat::
            select('courceNow')
            ->orderBy('courceNow','asc')
            ->distinct() //重複除外
            ->get()
            ->pluck('courceNow') //値のみ取得
            ->toArray();
        
        return view('seats.report',compact('seats', 'cources'));

    }

    public function search(Seat $seat) {     

        return view('seats.search', compact('seat'));
    }
    public function resultData(Request $request, Seat $seat) {        

        $selectedAlphabet = $request->input('search');

        // 入力のバリデーションを行う
        // $validator = Validator::make($request->all(), [
        //     'search' => [
        //         'required',
        //         'string',
        //         Rule::where(function ($query) use ($search) {
        //             $query->where('studentId', '=', $search)
        //                   ->orWhere('studentId', '=', mb_convert_kana($search, 'n'));
        //         })
        //     ],
        // ]);

        // 選択されたコースと一致するレコードを取得
        $result = Seat::
            where('ruby', 'like', "%", $search, "%")
            ->orWhere('studentId', '=', $search)
            ->get();
        
        return view('seats.show', compact('result'));
    }
    // 作成ページ
    public function create() {
    // $studentNumber = $request->input('student_number');

    // $existingStudent = Student::where('student_number', $studentNumber)->first();

    // if ($existingStudent) {
    //     return back()->with('error', '登録されていますよ');
    // }
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
    public function show(Seat $seat, Score $score) {

        function getMin($number) {
            if ($number % 10 === 0) {
                return $number - 10;
            } else {
                return floor($number / 10) * 10;
            }
        }

        function getMax($number) {
            if ($number % 10 === 0) {
                return $number + 10;
            } else {
                return ceil($number / 10) * 10;
            }
        }

        $privateScores = Score::
            orderBy('created_at','asc')
            ->where('student_id', $seat->studentId)
            ->get();

        // データ準備
        $testNames = [];
        $fourDeviations = [];
        $mathDeviations = [];
        $JapaneseDeviations = [];
        $scienceDeviations = [];
        $societyDeviations = [];

        foreach ($privateScores as $score) {
            $testNames[] = $score->testName;
            $fourDeviations[] = $score->fourDeviation;
            $mathDeviations[] = $score->mathDeviation;
            $JapaneseDeviations[] = $score->JapaneseDeviation;
            $scienceDeviations[] = $score->scienceDeviation;
            $societyDeviations[] = $score->societyDeviation;
        }

        $maxs = [max($fourDeviations),
                max($mathDeviations),
                max($JapaneseDeviations),
                max($scienceDeviations),
                max($societyDeviations)];

        $mins = [min($fourDeviations),
                min($mathDeviations),
                min($JapaneseDeviations),
                min($scienceDeviations),
                min($societyDeviations)];

        // グラフ生成前にフォントのパスを指定
        // ipam.ttf、ipamp.ttf、ipag.ttf、ipagp.ttf
        // FF_MINCHO、FF_PMINCHO、FF_GOTHIC、FF_PGOTHICの順で設定
        putenv('GDFONTPATH=' . resource_path('fonts'));

        // グラフ生成
        $chartWidth = 700;
        $chartHeight = 400;
        $graph = new \Graph($chartWidth, $chartHeight);

        $graph->SetScale("textlin");
        $graph->SetMargin(50, 30, 20, 50);
        $graph->title->Set("偏差値推移");
        $graph->title->SetFont(FF_MINCHO, FS_NORMAL, 14);
        // $graph->title->SetFont(FF_FONT1, FS_BOLD);
        $graph->xaxis->SetTickLabels($testNames);
        $graph->yaxis->scale->SetAutoMin(getMin(min($mins)));
        $graph->yaxis->scale->SetAutoMax(getMax(max($maxs)));


        $data = [
            $fourDeviations,
            $mathDeviations,
            $JapaneseDeviations,
            $scienceDeviations,
            $societyDeviations
        ];
        
        $colors = ["blue", "green", "red", "orange", "black"];
        $subject = ["四科","算数","国語","理科","社会"];
        // $colors = ["#1374e9", "#1c9440", "#e4382a", "#fbc20f", "#202124"];
        // $colors = [0, 1, 2, 3, 4];
        foreach ($data as $i => $scores) {
            $lineplot = new \LinePlot($scores);
            $lineplot->SetLegend($subject[$i]);
            $graph->legend->SetFont(FF_MINCHO, FS_NORMAL, 14);
            $lineplot->SetColor($colors[$i]);
            // マーカーの設定
            $lineplot->mark->SetType(MARK_UTRIANGLE); // マーカーの種類を設定
            $lineplot->mark->SetFillColor($colors[$i]); // マーカーの塗りつぶし色を設定
            $lineplot->mark->SetSize(4); // マーカーのサイズを設定
            $graph->Add($lineplot);
        }
        // グラフの出力
        $graph->Stroke(public_path('charts/chart2.png'));

        return view('seats.show', compact('seat','privateScores'));
    }
    // 更新ページ
    public function edit(Seat $seat) {
        return view('seats.edit', compact('seat'));
    }
    // 更新機能
    public function update(Request $request, Seat $seat) {
        $request->validate([
            // 'studentId' => 'required',
            'name' => 'required',
            'ruby' => 'required',
            // 'courceOld' => 'required',
            // 'courceNow' => 'required',
            // 'newStudent' => 'required',
            // 'forward' => 'required',
            'remarks' => 'required',
        ]);

        // $seat->studentId = $request->input('studentId');
        $seat->name = $request->input('name');
        $seat->ruby = $request->input('ruby');
        // $seat->courceOld = $request->input('courceOld');
        // $seat->courceNow = $request->input('courceNow');
        // $seat->newStudent = boolval($request->input('newStudent'));
        // $seat->forward = boolval($request->input('forward'));
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


