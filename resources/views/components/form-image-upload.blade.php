@props([
    'name' => 'file',
    'label' => 'Upload File',
    'required' => false,
    'multiple' => false,
    'existingFiles' => [],
    'accept' =>
        'image/jpeg,image/jpg,image/png,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
])

<div class="mb-3">
    @if ($label)
        <label class="form-label">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    {{-- This input mimics your working basic input but adds styling --}}
    <div class="file-input-wrapper">
        <input type="file" name="{{ $name }}" id="{{ str_replace(['[', ']'], '', $name) }}_input"
            {{ $multiple ? 'multiple' : '' }} accept="{{ $accept }}"
            class="form-control @error($name) is-invalid @enderror" @if ($required) required @endif>
    </div>

    <small class="form-text text-muted">
        Allowed files: JPEG, JPG, PNG, PDF, DOC, DOCX. Max size: 2MB.
    </small>

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror

    {{-- Simple preview container with minimal JavaScript --}}
    <div class="file-preview-container mt-2" id="{{ str_replace(['[', ']'], '', $name) }}_preview"></div>
</div>

<style>
    .file-preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .preview-item {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 300px;
        background: #f9f9f9;
    }

    .preview-thumbnail {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
        border-radius: 3px;
    }

    .preview-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eee;
        margin-right: 10px;
        border-radius: 3px;
    }

    .preview-filename {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('{{ str_replace(['[', ']'], '', $name) }}_input');
        const previewContainer = document.getElementById('{{ str_replace(['[', ']'], '', $name) }}_preview');

        if (fileInput && previewContainer) {
            fileInput.addEventListener('change', function() {
                // Clear previous previews
                previewContainer.innerHTML = '';

                // Create previews for each file
                for (let i = 0; i < this.files.length; i++) {
                    const file = this.files[i];
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';

                    // Create thumbnail or icon
                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.className = 'preview-thumbnail';
                        img.src = URL.createObjectURL(file);
                        previewItem.appendChild(img);
                    } else {
                        const icon = document.createElement('div');
                        icon.className = 'preview-icon';
                        icon.innerHTML = '<i class="fas fa-file"></i>';
                        previewItem.appendChild(icon);
                    }

                    // Add filename
                    const filename = document.createElement('div');
                    filename.className = 'preview-filename';
                    filename.textContent = file.name;
                    previewItem.appendChild(filename);

                    // Add to container
                    previewContainer.appendChild(previewItem);
                }
            });
        }
    });
</script>
