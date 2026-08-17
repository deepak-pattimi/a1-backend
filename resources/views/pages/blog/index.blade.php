@extends('layouts.main')
@section('title', 'Blogs')


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
                        <h5>Blogs List</h5>
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
                            <a href="#">Blogs List</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <h4 class="mb-3">Blog Categories</h4>
            <a href="{{ route('blog-categories.create') }}" class="btn btn-primary mb-3"> Create New Category &nbsp; <i class="fa fa-plus"></i></a>
            <div class="card p-3">
                <div class="card-body">
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
                            @foreach($categories as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->order_no }}</td>
                                <td>
                                    <a href="{{ route('blog-categories.edit', $item->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-danger btn-sm deleteCategory" data-id="{{ $item->id }}" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct"> Create new article &nbsp; <i class="fa fa-plus"></i></a>
                <div class="form-inline">
                    <label class="mr-2 font-weight-bold">Filter by Category:</label>
                    <select id="category_filter" class="form-control" style="width: 250px;">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card p-3">
                <div class="card-body">
                    <table class="table table-bordered data-table">
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
                <form id="packageForm" name="packageForm" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="item_id" id="item_id">
                        <div class="form-group ">
                            <label for="blog_title" class="col-sm-6 control-label">Blog Title (EN)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="blog_title" name="blog_title"
                                    placeholder="Enter Blog Title" required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="blog_category_id" class="col-sm-6 control-label">Blog Category</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="blog_category_id" name="blog_category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $categoryItem)
                                        <option value="{{ $categoryItem->id }}">{{ $categoryItem->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <x-image-input name="blog_image" columns="col-md-12" value="{{ old('blog_image') }}" id="blog_image" label="Banner image" />
                     

                        <div class="form-group ">
                            <label  class="col-sm-6 control-label">Blog Content (EN)</label>
                            <div class="col-sm-12">
                            <x-ckeditor id="blog_content" name="blog_content" :value="null" />
                            </div>
                        </div>

                        <!-- FAQs Section -->
                        <div class="form-group">
                            <label class="col-sm-6 control-label">FAQs (Optional)</label>
                            <div class="col-sm-12">
                                <div id="faqs-container">
                                    <!-- FAQs will be dynamically inserted here -->
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" id="add-faq-btn">
                                    <i class="fa fa-plus"></i> Add FAQ
                                </button>
                            </div>
                        </div>
                        <!-- End FAQs Section -->




                    <div class="conatiner">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger float-right"
                                data-dismiss="modal">close</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
<script type="text/javascript">
    $(function () {
     
        /*------------------------------------------
         --------------------------------------------
         Pass Header Token
         --------------------------------------------
         --------------------------------------------*/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /*------------------------------------------
        --------------------------------------------
        Render DataTable
        --------------------------------------------
        --------------------------------------------*/
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('blog.index') }}",
                data: function (d) {
                    d.category_id = $('#category_filter').val();
                }
            },
            columns: [
                {title: 'SNO', data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {title: 'Blog Title', data: 'blog_title', name: 'blog_title'},
                {
                    title: 'Category', 
                    data: 'blog_category', 
                    name: 'blogCategory.name',
                    render: function(data, type, full, meta) {
                        return data ? data.name : 'N/A';
                    }
                },
                {
                    title: 'Status',
                    data: 'status',
                    name: 'status',
                    render: function(data, type, full, meta) {
                        return `
                            <label class="switch global-switch">
                                <input type="checkbox" class="toggle-status" ${data ? 'checked' : ''} data-id="${full.id}" data-url="${'/admin/change-status/blogs/'+full.id}">
                                <span class="slider round"></span>
                            </label>
                        `;
                    }
                },
                {
                    title: 'Blog Image',
                    data: "blog_image",
                    name: "blog_image",
                    render: function(data, type, full, meta) {
                        return '<img src="' + data + '" height="50"/>';
                    }
                },
                {title: 'Action', data: 'action', name: 'action', orderable: false, searchable: false},
            ]

        });

        $('#category_filter').change(function(){
            table.draw();
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Button
        --------------------------------------------
        --------------------------------------------*/
        $('#createNewProduct').click(function () {
            $('#packageForm').trigger("reset");
            $('#saveBtn').val("create-product");
            $('#item_id').val('');
            $('#packageForm').trigger("reset");
            $('#modelHeading').html("Create new blog");
            $('#ajaxModel').modal('show');
            $('#saveBtn').html('Save Changes');
            $('#faqs-container').empty();


            $('input[name="blog_image"]').val(''); 
            $('#preview-blog_image').html('');
    
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.editProduct', function () {
            var item_id = $(this).data('id');
            $.get("{{ route('blog.index') }}" + '/' + item_id + '/edit', function (data) {
                $('#modelHeading').html("Edit article");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#item_id').val(data.id);
                $('#blog_title').val(data.blog_title);
                $('#blog_category_id').val(data.blog_category_id);
                $('#category').val(data.category);
                $('#tags').val(data.tags);
                $('#read_time').val(data.read_time);
                $('#author_role').val(data.author_role);
                
                // Clear and render FAQs
                $('#faqs-container').empty();
                if (data.faqs && Array.isArray(data.faqs) && data.faqs.length > 0) {
                    data.faqs.forEach(function(faq, index) {
                        appendFaqField(index, faq.question, faq.answer);
                    });
                }



                $('#preview-blog_image').html(
                    `<div class="position-relative" style="display: inline-block;">
                        <img src="${data.blog_image}" style="height:50px;">
                        <button type="button" class="btn btn-sm btn-danger position-absolute" style="top:0; right:0;" onclick="singleRemoveImage('blog_image')">X</button>
                    </div>`
                );

                CKEDITOR.instances['blog_content'].setData(data.blog_content);
                $('#saveBtn').html('Save Changes');
            })
        });

        /*------------------------------------------
        --------------------------------------------
        Create Item
        --------------------------------------------
        --------------------------------------------*/
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            
            if (CKEDITOR.instances['blog_content']) {
                CKEDITOR.instances['blog_content'].updateElement();
            }

            var blog_content = CKEDITOR.instances['blog_content'] ? CKEDITOR.instances['blog_content'].getData() : '';
            
            var formdata = new FormData(document.getElementById('packageForm'));
            formdata.append('blog_content', blog_content);
            
            // Gather FAQs
            var faqs = [];
            $('.faq-item').each(function() {
                var q = $(this).find('.faq-question').val();
                var a = $(this).find('.faq-answer').val();
                if (q && a) {
                    faqs.push({ question: q, answer: a });
                }
            });
            // Append array as JSON or separate elements, since formData can handle arrays differently.
            // Let's loop and append as indexed array so Laravel understands it
            if (faqs.length > 0) {
                faqs.forEach((faq, index) => {
                    formdata.append(`faqs[${index}][question]`, faq.question);
                    formdata.append(`faqs[${index}][answer]`, faq.answer);
                });
            } else {
                formdata.append('faqs', '');
            }
            
            $.ajax({
                enctype: 'multipart/form-data',
                url: "{{ route('blog.store') }}",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#packageForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                    toastr.options.timeOut = 5000;
                    toastr.success(data.success);
                },
                error: function (response) {
                    if (response.status === 422) {
                        var errors = response.responseJSON.errors;
                        $.each(errors, function (field_name, error) {
                            toastr.error(error[0]);
                        });
                    } else {
                        toastr.error('An error occurred. Please try again.');
                    }
                    $('#saveBtn').html('Save Changes');
                }
            });
        });


        /*------------------------------------------
        --------------------------------------------
        Delete Code
        --------------------------------------------
        --------------------------------------------*/
        
        $('body').on('click', '.deleteProduct', function () {

            var item_id = $(this).data("id");

                swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('blog.store') }}" + '/' + item_id,
                        success: function (data) {
                            table.draw();
                            toastr.options.timeOut = 5000;
                            toastr.success("Record has been deleted");
                        },
                        error: function (response) {
                            toastr.options.timeOut = 5000;
                            toastr.error(data);

                        }
                    });
                }
            });

        });
        
        $('body').on('click', '.deleteCategory', function () {
            var item_id = $(this).data("id");
            swal({
                title: `Are you sure you want to delete this category?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('admin/blog-categories') }}" + '/' + item_id,
                        success: function (data) {
                            location.reload(); 
                        },
                        error: function (response) {
                            location.reload(); 
                        }
                    });
                }
            });
        });
        

    });
    
    // FAQ logic
    var faqIndex = 0;
    
    function appendFaqField(index, question = '', answer = '') {
        var faqHtml = `
            <div class="faq-item mb-3 border p-3 rounded position-relative">
                <button type="button" class="btn btn-danger btn-sm remove-faq-btn position-absolute" style="top: 10px; right: 10px;">
                    <i class="fa fa-times"></i>
                </button>
                <div class="form-group mb-2">
                    <label>Question</label>
                    <input type="text" class="form-control faq-question" value="${question}" placeholder="Enter question">
                </div>
                <div class="form-group mb-0">
                    <label>Answer</label>
                    <textarea class="form-control faq-answer" rows="3" placeholder="Enter answer">${answer}</textarea>
                </div>
            </div>
        `;
        $('#faqs-container').append(faqHtml);
    }
    
    $('#add-faq-btn').click(function() {
        appendFaqField(faqIndex);
        faqIndex++;
    });
    
    $(document).on('click', '.remove-faq-btn', function() {
        $(this).closest('.faq-item').remove();
    });



</script>
<!-- push external js -->
<script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
@endpush
@endsection