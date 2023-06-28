<div class="modal fade" id="addGoalModal" tabindex="-1" aria-labelledby="addGoalModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addGoalModalLabel">コメントを入れてください</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
      </div>
      <form action="{{ route('comments.store') }}" method="post">
        @csrf
        <input type="hidden" id="{{ $seat->studentId }}" name="seat_ids[]" value="{{ $seat->id }}"  autocomplete="off">
        <div class="modal-body">
            <input type="text" class="form-control" name="comment">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">確認</button>
        </div>
      </form>
    </div>
  </div>
 </div>