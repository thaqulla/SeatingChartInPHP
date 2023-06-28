@extends('layouts.app')

@section('content')
    <div class="show_head">
        <h2>生徒情報詳細</h2>
        
        
    </div>
    <div class="show_container">

        <article class="show_item">
            <div>
                @if (session('flash_message'))
                  <div>{{ session('flash_message') }}</div>
                @endif
                <div class="show_detail_container">
                    <div style="background-color: #6ccb5f; text-align: right;">
                        生徒番号&nbsp;
                    </div>
                    
                    <div>{{ $seat->studentId }}</div>
                </div>
                <div class="show_detail_container">
                    <div style="background-color: #6ccb5f; text-align: right;">
                        フリガナ&nbsp;
                    </div>
                    <div style="">{{ $seat->ruby }}</div>
                </div>
                <div class="show_detail_container">
                    <div style="background-color: #6ccb5f; text-align: right;">
                        名前&nbsp;
                    </div>
                    
                    <div style="font-size: 24px;">{{ $seat->name }}</div>
                </div>
                <div class="show_detail_container">
                    <div style="background-color: #6ccb5f; text-align: right;">
                        現コース&nbsp;
                    </div>
                    <div>
                        <span style="font-size: 24px;">{{ $seat->courceNow }}</span>
                        <span>(旧コース:{{ $seat->courceOld }})</span>
                    </div>
                    
                </div>
            
                <div class="show_detail_container">
                    <div style="background-color: #6ccb5f; text-align: right;">
                        備考&nbsp;
                    </div>
                    
                    <div style="text-align: left; overflow-wrap: break-word;">
                        &nbsp;{{ $seat->remarks }}
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-end">
                        <span>更新日{{ \Carbon\Carbon::parse($seat->updated_at)->format('Y年m月d日') }}</span>
                        <a class="item_center btn btn-outline-primary btn-sm" href="{{ route('seats.edit', $seat) }}">
                            編集
                        </a>
                        <div class="ml-2">
                            <div class="student_item item_center"> 
                            <form action="{{ route('seats.destroy', $seat) }}" method="post">
                                @csrf
                                @method('delete')                                        
                                <button type="submit" class="btn btn-outline-danger btn-sm">削除</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>    

                <div class="show_commment_container">
                    <div class="show_comment_item">投稿日(更新)</div>
                    <div class="show_comment_item">記入者</div>
                    <div class="show_comment_item">コメント</div>
                </div>
                @foreach($comments as $comment)
                <div class="show_commment_container">
                    <div class="show_comment_item">
                        {{ \Carbon\Carbon::parse($comment->created_at)->format('Y年m月d日') }}<br>
                        @if($comment->created_at != $comment->updated_at)
                            ({{ \Carbon\Carbon::parse($comment->updated_at)->format('m月d日') }}更新)
                        @endif
                    </div>
                    <div class="show_comment_item">{{ $comment->user->name }}</div>
                    <div class="show_comment_item">{{ $comment->comment }}</div>
                </div>
                @endforeach
                <!-- バックエンドからの結果を表示 -->
            @if (session('deleteStatus'))
                <p>{{ session('deleteStatus') }}</p>
            @endif

            @include('modals.add_comment')  
            <div class="d-flex justify-content-end">
                <a href="#" class="link-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#addGoalModal">
                    <div class="d-flex align-items-center">
                        <span class="btn btn-outline-success btn-sm">コメント追加</span>
                    </div>
                </a>          
            </div>  
            </div>
        </article>
        <aside class="show_item" style="text-align: center;">
            <div class="show_graph">
                @if ($existence === 1)
                    <img src="{{ asset('charts/chart2.png') }}" alt="Graph">
                @else
                    <img src="https://dummyimage.com/700x400/cecece/fff" alt="Graph">
                @endif
            </div>
            <!-- 偏差値表 -->
            <div style="text-align:center;">
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
