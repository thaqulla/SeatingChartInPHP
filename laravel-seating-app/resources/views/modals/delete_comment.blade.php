<div class="modal fade" id="deleteGoalModal 1" tabindex="-1" aria-labelledby="deleteGoalModalLabel 1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteGoalModalLabel 1">「」を削除してもよろしいですか？</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
        </div>
        <div class="modal-footer">
          <form action="#" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">削除</button>
          </form>
        </div>
      </div>
    </div>
</div>