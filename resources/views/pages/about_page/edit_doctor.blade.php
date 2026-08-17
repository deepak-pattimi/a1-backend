@extends('layouts.main') 
@section('title', 'Edit About Doctor Page')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-file-text bg-blue"></i>
                    <div class="d-inline">
                        <h5>Edit About Doctor Page</h5>
                        <span>Update the content for the About Doctor page</span>
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
                    <form action="{{ url('admin/about-doctor') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <h5 class="text-primary mt-3">Meet The Doctor</h5>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="doctor_heading">Doctor Heading</label>
                                <input type="text" class="form-control" name="doctor_heading" value="{{ $aboutPage->doctor_heading }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="doctor_name">Doctor Name</label>
                                <input type="text" class="form-control" name="doctor_name" value="{{ $aboutPage->doctor_name }}">
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="doctor_designations">Doctor Designations (One per line)</label>
                                <textarea class="form-control" name="doctor_designations" rows="4">{{ $aboutPage->doctor_designations ? implode("\n", $aboutPage->doctor_designations) : '' }}</textarea>
                            </div>
                            
                            <div class="col-md-6 form-group">
                                <label for="doctor_image">Doctor Image</label>
                                <input type="file" class="form-control" name="doctor_image">
                            </div>
                            <div class="col-md-6 form-group">
                                @if($aboutPage->doctor_image)
                                    <label>Current Image</label><br>
                                    <img src="{{ url($aboutPage->doctor_image) }}" width="150" class="img-thumbnail" alt="Doctor Image">
                                @endif
                            </div>

                            <hr class="my-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="text-primary m-0">Dynamic Page Sections</h5>
                                <button type="button" class="btn btn-sm btn-success" id="add-section-btn">
                                    <i class="ik ik-plus"></i> Add New Section
                                </button>
                            </div>

                            <div id="dynamic-sections-container" class="w-100">
                                @php
                                    $sections = $aboutPage->custom_sections;
                                    if(!$sections || count($sections) == 0) {
                                        $sections = [
                                            ['heading' => 'Overview', 'content' => $aboutPage->doctor_overview ?? ''],
                                            ['heading' => 'Areas of Expertise', 'content' => $aboutPage->doctor_expertise ? implode("\n", $aboutPage->doctor_expertise) : ''],
                                            ['heading' => 'Awards and Recognitions', 'content' => $aboutPage->doctor_awards ? implode("\n", $aboutPage->doctor_awards) : ''],
                                            ['heading' => 'Memberships', 'content' => $aboutPage->doctor_memberships ? implode("\n", $aboutPage->doctor_memberships) : ''],
                                            ['heading' => 'Research Work and Publications', 'content' => $aboutPage->doctor_research ? implode("\n", $aboutPage->doctor_research) : '']
                                        ];
                                    }
                                @endphp

                                @foreach($sections as $index => $section)
                                <div class="card border mb-3 section-row p-3 bg-light">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="font-weight-bold text-secondary m-0">Section #<span class="section-number">{{ $index + 1 }}</span></h6>
                                        <button type="button" class="btn btn-sm btn-danger remove-section-btn">
                                            <i class="ik ik-trash-2"></i> Delete Section
                                        </button>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Section Heading</label>
                                        <input type="text" class="form-control" name="custom_sections[{{ $index }}][heading]" value="{{ $section['heading'] ?? '' }}" placeholder="Enter Section Heading (e.g. Overview, Awards, etc.)">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Section Content / Bullet Points (One per line for list, or paragraph text)</label>
                                        <textarea class="form-control" name="custom_sections[{{ $index }}][content]" rows="4" placeholder="Enter section content or items (one per line)">{{ $section['content'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('dynamic-sections-container');
    const addBtn = document.getElementById('add-section-btn');

    function updateSectionNumbers() {
        const rows = container.querySelectorAll('.section-row');
        rows.forEach((row, idx) => {
            row.querySelector('.section-number').textContent = idx + 1;
            const headingInput = row.querySelector('input[name*="[heading]"]');
            const contentInput = row.querySelector('textarea[name*="[content]"]');
            if (headingInput) headingInput.name = `custom_sections[${idx}][heading]`;
            if (contentInput) contentInput.name = `custom_sections[${idx}][content]`;
        });
    }

    addBtn.addEventListener('click', function() {
        const idx = container.querySelectorAll('.section-row').length;
        const newRow = document.createElement('div');
        newRow.className = 'card border mb-3 section-row p-3 bg-light';
        newRow.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="font-weight-bold text-secondary m-0">Section #<span class="section-number">${idx + 1}</span></h6>
                <button type="button" class="btn btn-sm btn-danger remove-section-btn">
                    <i class="ik ik-trash-2"></i> Delete Section
                </button>
            </div>
            <div class="form-group mb-2">
                <label>Section Heading</label>
                <input type="text" class="form-control" name="custom_sections[${idx}][heading]" placeholder="Enter Section Heading (e.g. Overview, Awards, etc.)">
            </div>
            <div class="form-group mb-0">
                <label>Section Content / Bullet Points (One per line for list, or paragraph text)</label>
                <textarea class="form-control" name="custom_sections[${idx}][content]" rows="4" placeholder="Enter section content or items (one per line)"></textarea>
            </div>
        `;
        container.appendChild(newRow);
        updateSectionNumbers();
    });

    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-section-btn')) {
            const row = e.target.closest('.section-row');
            if (container.querySelectorAll('.section-row').length > 1) {
                row.remove();
                updateSectionNumbers();
            } else {
                alert('You must have at least one section!');
            }
        }
    });
});
</script>
@endsection
