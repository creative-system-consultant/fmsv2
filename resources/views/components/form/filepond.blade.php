@props([
'label' => '',
'name' => ''
])

<label>
    <label class="block mb-2 text-sm font-medium
        {{$errors->has($name) ? 'text-negative-600' : 'text-gray-700 dark:text-gray-400'}}">
        {{$label}}
    </label>
    <div wire:ignore x-data x-init="
            () => {
                const post = FilePond.create($refs.{{ $attributes->get('ref') ?? 'input' }});
                post.setOptions({
                    allowMultiple: {{ $attributes->has('multiple') ? 'true' : 'false' }},
                    server: {
                        process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                            @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                        },
                        revert: (filename, load) => {
                            @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                        },
                    },
                    allowImagePreview: {{ $attributes->has('allowFileTypeValidation') ? 'true' : 'false' }},
                    imagePreviewMaxHeight: {{ $attributes->has('imagePreviewMaxHeight') ? $attributes->get('imagePreviewMaxHeight') : '256' }},
                    allowFileTypeValidation: {{ $attributes->has('allowFileTypeValidation') ? 'true' : 'false' }},
                    acceptedFileTypes: {!! $attributes->get('acceptedFileTypes') ?? 'null' !!},
                    allowFileSizeValidation: {{ $attributes->has('allowFileSizeValidation') ? 'true' : 'false' }},
                    maxFileSize: {!! $attributes->has('maxFileSize') ? "'".$attributes->get(' maxFileSize')."'" : 'null' !!}
                });
                this.addEventListener('pondReset', e=> {
                    post.removeFiles();
                });
            }
        "
    >
        <input type="file" x-ref="{{ $attributes->get('ref') ?? 'input' }}" class="" />
    </div>
    @if($errors->has($name)) <p class="-mt-2 text-sm text-negative-600">{{ $errors->first($name) }}</p> @endif
</label>