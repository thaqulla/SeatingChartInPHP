@extends('layouts.app')

@section('content')
<form class="d-flex" action="{{ route('comments.store') }}" method="post">
      @csrf
<div class="report_main_container">
  <div>
  <!-- <style>
      ol {
        list-style: none;
      }
      a {
        text-decoration: none;
        color: inherit;
      }
      .targets {
        /* display: grid;
        grid-gap: 40px;
        grid-template-columns: repeat(auto-fit, 60px);
        margin-top: 40px; */
      }
      .circle, .square {
        width: 60px;
        height: 60px;
        background-color: #EEE;
        border: 1px solid #CCC;
      }
      .circle {
        border-radius: 50%;
      }
      .blue {
        background-color: #B8DBF6;
        border: 1px solid #5ABEED;
      }
      .green {
        background-color: #C8F8D1;
        border: 1px solid #64D994;
      }
      .red {
        background-color: #FAD6D7
      }
      [value="All"]:checked ~ .targets [data-category] {
        display: block;
      }
      [value="Blue"]:checked ~ .targets .target:not([data-category~="Blue"]), 
      [value="Green"]:checked ~ .targets .target:not([data-category~="Green"]), 
      [value="Red"]:checked ~ .targets .target:not([data-category~="Red"]),
      [value="Square"]:checked ~ .targets .target:not([data-category~="Square"]), 
      [value="Circle"]:checked ~ .targets .target:not([data-category~="Circle"]) {
        display: none;
      }

      [value="courceAll"]:checked ~ .targets [data-category] {
        display: block;
      }
      [value="A"]:checked ~ .targets .target:not([data-category~="A"]), 
      [value="Green"]:checked ~ .targets .target:not([data-category~="Green"]), 
      [value="Red"]:checked ~ .targets .target:not([data-category~="Red"]),
      [value="Square"]:checked ~ .targets .target:not([data-category~="Square"]), 
      [value="Circle"]:checked ~ .targets .target:not([data-category~="Circle"]) {
        display: none;
      }
    </style> -->
    <div class="report_container">
      <input type="radio" class="btn-check" id="courceAll" name="selectedCource" checked value="courceAll" autocomplete="off">
      <label class="btn btn-outline-success" for="courceAll">全コース</label>
      @foreach($cources as $cource)
        <input type="radio" class="btn-check" id="cource{{ $cource }}" name="selectedCource" value="cource{{ $cource }}" autocomplete="off">
        <label class="btn btn-outline-success" for="cource{{ $cource }}">{{ $cource }}コース</label>
      @endforeach
    </div>
    <div class="targets report_container">
      
        @foreach($seats as $seat)
          <input type="checkbox" class="target btn-check" data-category="{{ $seat->courceNow }}" id="{{ $seat->studentId }}" name="seat_ids[]" value="{{ $seat->id }}"  autocomplete="off">
          <label class="report_item btn btn-outline-success" for="{{ $seat->studentId }}">
            <span style="font-size: xx-small">{{ $seat->studentId }}</span><br>
            <span style="font-size: xx-small; white-space: nowrap;">{{ $seat->ruby }}</span><br>
            @if ($seat->newStudent == 0)
              <span>★{{ $seat->name }}</span><br>
            @else
              <span>{{ $seat->name }}</span><br>
            @endif
          </label>
        @endforeach
    </div>
  </div>

  <div class="report_textarea">
    
    <!-- <div class="sample"> -->
      <!-- フィルタ（ラジオボタンとラベル） -->
      <!-- <input type="radio" name="categories" id="All" value="All" checked>
      <label for="All"> 全て </label>
      <input type="radio" name="categories" id="Blue" value="Blue">
      <label for="Blue"> ブルー </label>
      <input type="radio" name="categories" id="Green" value="Green">
      <label for="Green"> グリーン </label>
      <input type="radio" name="categories" id="Red" value="Red">
      <label for="Red"> レッド </label>
      <input type="radio" name="categories" id="Square" value="Square">
      <label for="Square"> 正方形 </label>
      <input type="radio" name="categories" id="Circle" value="Circle">
      <label for="Circle"> 円 </label> -->
    
      <!-- フィルタリングする対象のコンテンツ -->
      <!-- <ol class="targets">
        <li class="target" data-category="Square">
          <div class="square"></div>
        </li>
        <li class="target" data-category="Circle">
          <div class="circle"></div>
        </li>
        <li class="target" data-category="Blue Square">
          <div class="blue square"></div>
        </li>
        <li class="target" data-category="Blue Circle">
          <div class="blue circle"></div>
        </li>
        <li class="target" data-category="Green Square">
          <div class="green square"></div>
        </li>
        <li class="target" data-category="Green Circle">
          <div class="green circle"></div>
        </li>
        <li class="target" data-category="Red Square">
          <div class="red square"></div>
        </li>
        <li class="target" data-category="Red Circle">
          <div class="red circle"></div>
        </li>
      </ol>
    </div> -->
    
    <div class="row">
      <div class="col">
          <input type="text" class="form-control" name="comment">
      </div>
      <div class="col">
          <button type="submit" class="btn btn-outline-primary">確認</button>
      </div>
    </div>
    
    <div class="comment_controller">
      <div>更新日</div>
      <div>生徒氏名</div>
      <div>コメント</div>
      <div>先生</div>
      <div>編集</div>
      <div>削除</div>
    </div>
    @foreach($comments as $comment)
    <div class="comment_controller">
      <div>{{ \Carbon\Carbon::parse($comment->updated_at)->format('Y年m月d日') }}</div>
      <div>
        @foreach( $comment->seats as $seat)
        <span>{{ $seat->name }}</span><br>
        @endforeach
      </div>
      <div>{{ $comment->comment }}</div>
      <div>{{ $comment->user->name }}</div>
      <div>
        @if(Auth::check())
          <div class="student_item item_center">
            <a href="#" class="btn btn-outline-success">編集</a>
          </div>
        @else
          <div class="student_item item_center">
            <a href="#" class="disabled btn btn-outline-success">編集</a>
          </div>
        @endif
      </div>

      <div>
        <form action="#" method="post">
          @csrf
          @method('delete')                                        
          <button type="submit" class="btn btn-outline-danger">削除</button>
        </form>
        </div>
    </div>
    @endforeach
    
  </div>
  
</div>
</form> 
@endsection
  <!-- <div class="drop_container" id="dropzone" ondragover="allowDrop(event)" ondrop="drop(event)">
    <button class="print-btn">
      <span>結果だけを印刷する</span>
    </button>
  </div> -->


