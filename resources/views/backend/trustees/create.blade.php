@extends('backend.layouts.app')
@section('content')
    <div class="mb-4 d-flex">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">
                        <i class="bi bi-globe2 small me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('admin/trustees') }}"> Trustee
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add New Trustee</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 justify-content-center">
            <div class="card">
                <div class="card-body">

                    <div class="col-md-12">

                        <form method="POST" action="{{ route('admin.trustees.store') }}" enctype="multipart/form-data" onsubmit="validateForm()">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Trustee Image <span class="text-danger">*</span></label><br>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                <p class="small text-muted mt-3">
                                    use an image at least 400px by 400px in either .jpg or .png format
                                </p>
                                @error('image')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                @enderror

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Designation<span class="text-danger">*</span></label>
                                        <input type="text" name="designation"
                                            class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation') }}">

                                        @error('designation')
                                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Trustee Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="editor">{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                @enderror
                            </div>

                            <div class="modal-footer">
                                <a href="{{route('admin.trustees.index')}}" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('backend/assets/libs/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.addCss('.cke_editable { background-color: #303030; color: white }');
    CKEDITOR.replace('editor');

    CKEDITOR.editorConfig = function( config ) {
        config.versionCheck = false;
    };
    CKEDITOR.instances['editor'].updateElement();
</script>
@endpush
