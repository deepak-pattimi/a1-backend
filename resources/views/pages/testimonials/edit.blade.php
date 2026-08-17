@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Edit Case Study / Testimonial</h2>

    <form method="POST" action="{{ route('testimonials.update', $item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        


        <div class="form-group row">
            <label for="youtube_link" class="col-sm-2 col-form-label">YouTube Link *</label>
            <div class="col-sm-10">
                <input type="url" name="youtube_link" id="youtube_link" class="form-control" value="{{ $item->youtube_link }}" required />
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
