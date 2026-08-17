@extends('layouts.main')
@section('title', 'Pages')

<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">

@endpush


@section('content')



<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h5>Dynamic Pages & Categories</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Dynamic Pages & Categories</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            
            <div class="card p-3">
                <div class="card-header border-bottom mb-3">
                    <h3>Categories</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('category.create') }}" class="btn btn-primary mb-3 mt-2">Create New Category</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Order</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->order_no }}</td>
                                <td>
                                    <a href="{{ route('category.edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-danger btn-sm deleteItem" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card p-3 mt-4">
                <div class="card-header border-bottom mb-3">
                    <h3>Dynamic Pages</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 mt-2">
                        <a class="btn btn-primary" href="javascript:void(0)" id="createNewPage"> Create new page &nbsp; <i class="fa fa-plus"></i></a>
                        <div class="form-inline">
                            <label class="mr-2 font-weight-bold">Filter by Category:</label>
                            <select id="category_filter" class="form-control" style="width: 250px;">
                                <option value="">All Categories</option>
                                @foreach($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table class="table table-bordered data-table w-100">
                        <!-- Dynamic DataTable from jquery -->
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="pageForm" name="pageForm" class="form-horizontal">
                    {{ csrf_field() }}
                    <div id="formErrors" class="alert alert-danger d-none"></div>
                    <input type="hidden" name="item_id" id="item_id">
                    <div class="form-group">
                        <label for="category_id" class="col-sm-6 control-label">Category</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">Select Category</option>
                                @foreach($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="page_name" class="col-sm-6 control-label">Page Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Enter Page Name" required="true">
                        </div>
                    </div>

                        <div class="form-group ">
                            <label  class="col-sm-6 control-label">Content (EN)</label>
                            <div class="col-sm-12">
                            <x-ckeditor id="content" name="content" :value="null" />
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <label class="col-sm-12 control-label font-weight-bold">FAQs</label>
                            <div class="col-sm-12">
                                <div id="faq-container">
                                    <!-- Dynamic FAQ fields will be appended here -->
                                </div>
                                <button type="button" class="btn btn-success btn-sm mt-2" id="add-faq-btn">
                                    <i class="fa fa-plus"></i> Add FAQ
                                </button>
                            </div>
                        </div>



                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

<script type="text/javascript">

    /* ===============================
       Notification Helper
    =============================== */
    function showNotification(title, message, type = 'success') {
        toastr[type](message, title);
    }

    $(function () {
        
        let faqIndex = 0;
        
        function addFaqRow(question = '', answer = '') {
            const html = `
                <div class="faq-row border p-2 mb-2 bg-light position-relative">
                    <button type="button" class="btn btn-sm btn-danger remove-faq-btn position-absolute" style="top:5px; right:5px;"><i class="fa fa-times"></i></button>
                    <div class="form-group mb-2">
                        <label>Question</label>
                        <input type="text" name="faqs[${faqIndex}][question]" class="form-control" value="${question}">
                    </div>
                    <div class="form-group mb-0">
                        <label>Answer</label>
                        <textarea name="faqs[${faqIndex}][answer]" class="form-control" rows="2">${answer}</textarea>
                    </div>
                </div>
            `;
            $('#faq-container').append(html);
            faqIndex++;
        }

        $('#add-faq-btn').click(function() {
            addFaqRow();
        });

        $(document).on('click', '.remove-faq-btn', function() {
            $(this).closest('.faq-row').remove();
        });

        /* ===============================
           CSRF Token
        =============================== */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* ===============================
           DataTable
        =============================== */
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('pages.index') }}",
                data: function (d) {
                    d.category_id = $('#category_filter').val();
                }
            },
            columns: [
                { data: 'id', name: 'id', title: 'ID' },
                { data: 'page_name', name: 'page_name', title: 'Page Name' },
                { data: 'category.name', name: 'category.name', title: 'Category' },
                { data: 'action', name: 'action', orderable: false, searchable: false, title: 'Action' },
            ]
        });

        $('#category_filter').change(function(){
            table.draw();
        });

        /* ===============================
           Create Page
        =============================== */
        $('#createNewPage').click(function () {
            $('#pageForm')[0].reset();
            $('#item_id').val('');
            $('#formErrors').addClass('d-none').html('');
            $('#modelHeading').html("Create New Page");
            $('#ajaxModel').modal('show');

            if (CKEDITOR.instances['content']) {
                CKEDITOR.instances['content'].setData('');
            }
            
            // Reset FAQs
            $('#faq-container').html('');
            faqIndex = 0;
        });

        /* ===============================
           Edit Page
        =============================== */
        $('body').on('click', '.editProduct', function () {
            let item_id = $(this).data('id');

            $.get("{{ route('pages.index') }}/" + item_id + "/edit", function (data) {
                $('#modelHeading').html("Edit Page");
                $('#ajaxModel').modal('show');
                $('#formErrors').addClass('d-none').html('');

                $('#item_id').val(data.id);
                $('#page_name').val(data.page_name);
                $('#category_id').val(data.category_id);

                if (CKEDITOR.instances['content']) {
                    CKEDITOR.instances['content'].setData(data.content ?? '');
                }

                // Populate FAQs
                $('#faq-container').html('');
                faqIndex = 0;
                if (data.faqs && Array.isArray(data.faqs)) {
                    data.faqs.forEach(faq => {
                        addFaqRow(faq.question, faq.answer);
                    });
                }

            });
        });

        /* ===============================
           Save Page
        =============================== */
        $('#saveBtn').click(function (e) {
            e.preventDefault();

            // Sync CKEditor content to the textarea element before serializing
            for (var instanceName in CKEDITOR.instances) {
                if (CKEDITOR.instances.hasOwnProperty(instanceName)) {
                    CKEDITOR.instances[instanceName].updateElement();
                }
            }

            var formData = $('#pageForm').serialize();
            
            // Fallback: Ensure content is included if it was stripped
            if (CKEDITOR.instances['content']) {
                var editorData = CKEDITOR.instances['content'].getData();
                var params = new URLSearchParams(formData);
                if (!params.get('content') || params.get('content').trim() === '') {
                    params.set('content', editorData);
                    formData = params.toString();
                }
            }

            $('#saveBtn').html('Sending...');

            $.ajax({
                url: "{{ route('pages.store') }}",
                type: "POST",
                data: formData,
                dataType: 'json',

                success: function (data) {
                    $('#ajaxModel').modal('hide');
                    $('#pageForm')[0].reset();
                    table.draw();

                    showNotification('Success', data.success, 'success');
                    $('#saveBtn').html('Save');
                },

                error: function (xhr) {
                    $('#saveBtn').html('Save');

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<ul>';
                        let firstError = '';

                        $.each(errors, function (key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                            if (!firstError) firstError = value[0];
                        });

                        errorHtml += '</ul>';

                        $('#formErrors')
                            .removeClass('d-none')
                            .html(errorHtml);

                        // ✅ Toastr uses "error" NOT "danger"
                        showNotification('Validation Error', firstError, 'error');
                    } else {
                        showNotification('Error', 'Something went wrong!', 'error');
                    }
                }
            });
        });

        /* ===============================
           Delete Page
        =============================== */
        $('body').on('click', '.deleteProduct', function () {
            let item_id = $(this).data("id");

            if (!confirm("Are you sure you want to delete?")) return;

            $.ajax({
                type: "DELETE",
                url: "{{ route('pages.store') }}/" + item_id,
                success: function (data) {
                    table.draw();
                    showNotification('Success', data.success, 'success');
                },
                error: function () {
                    showNotification('Error', 'Delete failed!', 'error');
                }
            });
        });

        /* ===============================
           Delete Category
        =============================== */
        $('body').on('click', '.deleteItem', function () {
            var item_id = $(this).data("id");
            if (!confirm("Are you sure you want to delete this category?")) return;

            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/category') }}/" + item_id,
                success: function (data) {
                    location.reload(); 
                },
                error: function (response) {
                    location.reload(); 
                }
            });
        });

    });
</script>

<!-- push external js -->
<script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
@endpush