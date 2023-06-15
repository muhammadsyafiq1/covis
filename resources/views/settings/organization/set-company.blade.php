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
                    <div class="components-preview">

                        <!-- block -->
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title mb-0">Company Setting</h4>
                                        <div class="nk-block-des">
                                            <p>You have total {{ $total }} data.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content">
                                        <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                            <div class="toggle-expand-content" data-content="pageMenu"></div>
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
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Address</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Website</span>
                                                </th>
                                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($view as $data)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div
                                                            class="user-avatar xs bg-dim-primary d-none d-sm-flex text-uppercase">
                                                            <span>{{ $data->code }}</span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead text-uppercase">{{ $data->name }} <span
                                                                    class="dot dot-success d-md-none ml-1"></span></span>
                                                            <span><a href="mailto:{{ $data->email }}">{{ $data->email }}</a></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md" data-order="35040.34">
                                                    <span class="currency">{{ $data->address }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <ul class="list-status">
                                                        <li>
                                                            <em class="icon text-primary ni ni-call"></em>
                                                            <a href="tel: {{ $data->phone }}"><span>Call</span></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <ul class="list-status">
                                                        <li><em class="icon text-primary ni ni-globe"></em> <a
                                                                href="{{ $data->website }}"
                                                                target="_blank"><span>Links</span></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{ route('company-edit', encrypt($data->id)) }}"
                                                                class="btn btn-trigger btn-icon" data-toggle="tooltip"
                                                                data-placement="top" title="Edit">
                                                                <em class="icon ni ni-edit"></em>
                                                            </a>
                                                        </li>
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

    @endif

@endsection
