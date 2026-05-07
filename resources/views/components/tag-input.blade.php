{{--
  Reusable Tag Input Component with Add/Remove Functionality
  
  @props:
    - name (string): Field name for form submission. Default: 'tags'
    - label (string): Display label. Default: 'Tags'
    - id (string): Unique component ID. Auto-generated if not provided.
    - placeholder (string): Input placeholder text. Default: 'Add a tag...'
    - maxTags (int): Max number of tags allowed. Default: 0 (unlimited)
    - tags (array): Initial tags to display. Default: []
    - separator (string): Separator for form submission ('comma' or 'json'). Default: 'comma'
  
  Usage Examples:
    Basic skills input:
    <x-tag-input 
      name="skills" 
      label="Skills"
      placeholder="Add a skill..."
    />
    
    With initial tags:
    <x-tag-input 
      name="positions" 
      label="Positions"
      placeholder="Add a position..."
      :tags="['Goalkeeper', 'Defender']"
      maxTags="5"
    />
--}}
@props([
    'name' => 'tags',
    'label' => 'Tags',
    'id' => null,
    'placeholder' => 'Add a tag...',
    'maxTags' => 0,
    'tags' => [],
    'separator' => 'comma',
])

@php
    $id = $id ?? $name . '_' . uniqid();
    $inputId = $id . '_input';
    $containerId = $id . '_container';
    $hiddenId = $id . '_hidden';
    $tagsListId = $id . '_list';
@endphp

<div class="form-group">
    <label class="form-label">{{ $label }}</label>

    <div class="tag-input-wrapper" id="{{ $containerId }}"
        style="border: 1px solid var(--border); border-radius: var(--radius); padding: 0.6rem 0.8rem; background: var(--white); display: flex; flex-wrap: wrap; gap: 0.4rem; align-items: flex-start;">
        <div id="{{ $tagsListId }}"
            style="display: flex; flex-wrap: wrap; gap: 0.4rem; flex: 1; min-width: 150px; align-items: center;">
            @foreach ($tags as $tag)
                <div class="tag-item" data-tag="{{ $tag }}"
                    style="display: inline-flex; align-items: center; gap: 0.4rem; background: var(--green-light, #d1f2e8); color: var(--text); padding: 0.35rem 0.6rem; border-radius: 6px; font-size: 0.85rem; font-weight: 500;">
                    <span>{{ $tag }}</span>
                    <button type="button" class="tag-remove" onclick="removeTag_{{ $id }}(this)"
                        style="background: none; border: none; color: var(--text); cursor: pointer; padding: 0; display: flex; align-items: center; opacity: 0.6; transition: opacity 0.2s; font-weight: bold;">
                        ✕
                    </button>
                </div>
            @endforeach

            <input type="text" id="{{ $inputId }}" class="tag-input" placeholder="{{ $placeholder }}"
                style="border: none; outline: none; background: transparent; flex: 1; min-width: 120px; font-size: 0.9rem; color: var(--text);"
                onkeydown="handleTagInput_{{ $id }}(event)"
                onpaste="handleTagPaste_{{ $id }}(event)">
        </div>
    </div>

    <input type="hidden" id="{{ $hiddenId }}" name="{{ $name }}" value="">
</div>

<script>
    // Tag input state
    window['tagState_{{ $id }}'] = {
        tags: @json($tags),
        maxTags: {{ $maxTags }},
        separator: '{{ $separator }}',
        containerId: '{{ $containerId }}',
        tagsListId: '{{ $tagsListId }}',
        inputId: '{{ $inputId }}',
        hiddenId: '{{ $hiddenId }}',
        id: '{{ $id }}'
    };

    // Handle tag input
    window['handleTagInput_{{ $id }}'] = function(e) {
        const state = window['tagState_{{ $id }}'];

        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            const value = e.target.value.trim();
            if (value) {
                window['addTag_{{ $id }}'](value);
                e.target.value = '';
            }
        } else if (e.key === 'Backspace' && !e.target.value) {
            const lastTag = state.tags[state.tags.length - 1];
            if (lastTag) {
                window['removeTagByValue_{{ $id }}'](lastTag);
            }
        }
    };

    // Handle paste events
    window['handleTagPaste_{{ $id }}'] = function(e) {
        e.preventDefault();
        const pastedText = (e.clipboardData || window.clipboardData).getData('text');
        const values = pastedText.split(/[,\n]+/).map(v => v.trim()).filter(v => v.length > 0);

        values.forEach(value => {
            window['addTag_{{ $id }}'](value);
        });
    };

    // Add tag
    window['addTag_{{ $id }}'] = function(tagValue) {
        const state = window['tagState_{{ $id }}'];

        if (state.tags.includes(tagValue)) return;
        if (state.maxTags > 0 && state.tags.length >= state.maxTags) return;

        state.tags.push(tagValue);
        window['renderTags_{{ $id }}']();
        window['updateHidden_{{ $id }}']();
    };

    // Remove tag by value
    window['removeTagByValue_{{ $id }}'] = function(tagValue) {
        const state = window['tagState_{{ $id }}'];
        state.tags = state.tags.filter(t => t !== tagValue);
        window['renderTags_{{ $id }}']();
        window['updateHidden_{{ $id }}']();
    };

    // Remove tag (button click)
    window['removeTag_{{ $id }}'] = function(btn) {
        const tagItem = btn.closest('.tag-item');
        const tagValue = tagItem.dataset.tag;
        window['removeTagByValue_{{ $id }}'](tagValue);
    };

    // Render tags
    window['renderTags_{{ $id }}'] = function() {
        const state = window['tagState_{{ $id }}'];
        const tagsList = document.getElementById(state.tagsListId);

        // Remove all tag items (keep input)
        const tagItems = tagsList.querySelectorAll('.tag-item');
        tagItems.forEach(item => item.remove());

        // Add tags back
        state.tags.forEach(tag => {
            const tagElement = document.createElement('div');
            tagElement.className = 'tag-item';
            tagElement.dataset.tag = tag;
            tagElement.style.cssText =
                'display: inline-flex; align-items: center; gap: 0.4rem; background: var(--green-light, #d1f2e8); color: var(--text); padding: 0.35rem 0.6rem; border-radius: 6px; font-size: 0.85rem; font-weight: 500;';

            const tagText = document.createElement('span');
            tagText.textContent = tag;

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'tag-remove';
            removeBtn.textContent = '✕';
            removeBtn.style.cssText =
                'background: none; border: none; color: var(--text); cursor: pointer; padding: 0; display: flex; align-items: center; opacity: 0.6; transition: opacity 0.2s; font-weight: bold;';
            removeBtn.onclick = function(e) {
                e.preventDefault();
                window['removeTag_{{ $id }}'](this);
            };

            tagElement.appendChild(tagText);
            tagElement.appendChild(removeBtn);
            tagsList.appendChild(tagElement);
        });
    };

    // Update hidden field
    window['updateHidden_{{ $id }}'] = function() {
        const state = window['tagState_{{ $id }}'];
        const hidden = document.getElementById(state.hiddenId);

        if (state.separator === 'json') {
            hidden.value = JSON.stringify(state.tags);
        } else {
            hidden.value = state.tags.join(', ');
        }
    };

    // Initialize
    window['updateHidden_{{ $id }}']();

    // Prevent form submission on Enter in tag input
    document.getElementById('{{ $inputId }}').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
</script>

<style>
    .tag-input-wrapper {
        transition: border-color 0.2s;
    }

    .tag-input-wrapper:focus-within {
        border-color: var(--green);
        box-shadow: 0 0 0 3px rgba(172, 209, 163, 0.1);
    }

    .tag-item {
        animation: tagSlideIn 0.2s ease;
    }

    .tag-item:hover .tag-remove {
        opacity: 1;
    }

    @keyframes tagSlideIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>
