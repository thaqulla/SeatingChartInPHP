<div class="modal fade" id="editCommentModal{{$comment->id}}" tabindex="-1" aria-labelledby="editCommentModal{{$comment->id}}">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editCommentModalLabel{{$comment->id}}">コメントの編集</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
          </div>
          <form action="{{ route('comments.update', $comment->id) }}" method="post">
              @csrf
              @method('patch')                                                                    
              <div class="modal-body">
                    
                    <input type="text" class="form-control" name="comment" value="{{ old('comment', $comment->comment) }}">
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success">更新</button>
              </div>   
          </form>             
      </div>
  </div>
</div>