@extends('layouts.app')

@section('content')
    <div class="show_head">
        <h2>生徒情報詳細</h2>
    </div>
    <div class="show_container">
        <aside class="show_item">
            <div class="show_graph">
                <img src="{{ asset('charts/chart2.png') }}" alt="Graph">
            </div>
            <!-- 偏差値表 -->
            <div class="score_container">
                <div class="student_item item_center">テスト名</div>
                <div class="student_item item_center">四科偏差値</div>
                <div class="student_item item_center">算数偏差値</div>
                <div class="student_item item_center">国語偏差値</div>
                <div class="student_item item_center">理科偏差値</div>
                <div class="student_item item_center">社会偏差値</div>
            </div>
            @foreach ($privateScores as $score)
                <div class="score_container">
                    <div class="student_item item_center">{{ $score->testName }}</div>
                    <div class="student_item item_center">{{ $score->fourDeviation }}</div>
                    <div class="student_item item_center">{{ $score->mathDeviation }}</div>
                    <div class="student_item item_center">{{ $score->JapaneseDeviation }}</div>
                    <div class="student_item item_center">{{ $score->scienceDeviation }}</div>
                    <div class="student_item item_center">{{ $score->societyDeviation }}</div>
                </div>
            @endforeach   
            <br>
            <!-- 点数表 -->
            
            <div class="score_container">
                <div class="student_item item_center">テスト名</div>
                <div class="student_item item_center">四科合計点</div>
                <div class="student_item item_center">算数得点</div>
                <div class="student_item item_center">国語得点</div>
                <div class="student_item item_center">理科得点</div>
                <div class="student_item item_center">社会得点</div>
            </div>
            @foreach ($privateScores as $score)
                <div class="score_container">
                    <div class="student_item item_center">{{ $score->testName }}</div>
                    <div class="student_item item_center">{{ $score->fourScore }}</div>
                    <div class="student_item item_center">{{ $score->mathScore }}</div>
                    <div class="student_item item_center">{{ $score->JapaneseScore }}</div>
                    <div class="student_item item_center">{{ $score->scienceScore }}</div>
                    <div class="student_item item_center">{{ $score->societyScore }}</div>
                </div>
            @endforeach                
        </aside>
        <article class="show_item">
            <div>
                @if (session('flash_message'))
                  <div>{{ session('flash_message') }}</div>
                @endif
                <div class="show_img">
                    <img src="https://dummyimage.com/120x160/8ec0f9/313de6&text=%E9%A1%94%E5%86%99%E7%9C%9F" alt="Photo">
                    <span>実装中</span>
                </div>
                
                {{ $seat->studentId }}&nbsp;{{ $seat->name }}&nbsp;{{ $seat->ruby }}
                    {{ $seat->courceOld }}{{ $seat->courceNow }}
                    {{ $seat->newStudent }}{{ $seat->forward }}{{ $seat->remarks }}
                    {{ $seat->update_at }}
                    {{ $seat->create_at }}
                    <div>    
                    
                                                
                </div>

                <div>
                    <a class="btn btn-link" href="{{ route('seats.index') }}">&lt; 戻る</a> 
                    <a class="btn btn-outline-primary" href="{{ route('seats.edit', $seat) }}">編集</a>
                    <form action="{{ route('seats.destroy', $seat) }}" method="post">
                        @csrf
                        @method('delete')                                        
                        <button type="submit" class="btn btn-outline-danger">削除</button>
                    </form>
                    
                    
                </div>                 
            </div>
        </article>
</div>
@endsection
