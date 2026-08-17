@extends('layouts.main') @section('title', 'General Settings') @section('content')

<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}" />
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}" />
@endpush

<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-users bg-blue"></i>
                    <div class="d-inline">
                        <h5>General Settings</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">General Settings</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div>
        <form method="post" action="{{url('admin/general/update')}}"  class="row" enctype="multipart/form-data">
            @csrf
            <!-- Header Section -->
            
            <x-image-input name="header_logo" columns="col-md-3" value="{{ $general->header_logo }}" label="Header Logo" />
            <x-image-input name="footer_logo" columns="col-md-3" value="{{ $general->footer_logo }}" label="Footer Logo" />
            <x-image-input name="favicon" columns="col-md-3" value="{{ $general->favicon }}" label="Favicon" />

            <div class="form-group col-md-3">
                <label for="header_phone">Header Phone</label>
                <input type="number" class="form-control" id="header_phone" name="header_phone" value="{{$general->header_phone}}"
                    placeholder="Header Phone" />
            </div>


            <!-- Social Media Section -->
            <div class="form-group col-md-3">
                <label for="fb_link">Facebook Link</label>
                <input type="url" class="form-control" id="fb_link" name="fb_link" placeholder="Facebook Link" value="{{$general->fb_link}}" />
            </div>
            <div class="form-group col-md-3">
                <label for="insta_link">Instagram Link</label>
                <input type="url" class="form-control" id="insta_link" name="insta_link" placeholder="Instagram Link" value="{{$general->insta_link}}" />
            </div>

            <div class="form-group col-md-3">
                <label for="youtube_link">YouTube Link</label>
                <input type="url" class="form-control" id="youtube_link" name="youtube_link" value="{{$general->youtube_link}}"
                    placeholder="YouTube Link" />
            </div>


            <!-- Contact Section -->
            <div class="form-group col-md-3">
                <label for="whatsapp_no">WhatsApp Number</label>
                <input type="number" class="form-control" id="whatsapp_no" name="whatsapp_no" value="{{$general->whatsapp_no}}"
                    placeholder="WhatsApp Number" />
            </div>

            <div class="col-12 mt-3">
                <hr>
                <h6 class="mb-3">Chatbot & Location Settings</h6>
            </div>

            <div class="form-group col-md-6">
                <label for="chatbot_welcome_message">Chatbot Welcome Message</label>
                <input type="text" class="form-control" id="chatbot_welcome_message" name="chatbot_welcome_message" value="{{$general->chatbot_welcome_message}}"
                    placeholder="e.g. Welcome to the Hospital. How can I help you today?" />
            </div>

            <div class="form-group col-md-6">
                <label for="google_maps_url">Google Maps URL</label>
                <input type="url" class="form-control" id="google_maps_url" name="google_maps_url" value="{{$general->google_maps_url}}"
                    placeholder="https://maps.google.com/..." />
            </div>

            <div class="form-group col-md-6">
                <label for="working_hours">Working Hours</label>
                <input type="text" class="form-control" id="working_hours" name="working_hours" value="{{$general->working_hours}}"
                    placeholder="e.g. 24/7 Emergency Care" />
            </div>

            <div class="form-group col-md-12">
                <label for="appointment_time_slots">Appointment Time Slots (Comma Separated)</label>
                <input type="text" class="form-control" id="appointment_time_slots" name="appointment_time_slots" value="{{$general->appointment_time_slots}}"
                    placeholder="e.g. 11:00 AM - 02:00 PM, 05:00 PM - 06:00 PM" />
            </div>

            <!-- Footer Section -->
            
            <div class="form-group col-md-3">
                <label for="footer_email">Footer Email</label>
                <input type="email" class="form-control" id="footer_email" name="footer_email" value="{{$general->footer_email}}"
                    placeholder="Footer Email" />
            </div>
            <div class="form-group col-md-3">
                <label for="footer_phone">Footer Phone</label>
                <input type="number" class="form-control" id="footer_phone" name="footer_phone" value="{{$general->footer_phone}}"
                    placeholder="Footer Phone" />
            </div>
            <div class="form-group col-md-3">
                <label for="footer_copyright">Footer Copyright</label>
                <input type="text" class="form-control" id="footer_copyright" name="footer_copyright" value="{{$general->footer_copyright}}"
                    placeholder="Footer Copyright" />
            </div>

            <!-- Website Section -->


            <div class="col-12 mt-3">
                <hr>
                <h6 class="mb-3">SEO Settings</h6>
            </div>
            
            <div class="form-group col-md-12">
                <label for="title">Home Page Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{$general->title}}"
                    placeholder="Enter Home Page Title" />
            </div>
            
            <div class="form-group col-md-12">
                <label for="meta_description">Home Page Meta Description</label>
                <textarea class="form-control" id="meta_description" name="meta_description" rows="3"
                    placeholder="Enter Meta Description">{{$general->meta_description}}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center col-12 mt-2">
                <button type="submit" class="btn btn-primary btn-lg">Update Settings</button>
            </div>
        </form>

    </div>
</div>


@push('script')
@endpush

@endsection