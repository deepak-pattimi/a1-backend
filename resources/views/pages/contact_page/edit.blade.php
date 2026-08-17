@extends('layouts.main') 
@section('title', 'Edit Contact Page')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-image bg-blue"></i>
                    <div class="d-inline">
                        <h5>Edit Contact Page</h5>
                        <span>Update the hero image for the Contact Us page</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('admin/contact-page') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="hero_image">Hero Image</label>
                                <input type="file" class="form-control" name="hero_image" accept="image/*">
                                @if($contactPage->hero_image)
                                    <div class="mt-2">
                                        <img src="{{ asset($contactPage->hero_image) }}" alt="Current Hero Image" style="max-width: 100%; height: auto; max-height: 200px; border-radius: 8px;">
                                    </div>
                                @endif
                                <small class="text-muted">Recommended size: 1920x600 pixels. A default image will be used if left blank.</small>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
