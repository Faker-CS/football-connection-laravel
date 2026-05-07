{{--
  Reusable Image Upload Component with Drag & Drop Support
  
  @props:
    - name (string): Field name for form submission. Default: 'image'
    - label (string): Display label. Default: 'Image'
    - id (string): Unique component ID. Auto-generated if not provided.
    - accept (string): MIME type filter. Default: 'image/*'
    - maxSize (int): Max file size in MB per file. Default: 5
    - multiple (bool): Allow multiple files. Default: false
    - maxFiles (int): Max number of files when multiple=true. Default: 6
  
  Usage Examples:
    Single image:
    <x-image-upload name="avatar" label="Profile Picture" maxSize="2" />
    
    Gallery (multiple images):
    <x-image-upload 
      name="photos" 
      label="Gallery Photos"
      multiple="true"
      maxFiles="6"
      maxSize="5"
    />
--}}
@props([
    'name' => 'image',
    'label' => 'Image',
    'id' => null,
    'accept' => 'image/*',
    'maxSize' => 5, // MB
    'multiple' => false,
    'maxFiles' => 6,
])

@php
    $id = $id ?? $name . '_' . uniqid();
    $inputId = $id . '_input';
    $zoneId = $id . '_zone';
    $previewId = $id . '_preview';
    $base64Id = $id . '_base64';
    $contentId = $id . '_content';
    $galleryPreviewId = $id . '_gallery';
    $multipleAttr = $multiple ? 'multiple' : '';
@endphp

<div class="form-group">
    <label class="form-label">
        {{ $label }} 
        @if($multiple)
            <span class="form-hint">({{ $maxFiles }} max)</span>
        @endif
    </label>
    
    <div
        class="upload-zone" 
        id="{{ $zoneId }}" 
        ondrop="handleImageDrop_{{ $id }}(event)" 
        ondragover="handleImageDragOver_{{ $id }}(event)" 
        ondragleave="handleImageDragLeave_{{ $id }}(event)"
        data-upload-id="{{ $id }}"
    >
        <input 
            type="file" 
            id="{{ $inputId }}" 
            name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
            accept="{{ $accept }}" 
            {{ $multipleAttr }}
            style="display: none;" 
            onchange="handleImageSelect_{{ $id }}(event)"
        >
        
        <div id="{{ $contentId }}">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin: 0 auto 0.5rem; color: var(--muted);">
                <rect x="3" y="3" width="18" height="18" rx="2"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <path d="M21 15l-5-5L5 21"/>
            </svg>
            <div style="font-weight: 600; font-size: 0.85rem; color: var(--text); margin-bottom: 0.25rem;">
                Glissez votre{{ $multiple ? 's image' : ' image' }} ici ou cliquez pour sélectionner
            </div>
            <div style="font-size: 0.75rem; color: var(--muted);">
                Formats acceptés: JPG, PNG (max {{ $maxSize }} MB{{ $multiple ? ' par image' : '' }})
            </div>
        </div>
        
        @if($multiple)
            <div id="{{ $galleryPreviewId }}" style="display: none; display: flex; gap: 0.4rem; flex-wrap: wrap; margin-top: 1rem;"></div>
        @else
            <div id="{{ $previewId }}" style="display: none;">
                <img id="{{ $previewId }}_img" style="max-width: 100%; max-height: 200px; border-radius: 10px; margin-bottom: 0.75rem;">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeImage_{{ $id }}()" style="width: 100%;">
                    Supprimer l'image
                </button>
            </div>
        @endif
    </div>
    
    <input type="hidden" id="{{ $base64Id }}" name="{{ $name }}_base64">
</div>

<script>
    // Image upload handlers for {{ $id }}
    window['handleImageDrop_{{ $id }}'] = function(e) {
        e.preventDefault();
        e.stopPropagation();
        document.getElementById('{{ $zoneId }}').classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            document.getElementById('{{ $inputId }}').files = files;
            window['handleImageSelect_{{ $id }}']({ target: { files: files } });
        }
    };

    window['handleImageDragOver_{{ $id }}'] = function(e) {
        e.preventDefault();
        e.stopPropagation();
        document.getElementById('{{ $zoneId }}').classList.add('dragover');
    };

    window['handleImageDragLeave_{{ $id }}'] = function(e) {
        e.preventDefault();
        e.stopPropagation();
        document.getElementById('{{ $zoneId }}').classList.remove('dragover');
    };

    window['handleImageSelect_{{ $id }}'] = function(e) {
        const files = e.target.files;
        const isMultiple = {{ $multiple ? 'true' : 'false' }};
        const maxFiles = {{ $maxFiles }};

        if (!files || files.length === 0) return;

        if (isMultiple) {
            window['previewGallery_{{ $id }}'](files, maxFiles);
        } else {
            const file = files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('{{ $previewId }}_img').src = event.target.result;
                    document.getElementById('{{ $base64Id }}').value = event.target.result;
                    document.getElementById('{{ $contentId }}').style.display = 'none';
                    document.getElementById('{{ $previewId }}').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    };

    window['previewGallery_{{ $id }}'] = function(files, maxFiles) {
        const preview = document.getElementById('{{ $galleryPreviewId }}');
        preview.innerHTML = '';

        const fileCount = Math.min(files.length, maxFiles);

        for (let i = 0; i < fileCount; i++) {
            const file = files[i];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const thumb = document.createElement('div');
                    thumb.style.cssText = 'position: relative; width: 80px; height: 80px; border-radius: 8px; overflow: hidden; flex-shrink: 0;';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.cssText = 'width: 100%; height: 100%; object-fit: cover;';
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.style.cssText = 'position: absolute; top: -25px; right: -25px; width: 30px; height: 30px; border-radius: 50%; background: #dc2626; color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; opacity: 0; transition: all 0.2s;';
                    removeBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>';
                    removeBtn.onclick = function(evt) {
                        evt.preventDefault();
                        thumb.remove();
                    };
                    
                    thumb.addEventListener('mouseenter', function() {
                        removeBtn.style.opacity = '1';
                        removeBtn.style.top = '5px';
                        removeBtn.style.right = '5px';
                    });
                    thumb.addEventListener('mouseleave', function() {
                        removeBtn.style.opacity = '0';
                        removeBtn.style.top = '-25px';
                        removeBtn.style.right = '-25px';
                    });
                    
                    thumb.appendChild(img);
                    thumb.appendChild(removeBtn);
                    preview.appendChild(thumb);
                };
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('{{ $contentId }}').style.display = 'none';
        preview.style.display = 'flex';
    };

    window['removeImage_{{ $id }}'] = function() {
        document.getElementById('{{ $inputId }}').value = '';
        document.getElementById('{{ $base64Id }}').value = '';
        document.getElementById('{{ $contentId }}').style.display = 'block';
        document.getElementById('{{ $previewId }}').style.display = 'none';
    };

    // Click upload zone to open file selector
    document.getElementById('{{ $zoneId }}').addEventListener('click', function(e) {
        const previewId = '{{ $previewId }}';
        const galleryId = '{{ $galleryPreviewId }}';
        if (!e.target.closest('#' + previewId) && !e.target.closest('#' + galleryId)) {
            document.getElementById('{{ $inputId }}').click();
        }
    });
</script>

<style>
    .upload-zone {
        position: relative;
        border: 2px dashed var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all var(--transition);
        background: var(--white);
    }

    .upload-zone:hover {
        border-color: var(--green);
        background: rgba(172, 209, 163, 0.03);
    }

    .upload-zone.dragover {
        border-color: var(--green);
        background: rgba(172, 209, 163, 0.08);
    }

    .upload-zone img {
        display: block;
    }
</style>
