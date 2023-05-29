@include('layouts.header')
    <main class="show_container">
        <!-- 点数表 -->
        <aside>
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
        <!-- 偏差値表 -->
        <aside>
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
        </aside>
        <article>
            <div>                
                <h1>生徒情報詳細</h1>  
                @if (session('flash_message'))
                  <div>{{ session('flash_message') }}</div>
                @endif

                <div>    
                    <a href="{{ route('seats.index') }}">&lt; 戻る</a> 
                    <img src="{{ asset('charts/chart.png') }}" alt="Graph">                            
                </div>

                <div>
                    <div>{{ $seat->studentId }}</div>
                    <div>{{ $seat->name }}{{ $seat->ruby }}{{ $seat->courceOld }}{{ $seat->courceNow }}</div>
                    <div>{{ $seat->newStudent }}{{ $seat->forward }}{{ $seat->remarks }}</div>
                    <a href="{{ route('seats.edit', $seat) }}" class="btn btn-outline-primary">編集</a>
                    <form action="{{ route('seats.destroy', $seat) }}" method="post">
                        @csrf
                        @method('delete')                                        
                        <button type="submit" class="btn btn-outline-danger">削除</button>
                    </form>
                    
                    
                </div>                 
            </div>
        </article>
    </main>

@include('layouts.footer')
</body>
</html>
