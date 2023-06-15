@extends('layouts.app')
@section('content')

    @if (Auth::user()->user_role_id > 4)
        @include('errors.forbidden')
    @else

    <!-- content -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title mb-0">Edit Company</h3>
                                <div class="nk-block-des">
                                    <p class="text-uppercase">{{ $data->name }}</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('setting-company') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="{{ route('setting-company') }}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div>

                    <!-- block -->
                    <div class="components-preview">
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <code class="small text-danger">* Field Required</code>
                                    </div>

                                    <!-- form -->
                                    <form action="{{route('company-update', encrypt($data->id)) }}" method="POST">
                                    @csrf 
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Company Name <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input readonly value="{{old('name') ? old('name') : $data->name}}"  type="text" class="form-control" id="name" name="name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="alias">Alias <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input readonly value="{{old('alias') ? old('alias') : $data->alias}}"  type="text" class="form-control" id="alias" name="alias" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="address">Address <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input value="{{old('address') ? old('address') : $data->address}}"  type="text" class="form-control" id="address" name="address" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="phone">Phone <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input value="{{old('phone') ? old('phone') : $data->phone}}"  type="text" class="form-control" id="phone" name="phone" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input value="{{old('email') ? old('email') : $data->email}}"  type="email" class="form-control" id="email" name="email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="website">Website <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input value="{{old('website') ? old('website') : $data->website}}"  type="text" class="form-control" id="website" name="website" value="https://" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 float-right">
                                                <button class="btn btn-primary float-right" type="submit"><span>Update</span></button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /form -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->

                </div>
            </div>
        </div>
    </div>
    <!-- /content -->

    @endif
    
@endsection