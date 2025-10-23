<div class="image-manager">
    {{-- File Upload Section --}}
    <div class="mb-3">
        <div class="image-upload image-upload-two">
            <input type="file" name="attachments[]" multiple accept="image/jpeg,image/jpg,image/png"
                id="image-upload-{{ $id }}">
            <div class="image-uploads">
                <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                <h4>{{ $uploadText ?? 'Add Images' }}</h4>
            </div>
        </div>
    </div>

    {{-- Image Preview Area --}}
    <div id="image-preview-container-{{ $id }}" class="d-flex flex-wrap gap-2">
        @foreach ($attachments as $attachment)
            <div class="phone-img" id="image-container-{{ $attachment->id }}">
                <img src="{{ Storage::disk('public_raw')->url(ltrim($attachment->path, '/')) }}"
                    alt="{{ $attachment->original_filename }}">
                <a href="javascript:void(0);" class="delete-image-btn" data-attachment-id="{{ $attachment->id }}">
                    <i data-feather="x" class="x-square-add remove-product"></i>
                </a>
            </div>
        @endforeach
    </div>
</div>

{{-- Styles --}}
<style>
    .phone-img {
        position: relative;
        display: inline-block;
        margin: 10px;
        width: 150px;
        height: 150px;
        overflow: hidden;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .phone-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .phone-img a {
        position: absolute;
        top: 5px;
        right: 5px;
        background: white;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 5;
    }

    .new-upload {
        border: 2px solid #28a745;
    }
</style>

{{-- Scripts --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const previewContainer = document.getElementById('image-preview-container-{{ $id }}');
        const fileInput = document.getElementById('image-upload-{{ $id }}');

        // Handle file upload preview
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const files = this.files;
                console.log('Files selected:', files.length);

                if (files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const preview = document.createElement('div');
                            preview.className = 'phone-img new-upload';
                            preview.innerHTML = `
                                <img src="${e.target.result}" alt="New image">
                                <span class="badge bg-success position-absolute" style="bottom: 5px; left: 5px;">New</span>
                            `;
                            previewContainer.appendChild(preview);
                        };

                        reader.readAsDataURL(file);
                    }
                }
            });
        }

        // Handle image deletion with jQuery
        if (typeof $ !== 'undefined') {
            $(document).on('click',
                '#image-preview-container-{{ $id }} .delete-image-btn, #image-preview-container-{{ $id }} .undo-delete-btn',
                function(e) {
                    e.preventDefault();

                    const $button = $(this);
                    const attachmentId = $button.data('attachment-id');
                    const $container = $('#image-container-' + attachmentId);

                    if ($button.hasClass('delete-image-btn')) {
                        // Mark for deletion
                        if ($('input[name="delete_attachments[]"][value="' + attachmentId + '"]').length ===
                            0) {
                            $('<input>').attr({
                                type: 'hidden',
                                name: 'delete_attachments[]',
                                value: attachmentId
                            }).appendTo('form');
                        }

                        // Visual feedback
                        $container.css('opacity', '0.4');
                        $button.removeClass('delete-image-btn').addClass('undo-delete-btn');
                        $button.html('<i data-feather="rotate-ccw" class="x-square-add text-warning"></i>');
                        if (typeof feather !== 'undefined') {
                            feather.replace();
                        }
                    } else {
                        // Undo deletion
                        $('input[name="delete_attachments[]"][value="' + attachmentId + '"]').remove();

                        // Restore appearance
                        $container.css('opacity', '1');
                        $button.removeClass('undo-delete-btn').addClass('delete-image-btn');
                        $button.html('<i data-feather="x" class="x-square-add remove-product"></i>');
                        if (typeof feather !== 'undefined') {
                            feather.replace();
                        }
                    }
                });
        }
    });
</script>
