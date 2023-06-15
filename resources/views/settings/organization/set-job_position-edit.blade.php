@extends('layouts.app')
@section('content')

    @if (Auth::user()->user_role_id > 2)
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
                                <h3 class="nk-block-title page-title mb-0">Edit Job Position</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{$data->name}}.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('setting-job-position') }}"
                                    class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                        class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="{{ route('setting-job-position') }}"
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
                                    <form action="{{route('job-position-update', encrypt($data->id)) }}" method="POST">
                                    @csrf
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="department">Job Position Name <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input readonly type="text" class="form-control" id="name" name="name" required value="{{ $data->name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="code">Code <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input readonly type="text" class="form-control" id="code" name="code" required value="{{ $data->code }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="company_id">Company <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <select  readonly disabled class="form-control" id="company_id" name="company_id" required>
                                                            <option value="{{ $data->company->id }}">{{ $data->company->name }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="department_id">Department <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <select  readonly disabled class="form-control" id="department_id" name="department_id" required>
                                                            <option value="{{ $data->department->id }}">{{ $data->department->name }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="address">Note / Description </label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control" id="note" name="note" rows="5">{{ $data->note }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit"><span>Update</span></button>
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