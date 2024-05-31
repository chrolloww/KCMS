<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Terminate Collaboration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('file.terminate', [$data->c_name]) }}" method="POST" onsubmit="return confirm('Are you sure you want to terminate this collaboration?');">
                @csrf
                <div class="modal-body">
                    <label for="termination_reason">Enter termination reason:</label>
                    <input type="text" id="termination_reason" name="termination_reason" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Confirm Termination</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>