@props(['name', 'value', 'label', 'columns'])

<div class="form-group {{ $columns }}">
    <label for="{{ $name }}" class="col-sm-12">{{ $label }}</label>
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <button type="button" class="input-group-text admin-file-manager" onclick="singleOpenFileManager('{{ $name }}')">
                    <i class="fa fa-chevron-up"> &nbsp;Click here to choose</i>
                </button>
            </div>
            <input type="text" name="{{ $name }}" id="{{ $name }}" hidden value="{{ $value ? $value : old($name) }}" readonly class="form-control"/>
            <div class="input-group-append">
                <button type="button" class="input-group-text admin-file-view" onclick="singleViewSelectedFile('{{ $name }}')">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
        </div>
        <div class="mt-2 position-relative" id="preview-{{ $name }}">
            @if($value)
                <img src="{{ asset($value) }}" alt="" onerror="this.src='/img/logo.png';" style="height:30px; margin-right: 10px;">
                <button type="button" class="btn btn-sm btn-danger position-absolute" style="top:0; right:0;" onclick="singleRemoveImage('{{ $name }}')">X</button>
            @endif
        <input type="file" id="{{ $name }}_file" name="{{ $name }}_file" class="form-control mt-2" accept="image/*" />
        <small class="form-text text-muted">Or upload from your device.</small>
        <div class="mt-2 position-relative" id="preview-{{ $name }}">
            @if($value)
                <img src="{{ asset($value) }}" alt="" onerror="this.src='/img/logo.png';" style="height:30px; margin-right: 10px;">
                <button type="button" class="btn btn-sm btn-danger position-absolute" style="top:0; right:0;" onclick="singleRemoveImage('{{ $name }}')">X</button>
            @endif
        </div>
    </div>
</div>

@push('script')
<script>
function singleOpenFileManager(inputId) {
    console.log(inputId);

    // Ensure previous SetUrl function is removed
    window.SetUrl = undefined;

    window.open('/laravel-filemanager', 'fm', 'width=1100,height=600');

    window.SetUrl = function (items) {
        if (!items || items.length === 0) {
            console.error("No items selected");
            return;
        }

        const input = document.getElementById(inputId);
        const preview = document.getElementById('preview-' + inputId);
        const fileInput = document.getElementById(inputId + '_file');
        if (fileInput) {
            fileInput.value = '';
        }

        let filePath = items[0].url;
        input.value = filePath;

        preview.innerHTML = `
            <div class="position-relative" style="display: inline-block;">
                <img src="${filePath}" style="height:50px;">
                <button type="button" class="btn btn-sm btn-danger position-absolute" style="top:0; right:0;" onclick="singleRemoveImage('${inputId}')">X</button>
            </div>
        `;

        console.log("Selected file URL:", filePath);
    };
}

function singleRemoveImage(inputId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById('preview-' + inputId);
    const fileInput = document.getElementById(inputId + '_file');

    if (input) {
        input.value = '';
    }
    if (fileInput) {
        fileInput.value = '';
    }
    if (preview) {
        preview.innerHTML = '';
    }
}

function singleViewSelectedFile(inputId) {
    const input = document.getElementById(inputId);
    const filePath = input.value;
    if (filePath) {
        $('#fileViewModalBody').html('<img src="' + filePath + '" style="width:100%;" />');
        $('#fileViewModal').modal('show');
    } else {
        alert('No file selected');
    }
}

function initLocalFileInput(inputId) {
    const fileInput = document.getElementById(inputId + '_file');
    const textInput = document.getElementById(inputId);
    const preview = document.getElementById('preview-' + inputId);

    if (!fileInput) {
        return;
    }

    fileInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (!file) {
            return;
        }

        if (textInput) {
            textInput.value = '';
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.innerHTML = `
                <div class="position-relative" style="display: inline-block;">
                    <img src="${e.target.result}" style="height:50px;">
                    <button type="button" class="btn btn-sm btn-danger position-absolute" style="top:0; right:0;" onclick="singleRemoveImage('${inputId}')">X</button>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    initLocalFileInput('{{ $name }}');
});
</script>
@endpush
