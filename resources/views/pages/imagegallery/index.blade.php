@extends('layouts.main')

@section('content')
<div class="container">

        <h2>Imagegallery Records</h2>

        <a href="{{ route('imagegallery.create') }}" class="btn btn-primary">Create New</a>

        <table class="table table-bordered">

        <thead>
<tr>
<th>ID</th>
<th>Image</th>
<th>Size</th>
<th>Actions</th>
</tr>
</thead>
<tbody>

        @foreach($items as $item)
<tr>

        <td>{{ $item->id }}</td>

                    @php
                        // Get file extension
                        $fileExtension = pathinfo($item->image, PATHINFO_EXTENSION);
                        
                        // Determine file type
                        $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        $isVideo = in_array(strtolower($fileExtension), ['mp4', 'webm', 'ogg']);
                        
                        // Calculate file size
                        $imagePathStr = $item->image;
                        if (filter_var($imagePathStr, FILTER_VALIDATE_URL)) {
                            $parsedUrl = parse_url($imagePathStr);
                            $imagePathStr = $parsedUrl['path'] ?? $imagePathStr;
                        }
                        
                        $filePath = public_path(ltrim($imagePathStr, '/'));
                        $fileSize = 'N/A';
                        if (!empty($item->image) && file_exists($filePath) && is_file($filePath)) {
                            $bytes = filesize($filePath);
                            $units = ['B', 'KB', 'MB', 'GB'];
                            $bytes = max($bytes, 0);
                            $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
                            $pow = min($pow, count($units) - 1);
                            $bytes /= (1 << (10 * $pow));
                            $fileSize = round($bytes, 2) . ' ' . $units[$pow];
                        }
                    @endphp
                
                    @if($isImage)
                        <td><img src="{{ asset($item->image) }}" style="height: 50px; object-fit: cover;" /></td>
                    @elseif($isVideo)
                        <td>
                            <video width="100" height="50" controls>
                                <source src="{{ asset($item->image) }}" type="video/{{ $fileExtension }}">
                                Your browser does not support the video tag.
                            </video>
                        </td>
                    @else
                        <td>{{ $item->image }}</td>
                    @endif
                <td>{{ $fileSize }}</td>
                <td>

        <a href="{{ route('imagegallery.edit', $item->id) }}" class="btn btn-info">Edit</a>

        <button class="btn btn-danger deleteItem" data-id="{{ $item->id }}">Delete</button>

        </td>
</tr>
@endforeach
</tbody>
</table>

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
                            url: "{{ url('admin/imagegallery') }}" + '/' + item_id,
                            success: function (data) {
                                // Reload the table or remove the row
                                location.reload(); // Option 1: Reload page
                                // Option 2: Remove row without reload
                                // $('tr[data-id="' + item_id + '"]').remove();
                                toastr.options.timeOut = 5000;
                                toastr.success("Record has been deleted");
                            },
                            error: function (response) {
                                toastr.options.timeOut = 5000;
                                toastr.success("Record has been deleted");
                                location.reload(); 
                            }
                        });
                    }
                });
            });
        </script>

        @endpush