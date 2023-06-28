@extends('layouts.app')

@section('content')


<div class="report_main_container">
  
<form class="d-flex" action="{{ route('comments.store') }}" method="post">
      @csrf
  <div class="report_textarea">
    <h2 class="index_head">コース</h2>
      <div class="report_add">
            @if ($errors->any())
              <div>
              @foreach ($errors->all() as $error)
                <span>{{ $error }}</span><br>
              @endforeach
              </div>
            @endif
        <div class="row">
          <div class="col">
              <input type="text" class="form-control" name="comment" style="width: 34vw;">
          </div>
          <div class="col">
              <button type="submit" class="btn btn-outline-success">報告</button>
          </div>
        </div>
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
</form> 
  
  <div class="report_textarea">
    <h2 class="index_head">
      報告一覧
    </h2>
    <div class="comment_controller">
      <div class="item_center">投稿(更新)</div>
      <div class="item_center">生徒氏名</div>
      <div class="item_center">コメント</div>
      <div class="item_center">先生</div>
      <div class="item_center">編集</div>
      <div class="item_center">削除</div>
    </div>
    @foreach($comments as $comment)
    <div class="comment_controller">
      <div class="report_chart">
        {{ \Carbon\Carbon::parse($comment->created_at)->format('Y年m月d日') }}
        @if($comment->created_at != $comment->updated_at)
          ({{ \Carbon\Carbon::parse($comment->updated_at)->format('m月d日') }}更新)
        @endif
      </div>
      <div class="report_chart">
        @foreach( $comment->seats as $seat)
        <span>{{ $seat->name }}</span><br>
        @endforeach
      </div>
      <div class="report_chart">{{ $comment->comment }}</div>
      <div class="report_chart">{{ $comment->user->name }}</div>
      <div class="report_chart">
      @if(Auth::check())
        @include('modals.edit_comment')  
        <div class="report_chart item_center">
          <a href="#" class="link-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#editCommentModal{{$comment->id}}">
            <span class="btn btn-outline-success btn-sm">編集</span>
          </a>          
        </div>  
      @else
        <div class="report_chart item_center">
          <a href="#" class="disabled btn btn-outline-success btn-sm">編集</a>
        </div>
      @endif
      </div>

      <div class="report_chart item_center">
        <form action="{{ route('comments.destroy', $comment) }}" method="post">
          @csrf
          @method('delete')                                        
          <button type="submit" class="btn btn-outline-danger btn-sm">削除</button>
        </form>
        </div>
      </div>
    @endforeach
    
  </div>
 
</div>



@endsection
  <!-- <div class="drop_container" id="dropzone" ondragover="allowDrop(event)" ondrop="drop(event)">
    <button class="print-btn">
      <span>結果だけを印刷する</span>
    </button>
  </div> -->


