@extends('layouts.app')
@section('content')

    <!-- content -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Edit Collateral Classes</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{$data->name}}.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('setting-covis-class') }}"
                                    class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                        class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="{{ route('setting-covis-class') }}"
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
                                    <form action="{{route('classes-update', encrypt($data->id)) }}" method="POST">
                                    @csrf
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Name <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input value="{{old('name') ? old('name') : $data->name}}" type="text" class="form-control" id="name" name="name" readonly required autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="code">Code <code class="text-danger ml-1">*</code></label>
                                                    <div class="form-control-wrap">
                                                        <input  value="{{old('code') ? old('code') : $data->code}}" readonly type="text" class=" text-uppercase form-control @error('code') is-invalid @enderror" id="code" name="code" required>
                                                    </div>
                                                    @error('code')
                                                        <div class="alert alert-sm alert-danger">
                                                            Code Sudah Ada.
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="note">Note / Description </label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control" id="note" name="note" rows="5">{{old('note') ? old('note') : $data->note}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
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

@endsection