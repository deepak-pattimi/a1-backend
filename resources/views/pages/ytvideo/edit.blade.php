@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Ytvideo</h2>

        <form method="POST" action="{{ route('ytvideo.update', $item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
    <label for="thumbnail" class="col-sm-2 col-form-label">Thumbnail</label>
    <div class="col-sm-10">
        <x-image-input name="thumbnail" columns="col-md-12" value="{{ $item->thumbnail }}" id="thumbnail" label="Thumbnail" />
    </div>
</div>
<div class="form-group row">
    <label for="youtubelink" class="col-sm-2 col-form-label">Youtubelink</label>
    <div class="col-sm-10">
        <input type="text" name="youtubelink" id="youtubelink" class="form-control" value="{{ $item->youtubelink }}" />
    </div>
</div>


            <div class="form-group row">
<div class="col-sm-10 offset-sm-2">
<button type="submit" class="btn btn-success">Submit</button>

            </div></div>
</form>
</div>
@endsection