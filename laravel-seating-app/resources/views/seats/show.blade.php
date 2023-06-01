@include('layouts.header')

    <main class="show_container">
        <aside>
        <div>{{ $seat->studentId }}</div>
        <div>{{ $seat->name }}</div>{{ $seat->courceOld }}{{ $seat->courceNow }}
        <div>{{ $seat->ruby }}</div>{{ $seat->newStudent }}{{ $seat->forward }}{{ $seat->remarks }}


        <h2>四科成績表</h2>
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
        <!-- </aside> -->
        
        
        <!-- <aside> -->
             
        </aside>
        <article>
            <div>                
                <h2>生徒情報詳細</h2>  
                @if (session('flash_message'))
                  <div>{{ session('flash_message') }}</div>
                @endif

                <div>    
                    <a href="{{ route('seats.index') }}">&lt; 戻る</a> 
                                                
                </div>

                <div>
                    <div>
                        <img src="{{ asset('charts/chart2.png') }}" alt="Graph">
                    </div>
                    <div></div>
                    <div></div>
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
