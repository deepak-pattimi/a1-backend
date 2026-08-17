@extends('layouts.main') 
@section('title', 'Edit About Clinic Page')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-file-text bg-blue"></i>
                    <div class="d-inline">
                        <h5>Edit About Clinic Page</h5>
                        <span>Update the content for the About Clinic page</span>
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
                    <form action="{{ url('admin/about-clinic') }}" method="POST">
                        @csrf
                        
                        <h5 class="text-primary mt-3">Hero Section</h5>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="tagline">Tagline</label>
                                <input type="text" class="form-control" name="tagline" value="{{ $aboutPage->tagline }}" placeholder="e.g. Committed to Surgical Excellence">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="sub_tagline">Sub-Tagline</label>
                                <input type="text" class="form-control" name="sub_tagline" value="{{ $aboutPage->sub_tagline }}" placeholder="e.g. Advanced and Affordable Laparoscopic...">
                            </div>
                        </div>

                        <hr>
                        <h5 class="text-primary mt-3">About Our Clinic</h5>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="clinic_heading">Clinic Heading</label>
                                <input type="text" class="form-control" name="clinic_heading" value="{{ $aboutPage->clinic_heading }}">
                            </div>
                            
                            <div class="col-md-12 form-group">
                                <label for="clinic_description">Clinic Description</label>
                                <textarea class="form-control" name="clinic_description" rows="5">{{ $aboutPage->clinic_description }}</textarea>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="clinic_services">Clinic Services (One per line)</label>
                                <textarea class="form-control" name="clinic_services" rows="5" placeholder="Diagnosis and treatment...&#10;Complete care...&#10;">{{ $aboutPage->clinic_services ? implode("\n", $aboutPage->clinic_services) : '' }}</textarea>
                                <small class="text-muted">Each line will become a bullet point.</small>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
