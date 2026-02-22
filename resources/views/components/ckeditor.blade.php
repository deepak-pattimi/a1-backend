<div {{ $attributes }}>
    <textarea id="{{ $id }}" name="{{ $name }}" class="ckeditor">{{ htmlspecialchars_decode($value) }}</textarea>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('{{ $id }}', {
            filebrowserUploadUrl: '{{ route("ckeditor.upload") }}?_token={{ csrf_token() }}',
            filebrowserUploadMethod: 'form',
            uploadUrl: '{{ route("ckeditor.upload") }}?_token={{ csrf_token() }}',
            on: {
                instanceReady: function (evt) {
                    evt.editor.setData(`{!! $value !!}`);
                }
            }
        });
    });
</script>
@endpush
