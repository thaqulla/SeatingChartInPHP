@extends('layouts.app')

@section('content')
    <div class="show_head">
        <h2>生徒情報詳細</h2>
        
        <div>
            <span>更新日{{ \Carbon\Carbon::parse($seat->updated_at)->format('Y年m月d日') }}</span>
            <a class="btn btn-link" href="{{ route('seats.index') }}">&lt; 戻る</a> 
            <a class="btn btn-outline-primary" href="{{ route('seats.edit', $seat) }}">編集</a>
            <form action="{{ route('seats.destroy', $seat) }}" method="post">
                @csrf
                @method('delete')                                        
                <button type="submit" class="btn btn-outline-danger">削除</button>
            </form>
            <!-- バックエンドからの結果を表示 -->
            @if (session('deleteStatus'))
                <p>{{ session('deleteStatus') }}</p>
            @endif
        </div>    
    </div>
    <div class="show_container">

        <article class="show_item">
            <div>
                @if (session('flash_message'))
                  <div>{{ session('flash_message') }}</div>
                @endif
                <div class="show_detail_container" style="background-color: yellow;">
                    <span style="text-align: right;">生徒番号&nbsp;</span>
                    <span>:</span>
                    <span>{{ $seat->studentId }}</span>
                </div>
                <div class="show_detail_container" style="background-color: red;">
                    <span style="text-align: right;">ふりがな&nbsp;</span>
                    <span>:</span>
                    <span style="">{{ $seat->ruby }}</span>
                </div>
                <div class="show_detail_container" style="background-color: violet;">
                    <span style="text-align: right;">名前&nbsp;</span>
                    <span>:</span>
                    <span style="font-size: 24px;">{{ $seat->name }}</span>
                </div>
                <div class="show_detail_container" style="background-color: violet;">
                    <span style="text-align: right;">現コース&nbsp;</span>
                    <span>:</span>
                    <span>
                        <span style="font-size: 24px;">{{ $seat->courceNow }}</span>
                        <span>(旧コース:{{ $seat->courceOld }})</span>
                    </span>
                    
                </div>
                <div style="background-color: violet;">
                    <span>新入室</span>
                    <span>:</span>
                    <span style="font-size: 24px;">&nbsp;{{ $seat->newStudent }}&nbsp;</span>
                </div>
                <div style="background-color: violet;">
                    <span>前方指定</span>
                    <span>:</span>
                    <span style="font-size: 24px;">&nbsp;{{ $seat->forward }}&nbsp;</span>
                </div>
                <div class="show_detail_container" style="background-color: green;">
                    <span style="text-align: right;">詳細&nbsp;</span>
                    <span>:</span>
                    <span style="text-align: left; overflow-wrap: break-word;">&nbsp;{{ $seat->remarks }}
                </span>
                </div>

                @include('modals.add_comment')  
                <div class="d-flex mb-3">
                    <a href="#" class="link-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#addGoalModal">
                        <div class="d-flex align-items-center">
                            <span class="fs-5 fw-bold btn btn-outline-danger">コメント追加</span>
                        </div>
                    </a>          
                </div>  
                @foreach($comments as $comment)
                    {{ $comment->user->name }}</span>
                    {{ $comment->comment }}</span>
                    <span>更新日{{ \Carbon\Carbon::parse($comment->created_at)->format('Y年m月d日') }}</span>
                @endforeach
                
                <div class="row row-cols-1 row row-cols-md-2 row-cols-lg-3 g-4">                         
                
                    
                    <!-- 目標の編集用モーダル -->
                    @include('modals.edit_comment') 

                    <!-- 目標の削除用モーダル -->
                    @include('modals.delete_comment')  
        
                    <div class="col">     
                        <div class="card bg-light">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <h4 class="card-title ms-1 mb-0"></h4>
                                <div class="d-flex align-items-center">                                 
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none" id="dropdownGoalMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">︙</a>
                                        <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownGoalMenuLink">
                                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editGoalModal 1">編集</a></li>                                   
                                            <div class="dropdown-divider"></div>
                                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteGoalModal 1">削除</a></li>                                                                                                          
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>                           
                    </div>
                                     
                </div>
            </div>
        </article>
        <aside class="show_item" style="text-align: center;">
            <div class="show_graph">
                <img src="{{ asset('charts/chart2.png') }}" alt="Graph">
            </div>
            <!-- 偏差値表 -->
            <div style="background-color:red; text-align: center;">
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
            </div>

            
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
</div>
@endsection
