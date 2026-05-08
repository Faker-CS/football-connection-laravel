{{--
  Reusable File Upload Component with Drag & Drop Support
  Supports images, PDFs, or both.

  @props:
    - name     (string): Field name for form submission. Default: 'image'
    - label    (string): Display label. Default: 'Image'
    - id       (string): Unique component ID. Auto-generated if not provided.
    - accept   (string): Override MIME type filter. Auto-set based on type if omitted.
    - maxSize  (int):    Max file size in MB per file. Default: 5
    - multiple (bool):   Allow multiple files (images only). Default: false
    - maxFiles (int):    Max number of files when multiple=true. Default: 6
    - type     (string): Upload mode — 'image' | 'pdf' | 'any'. Default: 'image'
                         'image' → image files only, shows image preview (original behaviour)
                         'pdf'   → PDF files only, shows file info card (name + size)
                         'any'   → accepts image/* and application/pdf, detects on select/drop

  Usage Examples:

    Single image (original behaviour, unchanged):
    <x-image-upload name="avatar" label="Photo de profil" maxSize="2" />

    Gallery (multiple images):
    <x-image-upload name="photos" label="Photos" multiple="true" maxFiles="6" maxSize="5" />

    Single PDF:
    <x-image-upload name="contract" label="Contrat du joueur" type="pdf" maxSize="10" />

    Image OR PDF (auto-detected):
    <x-image-upload name="licence" label="Licence UEFA (image ou PDF)" type="any" maxSize="8" />
--}}
@props([
    'name'     => 'image',
    'label'    => 'Image',
    'id'       => null,
    'accept'   => null,
    'maxSize'  => 5,
    'multiple' => false,
    'maxFiles' => 6,
    'type'     => 'image', // 'image' | 'pdf' | 'any'
])

@php
    $id = $id ?? $name . '_' . uniqid();
    $inputId        = $id . '_input';
    $zoneId         = $id . '_zone';
    $previewId      = $id . '_preview';
    $base64Id       = $id . '_base64';
    $contentId      = $id . '_content';
    $galleryPreviewId = $id . '_gallery';
    $pdfPreviewId   = $id . '_pdf_preview';
    $multipleAttr   = ($multiple && $type === 'image') ? 'multiple' : '';

    // Resolve accept attribute
    if ($accept) {
        $resolvedAccept = $accept;
    } elseif ($type === 'pdf') {
        $resolvedAccept = 'application/pdf';
    } elseif ($type === 'any') {
        $resolvedAccept = 'image/*,application/pdf';
    } else {
        $resolvedAccept = 'image/*';
    }

    $isPdf   = $type === 'pdf';
    $isAny   = $type === 'any';
    $isImage = $type === 'image';
@endphp

<div class="form-group">
    <label class="form-label">
        {{ $label }}
        @if($multiple && $isImage)
            <span class="form-hint">({{ $maxFiles }} max)</span>
        @endif
    </label>

    <div
        class="upload-zone"
        id="{{ $zoneId }}"
        ondrop="handleFileDrop_{{ $id }}(event)"
        ondragover="handleFileDragOver_{{ $id }}(event)"
        ondragleave="handleFileDragLeave_{{ $id }}(event)"
        data-upload-id="{{ $id }}"
    >
        <input
            type="file"
            id="{{ $inputId }}"
            name="{{ $name }}{{ ($multiple && $isImage) ? '[]' : '' }}"
            accept="{{ $resolvedAccept }}"
            {{ $multipleAttr }}
            style="display: none;"
            onchange="handleFileSelect_{{ $id }}(event)"
        >

        {{-- Default upload prompt --}}
        <div id="{{ $contentId }}">
            @if($isPdf)
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin: 0 auto 0.5rem; color: var(--muted);">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
            @elseif($isAny)
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin: 0 auto 0.5rem; color: var(--muted);">
                    <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/>
                </svg>
            @else
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin: 0 auto 0.5rem; color: var(--muted);">
                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <path d="M21 15l-5-5L5 21"/>
                </svg>
            @endif
            <div style="font-weight: 600; font-size: 0.85rem; color: var(--text); margin-bottom: 0.25rem;">
                @if($isPdf)
                    Glissez votre PDF ici ou cliquez pour sélectionner
                @elseif($isAny)
                    Glissez un fichier ici ou cliquez pour sélectionner
                @else
                    Glissez votre{{ $multiple ? 's image' : ' image' }} ici ou cliquez pour sélectionner
                @endif
            </div>
            <div style="font-size: 0.75rem; color: var(--muted);">
                @if($isPdf)
                    Format accepté : PDF (max {{ $maxSize }} Mo)
                @elseif($isAny)
                    Formats acceptés : JPG, PNG, PDF (max {{ $maxSize }} Mo)
                @else
                    Formats acceptés : JPG, PNG (max {{ $maxSize }} Mo{{ $multiple ? ' par image' : '' }})
                @endif
            </div>
        </div>

        {{-- Image single preview --}}
        @if($isImage && !$multiple)
            <div id="{{ $previewId }}" style="display: none;">
                <img id="{{ $previewId }}_img" style="max-width: 100%; max-height: 200px; border-radius: 10px; margin-bottom: 0.75rem;">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeFile_{{ $id }}()" style="width: 100%;">
                    Supprimer l'image
                </button>
            </div>
        @endif

        {{-- Image gallery preview --}}
        @if($isImage && $multiple)
            <div id="{{ $galleryPreviewId }}" style="display: none; gap: 0.4rem; flex-wrap: wrap; margin-top: 1rem;"></div>
        @endif

        {{-- PDF preview card --}}
        @if($isPdf || $isAny)
            <div id="{{ $pdfPreviewId }}" style="display: none; align-items: center; gap: 0.75rem; background: var(--bg, #f9faf9); border: 1px solid var(--border); border-radius: 10px; padding: 0.85rem 1rem; margin-top: 0.5rem;">
                <div style="flex-shrink:0; width:36px; height:36px; background: rgba(220,38,38,0.1); border-radius:8px; display:flex; align-items:center; justify-content:center;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </div>
                <div style="flex:1; min-width:0;">
                    <div id="{{ $pdfPreviewId }}_name" style="font-size:0.85rem; font-weight:600; color:var(--text); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"></div>
                    <div id="{{ $pdfPreviewId }}_size" style="font-size:0.75rem; color:var(--muted); margin-top:0.1rem;"></div>
                </div>
                <button type="button" onclick="removeFile_{{ $id }}()" style="flex-shrink:0; background:none; border:none; cursor:pointer; color:#dc2626; padding:0.25rem;" title="Supprimer">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
        @endif

        {{-- Any-mode image preview (reuse single image preview markup) --}}
        @if($isAny)
            <div id="{{ $previewId }}" style="display: none; margin-top: 0.5rem;">
                <img id="{{ $previewId }}_img" style="max-width: 100%; max-height: 200px; border-radius: 10px; margin-bottom: 0.75rem;">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeFile_{{ $id }}()" style="width: 100%;">
                    Supprimer l'image
                </button>
            </div>
        @endif

    </div>

    <input type="hidden" id="{{ $base64Id }}" name="{{ $name }}_base64">
</div>

<script>
(function() {
    var uploadType = '{{ $type }}';
    var maxSizeMB  = {{ $maxSize }};
    var maxFiles   = {{ $maxFiles }};

    // ── Drag & Drop ──────────────────────────────────────────────────────────
    window['handleFileDrop_{{ $id }}'] = function(e) {
        e.preventDefault();
        e.stopPropagation();
        document.getElementById('{{ $zoneId }}').classList.remove('dragover');
        var files = e.dataTransfer.files;
        if (files.length > 0) {
            document.getElementById('{{ $inputId }}').files = files;
            window['handleFileSelect_{{ $id }}']({ target: { files: files } });
        }
    };

    window['handleFileDragOver_{{ $id }}'] = function(e) {
        e.preventDefault();
        e.stopPropagation();
        document.getElementById('{{ $zoneId }}').classList.add('dragover');
    };

    window['handleFileDragLeave_{{ $id }}'] = function(e) {
        e.preventDefault();
        e.stopPropagation();
        document.getElementById('{{ $zoneId }}').classList.remove('dragover');
    };

    // ── File select dispatcher ────────────────────────────────────────────────
    window['handleFileSelect_{{ $id }}'] = function(e) {
        var files = e.target.files;
        if (!files || files.length === 0) return;

        if (uploadType === 'pdf') {
            window['handlePdf_{{ $id }}'](files[0]);
            return;
        }

        if (uploadType === 'image') {
            var isMultiple = {{ $multiple ? 'true' : 'false' }};
            if (isMultiple) {
                window['previewGallery_{{ $id }}'](files, maxFiles);
            } else {
                window['previewSingleImage_{{ $id }}'](files[0]);
            }
            return;
        }

        // type === 'any': detect by MIME
        if (uploadType === 'any') {
            var file = files[0];
            if (file.type === 'application/pdf') {
                window['handlePdf_{{ $id }}'](file);
            } else if (file.type.startsWith('image/')) {
                window['previewSingleImage_{{ $id }}'](file);
            }
        }
    };

    // ── Single image preview ─────────────────────────────────────────────────
    window['previewSingleImage_{{ $id }}'] = function(file) {
        if (!file || !file.type.startsWith('image/')) return;
        var reader = new FileReader();
        reader.onload = function(ev) {
            document.getElementById('{{ $previewId }}_img').src = ev.target.result;
            document.getElementById('{{ $base64Id }}').value = ev.target.result;
            document.getElementById('{{ $contentId }}').style.display = 'none';
            document.getElementById('{{ $previewId }}').style.display = 'block';
        };
        reader.readAsDataURL(file);
    };

    // ── Gallery preview ──────────────────────────────────────────────────────
    window['previewGallery_{{ $id }}'] = function(files, max) {
        var preview = document.getElementById('{{ $galleryPreviewId }}');
        preview.innerHTML = '';
        var count = Math.min(files.length, max);
        for (var i = 0; i < count; i++) {
            (function(file) {
                if (!file || !file.type.startsWith('image/')) return;
                var reader = new FileReader();
                reader.onload = function(ev) {
                    var thumb = document.createElement('div');
                    thumb.style.cssText = 'position:relative;width:80px;height:80px;border-radius:8px;overflow:hidden;flex-shrink:0;';
                    var img = document.createElement('img');
                    img.src = ev.target.result;
                    img.style.cssText = 'width:100%;height:100%;object-fit:cover;';
                    var btn = document.createElement('button');
                    btn.type = 'button';
                    btn.style.cssText = 'position:absolute;top:-25px;right:-25px;width:30px;height:30px;border-radius:50%;background:#dc2626;color:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;opacity:0;transition:all 0.2s;';
                    btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>';
                    btn.onclick = function(ev2) { ev2.preventDefault(); thumb.remove(); };
                    thumb.addEventListener('mouseenter', function() { btn.style.opacity='1'; btn.style.top='5px'; btn.style.right='5px'; });
                    thumb.addEventListener('mouseleave', function() { btn.style.opacity='0'; btn.style.top='-25px'; btn.style.right='-25px'; });
                    thumb.appendChild(img);
                    thumb.appendChild(btn);
                    preview.appendChild(thumb);
                };
                reader.readAsDataURL(file);
            })(files[i]);
        }
        document.getElementById('{{ $contentId }}').style.display = 'none';
        preview.style.display = 'flex';
    };

    // ── PDF preview card ─────────────────────────────────────────────────────
    window['handlePdf_{{ $id }}'] = function(file) {
        if (!file || file.type !== 'application/pdf') return;

        // Format file size
        var size = file.size;
        var sizeStr = size < 1024 * 1024
            ? (size / 1024).toFixed(1) + ' Ko'
            : (size / (1024 * 1024)).toFixed(2) + ' Mo';

        document.getElementById('{{ $pdfPreviewId }}_name').textContent = file.name;
        document.getElementById('{{ $pdfPreviewId }}_size').textContent = sizeStr;
        document.getElementById('{{ $contentId }}').style.display = 'none';
        document.getElementById('{{ $pdfPreviewId }}').style.display = 'flex';
    };

    // ── Remove / reset ───────────────────────────────────────────────────────
    window['removeFile_{{ $id }}'] = function() {
        document.getElementById('{{ $inputId }}').value = '';
        document.getElementById('{{ $base64Id }}').value = '';
        document.getElementById('{{ $contentId }}').style.display = 'block';

        // Hide all previews
        var imgPrev = document.getElementById('{{ $previewId }}');
        if (imgPrev) imgPrev.style.display = 'none';

        var gallPrev = document.getElementById('{{ $galleryPreviewId }}');
        if (gallPrev) { gallPrev.style.display = 'none'; gallPrev.innerHTML = ''; }

        var pdfPrev = document.getElementById('{{ $pdfPreviewId }}');
        if (pdfPrev) pdfPrev.style.display = 'none';
    };

    // ── Click zone to open file picker ───────────────────────────────────────
    document.getElementById('{{ $zoneId }}').addEventListener('click', function(e) {
        if (
            !e.target.closest('#{{ $previewId }}') &&
            !e.target.closest('#{{ $galleryPreviewId }}') &&
            !e.target.closest('#{{ $pdfPreviewId }}')
        ) {
            document.getElementById('{{ $inputId }}').click();
        }
    });
})();
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