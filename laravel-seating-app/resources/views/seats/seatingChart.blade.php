@include('layouts.header')
<div class="row">
  <div class="aside_container">
    <!-- 同じコースの生徒を箇条書きで並べる -->
    <form id="alphabetForm">
      @foreach (range('A', 'E') as $alphabet)
      <input type="radio" name="alphabet" value="{{ $alphabet }}" id="{{ $alphabet }}">
      <label for="{{ $alphabet }}">{{ $alphabet }}</label>
      @endforeach
    </form>
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
  
  <div class="drop_container" id="dropzone" ondragover="allowDrop(event)" ondrop="drop(event)">

  </div>
</div>
@include('layouts.footer')
</body>
</html>