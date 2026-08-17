@extends('layouts.main') 
@section('title', 'Edit Home H2 Section')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-home bg-blue"></i>
                    <div class="d-inline">
                        <h5>Edit Home H2 Section</h5>
                        <span>Update the content, image, and stats for the Home Page H2 Section</span>
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
                    <form action="{{ url('admin/home-h2-section') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="badge_title">Badge Title</label>
                                <input type="text" class="form-control" name="badge_title" value="{{ $h2Section->badge_title }}" placeholder="e.g. WHO WE ARE">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="heading">Heading</label>
                                <input type="text" class="form-control" name="heading" value="{{ $h2Section->heading }}" placeholder="e.g. Pioneering Advanced Surgical Care in Vizag">
                            </div>
                            
                            <div class="col-md-12 form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" rows="4">{{ $h2Section->description }}</textarea>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="features">Features (One per line)</label>
                                <textarea class="form-control" name="features" rows="4" placeholder="Advanced ICU Facility&#10;24/7 Emergency Care">{{ $h2Section->features ? implode("\n", $h2Section->features) : '' }}</textarea>
                            </div>
                        </div>

                        <hr>
                        <h5>Stats Section</h5>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Stat 1 Value</label>
                                <input type="text" class="form-control" name="stat_1_value" value="{{ $h2Section->stat_1_value }}" placeholder="e.g. 8+">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Stat 1 Text</label>
                                <input type="text" class="form-control" name="stat_1_text" value="{{ $h2Section->stat_1_text }}" placeholder="e.g. Years Experience">
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Stat 2 Value</label>
                                <input type="text" class="form-control" name="stat_2_value" value="{{ $h2Section->stat_2_value }}" placeholder="e.g. 5000+">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Stat 2 Text</label>
                                <input type="text" class="form-control" name="stat_2_text" value="{{ $h2Section->stat_2_text }}" placeholder="e.g. Surgeries">
                            </div>
                            
                            <div class="col-md-3 form-group">
                                <label>Stat 3 Value</label>
                                <input type="text" class="form-control" name="stat_3_value" value="{{ $h2Section->stat_3_value }}" placeholder="e.g. 10k+">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Stat 3 Text</label>
                                <input type="text" class="form-control" name="stat_3_text" value="{{ $h2Section->stat_3_text }}" placeholder="e.g. Happy Patients">
                            </div>
                            
                            <div class="col-md-3 form-group">
                                <label>Stat 4 Value</label>
                                <input type="text" class="form-control" name="stat_4_value" value="{{ $h2Section->stat_4_value }}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Stat 4 Text</label>
                                <input type="text" class="form-control" name="stat_4_text" value="{{ $h2Section->stat_4_text }}">
                            </div>
                        </div>

                        <hr>
                        <h5>Image Section</h5>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="image">Upload New Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="col-md-6 form-group">
                                @if($h2Section->image)
                                    <label>Current Image</label><br>
                                    <img src="{{ url($h2Section->image) }}" width="200" alt="H2 Image">
                                @endif
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
