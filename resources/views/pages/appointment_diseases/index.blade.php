@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-list bg-blue"></i>
                    <div class="d-inline">
                        <h5>Appointment Diseases</h5>
                        <span>List of all appointment diseases</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Appointment Diseases</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-block">
                    <h3>Appointment Diseases</h3>
                    <a href="{{ route('appointment-diseases.create') }}" class="btn btn-primary btn-sm float-right">Add New</a>
                </div>
                <div class="card-body">
                    <div class="dt-responsive">
                        <table id="data_table" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($diseases as $disease)
                                <tr>
                                    <td>{{ $disease->id }}</td>
                                    <td>{{ $disease->name }}</td>
                                    <td>
                                        @if($disease->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{ route('appointment-diseases.edit', $disease->id) }}"><i class="ik ik-edit-2"></i></a>
                                            
                                            <form action="{{ route('appointment-diseases.destroy', $disease->id) }}" method="POST" class="d-inline-block delete-form" onsubmit="return confirm('Are you sure you want to delete this disease?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 border-0"><i class="ik ik-trash-2"></i></button>
                                            </form>
                                        </div>
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
</div>
@endsection
