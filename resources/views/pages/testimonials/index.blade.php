@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Case Studies & Testimonials</h2>
            <a href="{{ route('testimonials.create') }}" class="btn btn-primary mb-3">Create New</a>

            <div class="card p-3">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Video</th>
                                <th>YouTube Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    @php
                                        $videoId = null;
                                        if (preg_match('~youtube\.com/shorts/([^\?\/]+)~', $item->youtube_link, $m)) {
                                            $videoId = $m[1];
                                        }
                                        elseif (preg_match('~v=([^\&]+)~', $item->youtube_link, $m)) {
                                            $videoId = $m[1];
                                        }
                                        elseif (preg_match('~youtu\.be/([^\?\/]+)~', $item->youtube_link, $m)) {
                                            $videoId = $m[1];
                                        }
                                    @endphp

                                    @if($videoId)
                                        <iframe
                                            width="150"
                                            height="100"
                                            src="https://www.youtube.com/embed/{{ $videoId }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    @else
                                        <span class="text-danger">Invalid video link</span>
                                    @endif
                                </td>
                                <td><a href="{{ $item->youtube_link }}" target="_blank">{{ $item->youtube_link }}</a></td>
                                <td>
                                    <a href="{{ route('testimonials.edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-danger btn-sm deleteItem" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.deleteItem', function () {
        var item_id = $(this).data("id");
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admin/testimonials') }}/" + item_id,
                    success: function (data) {
                        toastr.success("Record has been deleted");
                        setTimeout(() => location.reload(), 1000);
                    },
                    error: function (response) {
                        toastr.error("Error deleting record");
                    }
                });
            }
        });
    });
</script>
@endpush
