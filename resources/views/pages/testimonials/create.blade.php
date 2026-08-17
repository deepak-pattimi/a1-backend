@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Create New Case Study / Testimonial</h2>

    <form method="POST" action="{{ route('testimonials.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group row">
            <label for="youtube_link" class="col-sm-2 col-form-label">YouTube Link *</label>
            <div class="col-sm-10">
                <input type="url" name="youtube_link" id="youtube_link" class="form-control" required placeholder="https://www.youtube.com/watch?v=..." />
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
