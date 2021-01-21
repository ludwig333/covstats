@extends('layout.default_app')
@section('title', 'DashBoard')
@section('content')

<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between flex-wrap g-1">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">Welcome to Dashboard</h5>
        </div>
    </div>
                        @if(session('success'))
                            <div class="example-alert">
                                <div class="alert alert-primary alert-icon">
                                    <em class="icon ni ni-alert-circle"></em> <strong>{!! session('success') !!}</strong>.
                                </div>
                            </div>
                        @endif 
</div>{{-- .nk-block-head --}}
<div class="nk-block">
    <div class="row g-5">
        <div class="col-xl-8">
            <div class="card card-bordered">
                <div class="card-inner card-inner-lg">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabItem1">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabItem2">Countries</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabItem3">Symptoms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabItem4">Prevention</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabItem5">Faqs</a>
                        </li>                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabItem1">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Image</th>
                                  <th scope="col">Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(!empty($overview_images))
                                @foreach($overview_images as $image)
                                <tr>
                                  <th scope="row">1</th>
                                  <td><img src="{{ asset($image->path) }}" style="width: 50px;"></td>
                                  <td>
                                    <a href="{{route('deleteimage',$image->id)}}" class="btn btn-danger">Delete</a>
                                    <a href="#" data-toggle="modal" data-target="#modalUpdate{{$image->id}}" class="btn btn-primary">Update</a>
                                  </td>
                                </tr>
                                @endforeach
                                @endif
                              </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tabItem2">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Image</th>
                                  <th scope="col">Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(!empty($countries_images))
                                @foreach($countries_images as $image)
                                <tr>
                                  <th scope="row">1</th>
                                  <td><img src="{{ asset($image->path) }}" style="width: 50px;"></td>
                                  <td>
                                    <a href="{{route('deleteimage',$image->id)}}" class="btn btn-danger">Delete</a>
                                    <a href="#" data-toggle="modal" data-target="#modalUpdate{{$image->id}}" class="btn btn-primary">Update</a>
                                  </td>
                                </tr>
                                @endforeach
                                @endif
                              </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tabItem3">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Image</th>
                                  <th scope="col">Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(!empty($symptoms_images))
                                @foreach($symptoms_images as $image)
                                <tr>
                                  <th scope="row">1</th>
                                  <td><img src="{{ asset($image->path) }}" style="width: 50px;"></td>
                                  <td>
                                    <a href="{{route('deleteimage',$image->id)}}" class="btn btn-danger">Delete</a>
                                    <a href="#" data-toggle="modal" data-target="#modalUpdate{{$image->id}}" class="btn btn-primary">Update</a>
                                  </td>
                                </tr>
                                @endforeach
                                @endif
                              </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tabItem4">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Image</th>
                                  <th scope="col">Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(!empty($prevention_images))
                                @foreach($prevention_images as $image)
                                <tr>
                                  <th scope="row">1</th>
                                  <td><img src="{{ asset($image->path) }}" style="width: 50px;"></td>
                                  <td>
                                    <a href="{{route('deleteimage',$image->id)}}" class="btn btn-danger">Delete</a>
                                    <a href="#" data-toggle="modal" data-target="#modalUpdate{{$image->id}}" class="btn btn-primary">Update</a>
                                  </td>
                                </tr>
                                @endforeach
                                @endif
                              </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tabItem5">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Image</th>
                                  <th scope="col">Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(!empty($faqs_images))
                                @foreach($faqs_images as $image)
                                <tr>
                                  <th scope="row">1</th>
                                  <td><img src="{{ asset($image->path) }}" style="width: 50px;"></td>
                                  <td>
                                    <a href="{{route('deleteimage',$image->id)}}" class="btn btn-danger">Delete</a>
                                    <a href="#" data-toggle="modal" data-target="#modalUpdate{{$image->id}}" class="btn btn-primary">Update</a>
                                  </td>
                                </tr>
                                @endforeach
                                @endif
                              </tbody>
                            </table>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>{{-- .col --}}
    </div>{{-- .row --}}
</div>{{-- .nk-block --}}

@foreach($images as $image)
<div class="modal fade" tabindex="-1" id="modalUpdate{{$image->id}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Update Image</h5>
            </div>
            <form action="{{route('updateimage')}}" method="post" enctype="multipart/form-data" class="gy-3">
                @csrf
                <input name="id" value="{{$image->id}}" hidden="">
                <div class="modal-body" style="margin-top: 30px;">

                    <div class="row g-3 align-center">
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <label class="form-label">Upload File</label>
                                                                <span class="form-note"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                                <div class="form-control-wrap">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" name="file" id="customFile">
                                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                                                        <div class="">
                                                            <div class="form-group mt-2">
                                                                <button type="submit" class="btn btn-lg btn-primary">Upload</button>
                                                            </div>
                                                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>   
@endforeach
@endsection