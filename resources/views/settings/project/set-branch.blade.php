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
                                        <h4 class="nk-block-title mb-0">Branch Setting</h4>
                                        <div class="nk-block-des">
                                            <p>You have total {{ $total }} data.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content">
                                        <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                            <div class="toggle-expand-content" data-content="pageMenu">
                                                @if (Auth::user()->user_role_id > 4)
                                                @else
                                                <ul class="nk-block-tools g-3">
                                                    <li class="nk-block-tools-opt"><a href="#" class="toggle btn btn-primary" data-target="add-modal"><em class="icon ni ni-plus"></em><span>Add Branch</span></a></li>
                                                </ul>
                                                @endif
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
                                    <table class="datatable-init nk-tb-list nk-tb-ulist nowrap" data-auto-responsive="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Company</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Region</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Address</span></th>
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
                                                            <span>{{ $data->project->name ?? 'Project not Found'}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span class="text-uppercase">{{ $data->company->name }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span class="">Kanwil {{ $data->region->name ?? 'Region not Found'}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span class="">{{ $data->address }}</span>
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
                                                            <a href="{{route('branch-edit', encrypt($data->id)) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <em class="icon ni ni-edit"></em>
                                                            </a>
                                                        </li>
                                                        @if ($data->is_active == 0)
                                                            <li class="nk-tb-action-hidden">
                                                                <a href="{{route('branch-active', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                    data-toggle="tooltip" data-placement="top" title="Active">
                                                                    <em class="icon ni ni-check-circle-fill"></em>
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li class="nk-tb-action-hidden">
                                                                <a href="{{route('branch-inactive', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
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

    <!-- modal add branch -->
    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="add-modal" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">New Branch</h5>
                <div class="nk-block-des">
                    <p class="small text-danger">* Required</p>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <form action="{{route('setting-branch-store')}}" method="POST">
            @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="department">Branch Name <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" name="name" required>
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
                                    Code harus Unique
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="company_id">Company <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-control" id="company_id" name="company_id" required>
                                    <option disabled selected hidden>--- Select ---</option>
                                    @foreach ($company as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="department_id">Project <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-control" id="project_id" name="project_id" required>
                                    <option disabled selected hidden>--- Select ---</option>
                                    @foreach ($project as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="department_id">Region <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-control" id="region_id" name="region_id" required>
                                    <option disabled selected hidden>--- Select ---</option>
                                    @foreach ($region as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="alias">Alias <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="alias" name="alias" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="address">Address <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="address" name="address" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="phone" name="phone" >
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" id="email" name="email" >
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="ao_name">Account Officer Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="ao_name" name="ao_name" >
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="ao_no">Account Officer Contact (Mobile No) </label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="ao_no" name="ao_no" >
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="address">Note / Description <span class="text-danger ml-1">*</span></label>
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
    <!-- /modal add branch -->

@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#account_officer_mobile_no').on('keyup', function() {
                var number = $(this).val()
                // console.log(number);
                let start_with = number.startsWith(0, 0);
                // console.log(start_with);

                if (start_with == true) {
                    // console.log('benar');
                    $('#account_officer_mobile_no').val("")

                }

            });
        })
    </script>
@endpush
