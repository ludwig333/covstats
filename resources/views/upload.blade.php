@extends('layout.default_app')
@section('title', 'DashBoard')
@section('content')

<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between flex-wrap g-1">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">Welcome to Dashboard</h5>
        </div>
    </div>
</div>{{-- .nk-block-head --}}
<div class="nk-block">
    <div class="row g-5">
        <div class="col-xl-8">
            <div class="card card-bordered">
                <div class="card-inner card-inner-lg">
                    <h4>Upload Banner Images</h4>
                        @if(session('success'))
                            <div class="example-alert">
                                <div class="alert alert-primary alert-icon">
                                    <em class="icon ni ni-alert-circle"></em> <strong>{!! session('success') !!}</strong>.
                                </div>
                            </div>
                        @endif                     
                    <form action="{{route('upload-image')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Select Page Name</label>
                            <div class="form-control-wrap">
                                <select class="form-select" name="page">
                                    <option value="overview" data-select2-id="1">Overview</option>
                                    <option value="countries" data-select2-id="2">Countries</option>
                                    <option value="symptoms" data-select2-id="6">Symptoms</option>
                                    <option value="prevention" data-select2-id="4">Prevention</option>
                                    <option value="faqs" data-select2-id="5">Faqs</option>                         
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="default-06">Image Upload</label>
                            <div class="form-control-wrap">
                                <div class="custom-file">
                                    <input type="file" multiple="" class="custom-file-input" name="image[]" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </form>
                </div>
            </div>
        </div>{{-- .col --}}
    </div>{{-- .row --}}
</div>{{-- .nk-block --}}

@endsection