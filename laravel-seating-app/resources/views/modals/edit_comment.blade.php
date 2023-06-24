<div class="modal fade" id="editGoalModal 1" tabindex="-1" aria-labelledby="editGoalModalLabel 1">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editGoalModalLabel 1">目標の編集</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
          </div>
          <form action="#" method="post">
              @csrf
              @method('patch')                                                                    
              <div class="modal-body">
                  <input type="text" class="form-control" name="title" value="">
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">更新</button>
              </div>   
          </form>             
      </div>
  </div>
</div>