@extends('layouts.app')
@section('content')

    <!-- content -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">

                        <!-- block -->
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title mb-0">Users Setting</h4>
                                        <div class="nk-block-des">
                                            <p>You have total {{ $total }} data.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content">
                                        <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                            <div class="toggle-expand-content" data-content="pageMenu">
                                                <ul class="nk-block-tools g-3">
                                                    <li class="nk-block-tools-opt">
                                                        <a href="#" class="toggle btn btn-primary" data-target="add-modal"><em class="icon ni ni-plus"></em><span>Add User</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- alert -->
                            @if (count($errors) > 0)
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
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
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
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Company</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span
                                                        class="sub-text">Department</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Role</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span>
                                                </th>
                                                <th class="nk-tb-col nk-tb-col-tools text-right"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <!-- admin role -->
                                        @if (Auth::user()->user_role_id >= 5)

                                            @foreach ($view_adm as $data)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        @if ($data->userImage)
                                                        <div class="user-avatar">
                                                            <img src="images/avatar/{{ $data->userImage->name }}" alt="">
                                                        </div>
                                                        @else
                                                        <div class="user-avatar">
                                                            <img src="images/avatar/unknown" alt="">
                                                        </div>
                                                        @endif
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ $data->name }}
                                                                @if ($data->is_active == 1)
                                                                <span class="dot dot-success d-md-none ml-1"></span>
                                                                @else
                                                                <span class="dot dot-danger d-md-none ml-1"></span>
                                                                @endif
                                                            </span>
                                                            <span><a href="mailto:{{ $data->email }}">{{ $data->email }}</a></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span class="text-uppercase">{{ $data->company->name }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{ $data->department->name }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md" data-order="35040.34">
                                                    <span class="currency">{{ $data->user_role->name }}</span>
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
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('change-password-set-user', encrypt($data->id))}}" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top" title="Change Password">
                                                                <em  class="icon ni ni-unlock"></em>
                                                            </a>
                                                        </li>

                                                        @if ($data->is_active == 0)
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('user-active', encrypt($data->id))}}" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top" title="Active">
                                                                <em class="icon ni ni-check-circle-fill"></em>
                                                            </a>
                                                        </li>
                                                        @else
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('user-inactive', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top" title="Inactive">
                                                                <em class="icon ni ni-cross-circle-fill"></em>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#"
                                                                    class="dropdown-toggle btn btn-icon btn-trigger"
                                                                    data-toggle="dropdown"><em
                                                                        class="icon ni ni-more-h"></em></a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach

                                        <!-- spv role -->
                                        @elseif (Auth::user()->user_role_id >= 4)

                                            @foreach ($view_spv as $data)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        @if ($data->userImage)
                                                        <div class="user-avatar">
                                                            <img src="images/avatar/{{ $data->userImage->name }}" alt="">
                                                        </div>
                                                        @else
                                                        <div class="user-avatar">
                                                            <img src="images/avatar/unknown" alt="">
                                                        </div>
                                                        @endif
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ $data->name }}
                                                                @if ($data->is_active == 1)
                                                                <span class="dot dot-success d-md-none ml-1"></span>
                                                                @else
                                                                <span class="dot dot-danger d-md-none ml-1"></span>
                                                                @endif
                                                            </span>
                                                            <span><a href="mailto:{{ $data->email }}">{{ $data->email }}</a></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span class="text-uppercase">{{ $data->company->name }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{ $data->department->name }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md" data-order="35040.34">
                                                    <span class="currency">{{ $data->user_role->name }}</span>
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
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('change-password-set-user', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top" title="Change Password">
                                                                <em  class="icon ni ni-unlock"></em>
                                                            </a>
                                                        </li>

                                                        @if ($data->is_active == 0)
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('user-active', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top" title="Active">
                                                                <em class="icon ni ni-check-circle-fill"></em>
                                                            </a>
                                                        </li>
                                                        @else
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('user-inactive', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top" title="Inactive">
                                                                <em class="icon ni ni-cross-circle-fill"></em>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#"
                                                                    class="dropdown-toggle btn btn-icon btn-trigger"
                                                                    data-toggle="dropdown"><em
                                                                        class="icon ni ni-more-h"></em></a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach

                                        <!-- head role -->
                                        @elseif (Auth::user()->user_role_id >= 3)

                                            @foreach ($view_head as $data)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        @if ($data->userImage)
                                                        <div class="user-avatar">
                                                            <img src="images/avatar/{{ $data->userImage->name }}" alt="">
                                                        </div>
                                                        @else
                                                        <div class="user-avatar">
                                                            <img src="images/avatar/unknown" alt="">
                                                        </div>
                                                        @endif
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ $data->name }}
                                                                @if ($data->is_active == 1)
                                                                <span class="dot dot-success d-md-none ml-1"></span>
                                                                @else
                                                                <span class="dot dot-danger d-md-none ml-1"></span>
                                                                @endif
                                                            </span>
                                                            <span><a href="mailto:{{ $data->email }}">{{ $data->email }}</a></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span class="text-uppercase">{{ $data->company->name }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{ $data->department->name }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md" data-order="35040.34">
                                                    <span class="currency">{{ $data->user_role->name }}</span>
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
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('change-password-set-user', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top" title="Change Password">
                                                                <em  class="icon ni ni-unlock"></em>
                                                            </a>
                                                        </li>

                                                        @if ($data->is_active == 0)
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('user-active', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top" title="Active">
                                                                <em class="icon ni ni-check-circle-fill"></em>
                                                            </a>
                                                        </li>
                                                        @else
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('user-inactive', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top" title="Inactive">
                                                                <em class="icon ni ni-cross-circle-fill"></em>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#"
                                                                    class="dropdown-toggle btn btn-icon btn-trigger"
                                                                    data-toggle="dropdown"><em
                                                                        class="icon ni ni-more-h"></em></a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach

                                        <!-- system admin role -->
                                        @else

                                            @foreach ($view as $data)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        @if ($data->userImage)
                                                        <div class="user-avatar">
                                                            <img src="images/avatar/{{ $data->userImage->name }}" alt="">
                                                        </div>
                                                        @else
                                                        <div class="user-avatar">
                                                            <img src="images/avatar/unknown" alt="">
                                                        </div>
                                                        @endif
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ $data->name }}
                                                                @if ($data->is_active == 1)
                                                                <span class="dot dot-success d-md-none ml-1"></span>
                                                                @else
                                                                <span class="dot dot-danger d-md-none ml-1"></span>
                                                                @endif
                                                            </span>
                                                            <span><a href="mailto:{{ $data->email }}">{{ $data->email }}</a></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span class="text-uppercase">{{ $data->company->name }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{ $data->department->name }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md" data-order="35040.34">
                                                    <span class="currency">{{ $data->user_role->name }}</span>
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
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('change-password-set-user', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top" title="Change Password">
                                                                <em  class="icon ni ni-unlock"></em>
                                                            </a>
                                                        </li>

                                                        @if ($data->is_active == 0)
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('user-active', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top" title="Active">
                                                                <em class="icon ni ni-check-circle-fill"></em>
                                                            </a>
                                                        </li>
                                                        @else
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{route('user-inactive', encrypt($data->id)) }}" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top" title="Inactive">
                                                                <em class="icon ni ni-cross-circle-fill"></em>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#"
                                                                    class="dropdown-toggle btn btn-icon btn-trigger"
                                                                    data-toggle="dropdown"><em
                                                                        class="icon ni ni-more-h"></em></a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach

                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /datatable -->

                        </div>
                        <!-- /block -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content -->

    <!-- modal add new user -->
    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="add-modal" data-toggle-screen="any"
        data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">New User</h5>
                <div class="nk-block-des">
                    <p class="small text-danger">* Required</p>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <form action="{{ route('user-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="name">Full Name <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="name">Username <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="nip">Employee ID <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="nip" name="nip" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="company">Company <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-control" id="company_id" name="company_id" required>
                                    <option value="" disabled selected hidden>--- Select ---</option>
                                    @foreach ($select1 as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="department">Department <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-control" id="department_id" name="department_id" required>
                                    <option value="" disabled selected hidden>--- Select ---</option>
                                    @foreach ($select2 as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="job_position">Job Position <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-control" id="job_position_id" name="job_position_id" required>
                                    <option value="" disabled selected hidden>--- Select ---</option>
                                    @if (Auth::user()->user_role_id >= 5)
                                        @foreach ($select3_adm as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach

                                    @elseif (Auth::user()->user_role_id == 4)
                                        @foreach ($select3_spv as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach

                                    @else
                                        @foreach ($select3 as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="file">Signature Digital <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" id="ttd_users" name="ttd_users" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="email">Email <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="mobile_no">Mobile No. <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="user_role_id">User Role <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-control" id="user_role_id" name="user_role_id" required>
                                    <option value="" disabled selected hidden>--- Select ---</option>
                                    @if (Auth::user()->user_role_id >= 5)
                                        @foreach ($select4_adm as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach

                                    @elseif (Auth::user()->user_role_id == 4)
                                        @foreach ($select4_spv as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach

                                    @else
                                        @foreach ($select4 as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="password">Password <span class="text-danger ml-1">*</span></label>
                            <div class="form-control-wrap">
                                <input type="password" class="form-control" id="password" name="password" required>
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
    <!-- /modal add new user -->

@endsection

@push('addon-script')
    <script>
        $('#assign-role').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget);
            var modal = $(this);

            modal.find('#id').attr('value', div.data('id'));
            modal.find('#name').html(div.data('name'));
        })
    </script>
@endpush
