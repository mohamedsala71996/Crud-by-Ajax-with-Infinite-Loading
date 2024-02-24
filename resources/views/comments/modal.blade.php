<!-- Edit Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <form action="{{ URL::to('update') }}" method="POST" id="editForm">
                    @csrf 
                    @method('PUT')
                    <input type="hidden" id="memid" name="id">
                    <div class="mb-3">
                        <label for="Name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                        <span class="text-danger" id="error-name"></span>

                        </div>
                    <div class="mb-3">
                        <label for="comment">Comment</label>
                        <input type="text" name="comment" id="comment" class="form-control">
                        <span class="text-danger" id="error-name"></span>
                        </div>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update</button>
                </form>
                </div>
            </div>
        </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ URL::to('destroy') }}" method="POST" id="deleteForm">
                @csrf 
                @method('DELETE')
                <input type="hidden" id="d_id" name="id">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <h4 class="text-center">Are you sure you want to delete this comment?</h4>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-danger">Delete</button>
                </form>
                </div>
            </div>
        </div>
</div>
