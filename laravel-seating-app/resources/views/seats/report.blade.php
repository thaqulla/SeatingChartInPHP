@extends('layouts.app')

@section('content')
  <div class="row">
  @foreach($cources as $cource)
    <li>
      <a class="dropdown-item" name="alphabet"
        href="{{ route('seats.report') }}">
        {{ $cource }}コース
      </a>
    </li>
  @endforeach
    <div class="aside_container">
      <!-- 同じコースの生徒を箇条書きで並べる -->
      @foreach($seats as $seat)
      <div class="grid_container">
        @if ($seat->newStudent == 0)
          <div class="grid_item">新</div>
        @else
          <div class="grid_item">&nbsp;</div>
        @endif
        <div class="grid_item">{{ $seat->studentId }}</div>
        <div class="grid_item">{{ $seat->name }}</div>
      </div>
      @endforeach
    </div>
    <div class="main_container">
      <!-- 座席表　格子状のもの -->
      <div id="container">
      @foreach($seats as $seat)
        <div id="{{ $seat->studentId }}" class="drag-item" draggable="true" ondragstart="drag(event)">
          <span style="font-size: xx-small">{{ $seat->ruby }}</span><br>
          <span>{{ $seat->name }}</span>
        </div>
      @endforeach
    </div>
    
@endsection
  <!-- <div class="drop_container" id="dropzone" ondragover="allowDrop(event)" ondrop="drop(event)">
    <button class="print-btn">
      <span>結果だけを印刷する</span>
    </button>
  </div> -->

<!-- <script>
  // 赤、青、黄の要素を取得します
  const redElement = document.getElementById("red");
  const blueElement = document.getElementById("blue");
  const yellowElement = document.getElementById("yellow");

  // ドラッグ開始時の処理
  function handleDragStart(event) {
  // ドラッグする要素のIDをデータとして保存します
    event.dataTransfer.setData("text/plain", event.target.id);
  }

  // ドロップ時の処理
  function handleDrop(event) {
    // デフォルトのドロップ動作をキャンセルします
    event.preventDefault();

    // ドラッグした要素のIDを取得します
    const draggedElementId = event.dataTransfer.getData("text/plain");

    // ドラッグした要素をドロップ先に追加します
    event.target.appendChild(document.getElementById(draggedElementId));
  }

  // ドラッグを許可するための処理
  function allowDrop(event) {
    event.preventDefault();
  }

  // 赤、青、黄の要素にイベントリスナーを追加します
  redElement.addEventListener("dragstart", handleDragStart);
  blueElement.addEventListener("dragstart", handleDragStart);
  yellowElement.addEventListener("dragstart", handleDragStart);

  redElement.addEventListener("dragover", allowDrop);
  blueElement.addEventListener("dragover", allowDrop);
  yellowElement.addEventListener("dragover", allowDrop);

  redElement.addEventListener("drop", handleDrop);
  blueElement.addEventListener("drop", handleDrop);
  yellowElement.addEventListener("drop", handleDrop);


  const dropZone = document.getElementById("drop-zone");

  dropZone.addEventListener("drop", handleDrop);
  dropZone.addEventListener("dragover", allowDrop);
</script> -->
