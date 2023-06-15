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
                                <h3 class="nk-block-title page-title mb-0">Edit Branch</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{$data->name}}.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('setting-branch') }}"
                                    class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                        class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="{{ route('setting-branch') }}"
                                    class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em
                                        class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div>
                    <div class="components-preview">
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <code class="small text-danger">* Field Required</code>
                                    </div>
                                    <form action="{{route('branch-update', encrypt($data->id)) }}" method="POST">
                                    @csrf
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="department">Branch Name <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input readonly value="{{old('name') ? old('name') : $data->name}}" type="text" class="form-control" id="name" name="name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="code">Code <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input readonly text-uppercase value="{{old('code') ? old('code') : $data->code}}" type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" required>
                                                    </div>
                                                    @error('code')
                                                        <div class="alert alert-sm alert-danger">
                                                            Code harus Unique
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="company_id">Company <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <select  disabled readonly class="form-control @error('company_id') is-invalid @enderror" id="company_id" name="company_id" required>
                                                            @foreach ($company as $d) 
                                                                <option value="{{$d->id}}" {{$d->id == $data->company_id ? 'selected' : ''}} >{{$d->name}}</option>
                                                            @endforeach 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="project_id">Project <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <select disabled readonly class="form-control" id="project_id" name="project_id" required>
                                                            @foreach ($project as $d) 
                                                                <option value="{{$d->id}}" {{$d->id == $data->project_id ? 'selected' : ''}} >{{$d->name}}</option>
                                                            @endforeach 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="region_id">Region <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <select readonly disabled class="form-control" id="region_id" name="region_id" required >
                                                            @foreach ($region as $d) 
                                                                <option value="{{$d->id}}" {{$d->id == $data->region_id ? 'selected' : ''}} >{{$d->name}}</option>
                                                            @endforeach 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="alias">Alias <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input readonly value="{{old('alias') ? old('alias') : $data->alias}}" type="text" class="form-control" id="alias" name="alias" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="address">Address</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control" id="address" name="address" rows="5" required>{{old('address') ? old('adsress') : $data->address}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="phone">Phone <code class="text-danger ml-1">*</code> </label>
                                                    <div class="form-control-wrap">
                                                        <input value="{{old('phone') ? old('phone') : $data->phone}}" type="text" class="form-control" id="phone" name="phone" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input value="{{old('email') ? old('email') : $data->email}}" type="email" class="form-control" id="email" name="email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="ao_name">Account Officer Name</label>
                                                    <div class="form-control-wrap">
                                                        <input value="{{old('ao_name') ? old('ao_name') : $data->ao_name}}" type="text" class="form-control" id="ao_name" name="ao_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="ao_no">Account Officer Contact (Mobile No)</label>
                                                    <div class="form-control-wrap">
                                                        <input value="{{old('ao_no') ? old('ao_no') : $data->ao_no}}" type="text" class="form-control" id="ao_no" name="ao_no">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="address">Note / Description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control" id="note" name="note" rows="5">{{$data->note}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 float-right">
                                                <button class="btn btn-primary float-right" type="submit"><span>Update</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content -->

    @endif
    
@endsection