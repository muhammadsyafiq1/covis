@extends('layouts.app')
@section('content')

    @if (Auth::user()->user_role_id == 8)
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
                                <h3 class="nk-block-title page-title mb-0">Customer Data</h3>
                                <div class="nk-block-des text-soft d-none d-md-inline-flex">
                                    <ul class="breadcrumb breadcrumb-pipe">
                                        <li class="breadcrumb-item active"><a href="#">You have total ({{ $customer }})</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <form action="{{ route('customer.search') }}" class="d-flex">
                                                    <input required autocomplete="off" value="{{Request::get('keyword')}}" class="form-control me-2 mr-3" style="width: 300px;" type="search" placeholder="Type customer name, code or address here..." aria-label="Search" name="keyword">
                                                    <button class="btn btn-icon btn-primary" type="submit" value="Search"><em class="icon ni ni-search"></em></button>
                                                </form>
                                            </li>
                                            <li class="nk-block-tools-opt">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle btn btn-icon btn-light" data-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt">
                                                            <li><a href="{{ url('customer-new') }}"><em class="icon ni ni-user"></em><span>New Customer</span></a></li>
                                                            <li><a href="{{ url('customer-new-import') }}"><em class="icon ni ni-inbox-in"></em><span>Import Customer</span></a></li>
                                                            <li><a href="{{ url('order-new-import') }}"><em class="icon ni ni-package"></em><span>Import Order</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- alert -->
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
                    <div class="components-preview">
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <form method="POST" action="{{ url('test') }}">
                                        @csrf
                                        <table class="datatable-init-export nk-tb-list nk-tb-ulist nowrap" data-auto-responsive="false"
                                        data-export-title="Export">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">Customer Name</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Type / Client</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Address</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">PIC</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Account
                                                        Officer</span></th>
                                                <th class="nk-tb-col nk-tb-col-tools text-right"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customerdata as $cust)
                                                <tr class="nk-tb-item">
                                                    <td class="nk-tb-col">
                                                        <div class="user-card">
                                                        @if ($cust->mode == 1)
                                                            <div class="user-avatar xs bg-dim-primary d-none d-sm-flex">
                                                                <span><em class="icon ni ni-camera"></em></span>
                                                        @else
                                                            <div class="user-avatar xs bg-warning d-none d-sm-flex">
                                                                <span><em class="icon ni ni-img"></em></span>
                                                        @endif   
                                                            </div>
                                                            <div class="user-info" style="width: 220px; white-space:normal;">
                                                                <span class="tb-lead">{{ $cust->name ?? ''}} <span
                                                                        class="dot dot-success d-md-none ml-1"></span></span>
                                                                <span>#{{ $cust->code ?? ''}}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        <div class="user-card">
                                                            <div class="user-info">
                                                                <span
                                                                    class="tb-lead">{{ $cust->covisType->name ?? '' }}<span
                                                                        class="dot dot-success d-md-none ml-1"></span></span>
                                                                <span>{{ $cust->project->code  ?? ''}}
                                                                    {{ $cust->branch->name  ?? ''}} ({{ $cust->region->name ?? '' }})</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-mb" style="width: 220px; white-space:normal;">
                                                        <div class="user-card">
                                                            <div class="user-info">
                                                                <span class="tb-lead small">{{ $cust->address ?? ''}}</span>
                                                                <span>{{ !$cust->district_code ? '---' : ucwords(strtolower($cust->districtCustomer->name ?? '')) }},
                                                                    {{ !$cust->city_code ? '---' : ucwords(strtolower($cust->cityCustomer->name ?? '')) }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        <div class="user-card">
                                                            <div class="user-info">
                                                                <span class="tb-lead small">{{ $cust->contact_name ?? ''}}<span
                                                                        class="dot dot-success d-md-none ml-1"></span></span>
                                                                <span><a href="tel:{{  $cust->contact_no  ?? ''}}">{{  $cust->contact_no  ?? ''}}</a></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        <div class="user-card">
                                                            <div class="user-info">
                                                                <span class="tb-lead small">{{ $cust->ao_name }} <span
                                                                        class="dot dot-success d-md-none ml-1"></span></span>
                                                                <span><a href="tel:{{  $cust->ao_no ?? '' }}">{{  $cust->ao_no  ?? ''}}</a></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <li class="nk-tb-action-hidden">
                                                                <a href="{{ url('customer-view', $cust->id) }}"
                                                                    class="btn btn-trigger btn-icon" data-toggle="tooltip"
                                                                    data-placement="top" title="View" target="_blank">
                                                                    <em class="icon ni ni-external"></em>
                                                                </a>
                                                            </li>
                                                            <li class="nk-tb-action-hidden">
                                                                <a href="#" class="toggle btn btn-icon"
                                                                    data-target="#mode-modal" data-toggle="modal"
                                                                    data-id="{{ $cust->id ?? ''}}"
                                                                    data-branch="{{ $cust->branch->id  ?? ''}}">
                                                                    <em class="icon ni ni-camera" data-toggle="tooltip"
                                                                        data-placement="top" title="Mode"></em>
                                                                </a>
                                                            </li>
                                                            <li class="nk-tb-action-hidden">
                                                                <a href="#" class="toggle btn btn-icon"
                                                                    data-target="#order-modal" data-toggle="modal"
                                                                    data-id="{{ $cust->id ?? ''}}"
                                                                    data-branch="{{ $cust->branch->id ?? '' }}">
                                                                    <em class="icon ni ni-repeat" data-toggle="tooltip"
                                                                        data-placement="top" title="Order"></em>
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

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /datatable -->

                </div>
            </div>
        </div>
    </div>
    <!-- /content -->
    @endif
    {{-- modal mode --}}
    <div class="modal right fade" id="mode-modal" tabindex="-1" aria-labelledby="order-modalLabel" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="modal-title">Mode</h5>
                            <code>* Required</code>
                            <p class="modal-title mt-2 mb-2">Choose photo mode for this customers.</p>
                            <span id="name"></span>
                        </div>
                        <!--<br>-->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{route('update-mode')}}" method="POST">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="form-control-wrap">
                                                    <select class="form-control" id="mode" name="mode" required>
                                                        <option value="" disabled selected>--- Select ---</option>
                                                        <option value="0">Upload From File / Gallery</option>
                                                        <option value="1">Realtime Camera</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="covis_customer_id" id="covis_customer_id">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-block"
                                                    type="submit"><span>Submit</span></button>
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
    {{-- end modal mode --}}

    <!-- modal order -->
    <div class="modal right fade" id="order-modal" tabindex="-1" aria-labelledby="order-modalLabel" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="modal-title">Order / Request</h5>
                            <code class="small text-danger">* Required</code>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <form action="{{ url('post-customer-request') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <input type="text" class="form-control mb-2" name="covis_customer_id" id="covis_customer_id" readonly>
                                        <input type="hidden" class="form-control" name="covis_customer_branch_id" id="covis_customer_branch_id" readonly>
                                        <div class="form-group">
                                            <label class="form-label" for="user_id">Assigned To <code
                                                    class="text-danger ml-1">*</code></label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="user_id" name="user_id" required>
                                                    <option disabled selected>--- Select ---</option>
                                                    @foreach ($surveyor as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="covis_class_id">Classification <code
                                                    class="text-danger ml-1">*</code></label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="covis_class_id" name="covis_class_id"
                                                    required>
                                                    <option disabled selected>--- Select ---</option>
                                                    @foreach ($classification as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="covis_priority_id">Priority <code
                                                    class="text-danger ml-1">*</code></label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="covis_priority_id"
                                                    name="covis_priority_id" required>
                                                    <option disabled selected>--- Select ---</option>
                                                    @foreach ($priority as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="termination_date">Termination Date <code
                                                    class="text-danger ml-1">*</code></label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control datepicker" id="termination_date"
                                                    name="termination_date" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="backdate">Backdate </label>
                                            <div class="form-control-wrap">
                                                <input type="date" class="form-control" name="backdate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="admin_note">Note <code
                                                    class="text-danger ml-1">*</code></label>
                                            <div class="form-control-wrap">
                                                <textarea class="form-control" id="admin_note"
                                                    name="admin_note" rows="3" required autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<input class="covis_customer_id" id="covis_customer_id" type="text">-->
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary btn-block"
                                            type="submit"><span>Submit</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal right fade" id="delete-modal" tabindex="-1" aria-labelledby="order-modalLabel" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p class="mt-4 modal-title">Are you sure delete this Customer ? </p>
                            <span id="name"></span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <form action="{{url('customer-delete')}}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="hidden" name="covis_customer_id" id="covis_customer_id">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary btn-block"
                                            type="submit"><span>Delete</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#order-modal').on('show.bs.modal', function(event) {
                var div = $(event.relatedTarget);
                var modal = $(this);

                modal.find('#covis_customer_id').attr("value", div.data('id'));
                modal.find('#covis_customer_branch_id').attr("value", div.data('branch'));
            })
            
            $('#delete-modal').on('show.bs.modal', function(event) {
                var div = $(event.relatedTarget);
                var modal = $(this);

                modal.find('#covis_customer_id').attr("value", div.data('id'));
            })
            
            $('#mode-modal').on('show.bs.modal', function(event) {
                var div = $(event.relatedTarget);
                var modal = $(this);

                modal.find('#covis_customer_id').attr("value", div.data('id'));
            })
            
            $('#delete-modal').on('show.bs.modal', function(event) {
                var div = $(event.relatedTarget);
                var modal = $(this);
                modal.find('#name').html(div.data('name'));
            })
            
             $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });
        })
    </script>
@endpush