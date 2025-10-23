<!-- filepath: resources/views/components/card-delete-button.blade.php -->
@props(['url', 'itemName' => 'item'])

<!-- Delete Button -->
<a href="javascript:void(0);" 
   class="p-2"
   onclick="showDeleteModal_{{ md5($url) }}()"
   title="Delete">
    <i class="feather-trash-2"></i>
</a>

<!-- Modal for this specific item -->
<div class="modal fade" id="deleteModal_{{ md5($url) }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this {{ $itemName }}? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ $url }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for this specific item -->
<script>
    function showDeleteModal_{{ md5($url) }}() {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal_{{ md5($url) }}'));
        modal.show();
    }
</script>

{{-- <div class="edit-delete-action">
    <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2" href="javascript:void(0);">
        <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
</div> --}}