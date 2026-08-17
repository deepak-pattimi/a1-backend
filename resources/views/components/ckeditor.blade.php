<div {{ $attributes }}>
    <textarea id="{{ $id }}" name="{{ $name }}" class="ckeditor">{{ htmlspecialchars_decode($value) }}</textarea>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('{{ $id }}', {
            filebrowserUploadUrl: '{{ route("ckeditor.upload") }}?_token={{ csrf_token() }}',
            filebrowserUploadMethod: 'form',

            // Remove image2 (breaks Properties dialog), uploadimage (requires image2),
            // and exportpdf (needs paid token)
            removePlugins: 'image2,uploadimage,exportpdf',

            // Allow all content so width/height/style are never stripped from images
            allowedContent: true,
            extraAllowedContent: 'img[*]{*}(*)',

            on: {
                instanceReady: function (evt) {
                    evt.editor.setData(`{!! $value !!}`);
                },
                change: function(evt) {
                    evt.editor.updateElement();
                },

                // Custom image paste handler — uploads image then inserts with real dimensions
                paste: function (evt) {
                    var dataTransfer = evt.data.dataTransfer;
                    if (!dataTransfer || dataTransfer.getFilesCount() === 0) return;

                    var file = dataTransfer.getFile(0);
                    if (!file || file.type.indexOf('image') === -1) return;

                    evt.cancel(); // stop default paste

                    var editor = evt.editor;
                    var formData = new FormData();
                    formData.append('upload', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        url: '{{ route("ckeditor.upload") }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.uploaded) {
                                // Preload image to get natural width/height before inserting
                                var tempImg = new Image();
                                tempImg.onload = function () {
                                    var w = tempImg.naturalWidth;
                                    var h = tempImg.naturalHeight;
                                    editor.insertHtml(
                                        '<img src="' + response.url + '" width="' + w + '" height="' + h + '" />'
                                    );
                                };
                                tempImg.onerror = function () {
                                    // Fallback without dimensions if preload fails
                                    editor.insertHtml('<img src="' + response.url + '" />');
                                };
                                tempImg.src = response.url;
                            }
                        },
                        error: function () {
                            alert('Image upload failed. Please try again.');
                        }
                    });
                }
            }
        });
    });

    // Fallback: Ensure CKEditor updates the textarea on any form submit
    document.addEventListener('submit', function (e) {
        if (typeof CKEDITOR !== 'undefined') {
            for (var instanceName in CKEDITOR.instances) {
                CKEDITOR.instances[instanceName].updateElement();
            }
        }
    });
</script>
@endpush
