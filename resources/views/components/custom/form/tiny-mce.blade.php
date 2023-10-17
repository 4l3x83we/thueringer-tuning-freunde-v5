    <div wire:ignore class="shadow-xl">
        <textarea wire:model="{{ $model ?? '' }}" class="min-h-fit h-48 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" name="{{ $model ?? '' }}" id="{{ $id ?? '' }}"></textarea>
    </div>
    @error($model ?? '')
    <span class="text-xs text-red-600 dark:text-red-500">
        {{ $message }}
    </span>
    @enderror

    @push('scripts')
        <script>
            tinymce.init({
                selector: '#{{ $id ?? '' }}',
                height: '250',
                menubar: false,
                plugins: 'anchor autolink charmap codesample emoticons image link lists searchreplace table visualblocks wordcount code',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat | code',
                language: 'de',
                // forced_root_block: false,
                setup: function (editor) {
                    editor.on('init change', function () {
                        editor.save();
                    });
                    editor.on('change', function () {
                        @this.set('{{  $model ?? '' }}', editor.getContent());
                    });
                }
            });
        </script>
    @endpush
