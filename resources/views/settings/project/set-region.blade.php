@extends('layouts.app')
@section('content')

    <!-- content -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title mb-0">Region Setting</h4>
                                        <div class="nk-block-des">
                                            <p>You have total {{ $total }} data.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content">
                                        <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                            <div class="toggle-expand-content" data-content="pageMenu">
                                                <ul class="nk-block-tools g-3">
                                                @if (Auth::user()->user_role_id > 4)
                                                @else
                                                    <li class="nk-block-tools-opt"><a href="#" class="toggle btn btn-primary" data-target="add-modal"><em class="icon ni ni-plus"></em><span>Add Region</span></a></li>
                                                @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- alert -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <div class="alert-body">
                                        {{ $message }}
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            @elseif ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <div class="alert-body">
                                        {{ $message }}
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            @endif
                            <!-- /alert -->

                            <!-- datatable -->
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Total Branch</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Note / Description</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($view as $data)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-avatar xs bg-dim-primary d-none d-sm-flex">
                                                            <span>{{ $data->code }}</span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ $data->name }} @if($data->is_active == 1) <span class="dot dot-success d-md-none ml-1"></span> @else <span class="dot dot-danger d-md-none ml-1"></span> @endif</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span class="">{{ $data->region->count() }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span class="">{{ !$data->note ? 'N/A' : $data->note }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                @if ($data->is_active == 1)
                                                    <span class="badge badge-sm badge-success bg-outline-success d-md-inline-flex">Active</span>
                                                @else
                                                    <span class="badge badge-sm badge-danger bg-outline-danger d-md-inline-flex">Inactive</span>
                                                @endif
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                    @if (Auth::user()->user_role_id > 4)
                                                    @else
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('region-edit', encrypt($data->id)) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <em class="icon ni ni-edit"></em>
                                                            </a>
                                                        </li>
                                                        @if ($data->is_active == 0)
                                                            <li class="nk-tb-action-hidden">
                                                                <a href="{{route('region-active', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                    data-toggle="tooltip" data-placement="top" title="Active">
                                                                    <em class="icon ni ni-check-circle-fill"></em>
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li class="nk-tb-action-hidden">
                                                                <a href="{{route('region-inactive', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                    data-toggle="tooltip" data-placement="top" title="Inactive">
                                                                    <em class="icon ni ni-cross-circle-fill"></em>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endif
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="btn btn-icon btn-trigger"><em class="icon ni ni-more-h"></em></a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /datatable -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content -->

    <!-- modal add region -->
    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="add-modal" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">New Region</h5>
                <div class="nk-block-des">
                    <p class="small text-danger">* Required</p>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <form action="{{route('setting-region-store')}}" method="POST">
            @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="name">Region Name <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="project_id">Company <span
                                    class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-control" id="project_id" name="project_id" required>
                                    <option disabled selected>--- Select ---</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="code">Code <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="kode-upper form-control @error('code') is-invalid @enderror" id="code" name="code" required>
                            </div>
                            @error('code')
                                <div class="alert alert-sm alert-danger">
                                    Code sudah terdaftar
                                </div>   
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="address">Note / Description </label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="note" name="note" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /modal add region -->

@endsection

@push('addon-script')
    <script src="{{ asset('js/vendors/anime/lib/anime.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            anime({
                targets: '.alert-image',
                translateX: 100,
                direction: 'alternate',
                loop: 2,
                easing: 'linear'
            })

            $('#nonactive-zone').on('show.bs.modal', function(event) {
                var div = $(event.relatedTarget);
                var modal = $(this);

                modal.find('#ids').attr("value", div.data('id'));
            })
            $('#active-zone').on('show.bs.modal', function(event) {
                var div = $(event.relatedTarget);
                var modal = $(this);

                modal.find('#idp').attr("value", div.data('id'));
            })
            $('#updateZone').on('show.bs.modal', function(event) {
                var div = $(event.relatedTarget);
                var modal = $(this);

                modal.find('#idd').attr("value", div.data('id'));
                modal.find('#codeUpdate').attr("value", div.data('code'));
                modal.find('#nameUpdate').attr("value", div.data('name'));
                modal.find('#noteUpdate').attr("value", div.data('note'));
            })
        })
    </script>
@endpush
