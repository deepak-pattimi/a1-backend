<script src="{{ asset('dist/js/all.js') }}"></script>
<script src="{{ asset('dist/js/theme.js') }}"></script>
<script src="{{ asset('js/toaster.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{ asset('plugins/lazy/jquery.lazy.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

@livewireScripts
<script src="{{asset('dist/js/livewire.js')}}"></script>

<script>
    // Show success message using Toastr
    @if(Session::has('success'))
        toastr.success("{{ session('success') }}");
    @endif

    // Show error message using Toastr
    @if(Session::has('error'))
        toastr.error("{{ session('error') }}");
    @endif

    // Display validation errors using Toastr
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>

@stack('script')
@stack('scripts')

<script>
    /* ==============================================================
       Global Fix: Bootstrap modal steals focus from CKEditor dialogs
       This prevents keyboard input from being blocked in Image Properties,
       Link dialogs, etc. — applies to every page using CKEditor.
    ============================================================== */
    $(document).on('focusin', function (e) {
        if ($(e.target).closest('.cke_dialog_ui_input_text, .cke_dialog_ui_input_textarea, .cke_dialog, .cke_editor').length) {
            e.stopImmediatePropagation();
        }
    });

    // Global fix to ensure all CKEditors update their corresponding textareas on form submit
    window.addEventListener('submit', function (e) {
        if (typeof CKEDITOR !== 'undefined') {
            for (var instanceName in CKEDITOR.instances) {
                CKEDITOR.instances[instanceName].updateElement();
            }
        }
    }, true); // The 'true' uses the capture phase so it runs before ANY other submit handlers
</script>