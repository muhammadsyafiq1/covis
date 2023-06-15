@extends('layouts.app')

@push('addon-style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')

    @hasanyrole('Head|Supervisor|Administrator|System Administrator')

        <div class="nk-content nk-content-fluid">
            <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                    <div class="nk-content-body">
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h3 class="nk-block-title page-title mb-0">Approval Order / Request</h3>
                                    <div class="nk-block-des text-soft d-none d-md-inline-flex">
                                        <ul class="breadcrumb breadcrumb-pipe">
                                            <li class="breadcrumb-item active"><a href="#">You have total ({{ $transaction->count() }})</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
    
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
    
                        <div class="components-preview">
                            <div class="nk-block nk-block-lg">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        <div class="card-tools mb-4">
                                            <div class="form-inline flex-nowrap gx-3"></div>
                                        </div>
                                        <form action="{{ url('confirmAllTransaction') }}" method="post">
                                            @csrf
                                            <table class="datatable-init-export nk-tb-list nk-tb-ulist" id="table_approval"
                                                data-auto-responsive="false" data-export-title="Export">
                                                <thead>
    
                                                    <tr class="nk-tb-item nk-tb-head">
                                                        <th class="nk-tb-col"><input onClick="myFunction()" type="checkbox"
                                                                id="master" class="tombol_show"></th>
                                                                <th class="nk-tb-col"><span class="sub-text">Customer Name</span>
                                                    </th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Type / Client</span>
                                                    </th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Address</span>
                                                    </th>
                                                    <!-- <th class="nk-tb-col tb-col-md"><span class="sub-text">PIC</span>
                                                    </th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Account
                                                            Officer</span></th> -->
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Term
                                                            Date</span></th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Assign
                                                            To</span></th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text"></span>
                                                    </th>
                                                    <th class="nk-tb-col nk-tb-col-tools text-right">
                                                    </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($transaction as $tran)
                                                        <tr class="nk-tb-item" id="{{ $tran->id }}">
                                                            <td class="nk-tb-col">
                                                                <input type="checkbox" class="sub_chk checkboxInput"
                                                                    value="{{ $tran->id }}" name="id[]">
                                                            </td>
                                                            <td class="nk-tb-col">
                                                                <div class="user-card">
                                                                    @if ($tran->customer->mode == 1)
                                                                    <div class="user-avatar xs bg-dim-primary d-none d-sm-flex">
                                                                        <span><em class="icon ni ni-camera"></em></span>
                                                                    @else
                                                                        <div class="user-avatar xs bg-warning d-none d-sm-flex">
                                                                            <span><em class="icon ni ni-img"></em></span>
                                                                    @endif 
                                                                    </div>
                                                                    <div class="user-info">
                                                                        <span class="tb-lead">
                                                                            {{ $tran->customer->name ?? 'N/A' }} <span
                                                                                class="dot dot-success d-md-none ml-1"></span>
                                                                        </span>
                                                                        <span>
                                                                            #{{ $tran->customer->code  ?? ''}} @if($tran->covis_class_id == 1) <span class="text-primary"><i>(Regular)</i></span> @elseif($tran->covis_class_id == 2) <span class="text-primary"><i>(LK Motor)</i></span> @else <span class="text-primary"><i>(LK Mobil)</i></span> @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                                <div class="user-card">
                                                                    <div class="user-info">
                                                                        <span class="tb-lead">
                                                                            {{ $tran->customer->covisType->name ?? 'N/A' }} <span
                                                                                class="dot dot-success d-md-none ml-1"></span>
                                                                        </span>
                                                                        <span>
                                                                            {{ $tran->customer->project->code }}
                                                                            {{ $tran->customer->branch->name }} ({{ $tran->customer->region->name }})
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md" style="width: 220px; white-space:normal;">
                                                                <div class="user-card">
                                                                    <div class="user-info">
                                                                        <span class="tb-lead small">
                                                                            {{ $tran->customer->address ?? 'N/A' }}
                                                                        </span>
                                                                        <span>
                                                                            {{ ucwords(strtolower($tran->customer->cityCustomer->name ?? '--')) }},
                                                                            {{ ucwords(strtolower($tran->customer->provinceCustomer->name ?? '--')) }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td class="nk-tb-col tb-col-md">
                                                                <div class="user-card">
                                                                    <div class="user-info">
                                                                        <span class="tb-lead">
                                                                            {{ $tran->customer->contact_name ?? 'N/A'}} <span
                                                                                class="dot dot-success d-md-none ml-1"></span>
                                                                        </span>
                                                                        <span>
                                                                            <a href="tel:{{ '+62 ' . $tran->customer->contact_no ?? 'N/A' }}">{{ '+62 ' . $tran->customer->contact_no ?? 'N/A' }}</a>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                                <div class="user-card">
                                                                    <div class="user-info">
                                                                        <span class="tb-lead">
                                                                            {{ $tran->customer->ao_name ?? 'N/A'}} <span
                                                                                class="dot dot-success d-md-none ml-1"></span>
                                                                        </span>
                                                                        <span>
                                                                            <a href="tel:{{ '+62 ' . $tran->customer->ao_no ?? 'N/A' }}">{{ '+62 ' . $tran->customer->ao_no ?? 'N/A' }}</a>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td> -->
                                                            <td class="nk-tb-col tb-col-md">
                                                                <span class="tb-status">{{ Carbon\Carbon::parse($tran->termination_date)->format('M d, Y') }}</span>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md" nowrap>
                                                                <span class="tb-status text-primary">{{ $tran->surveyor->name }}</span>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md" nowrap>
                                                                @if ($tran->status == 1)
                                                                    <span class="tb-status badge badge-primary rounded-pill">TBC</span>
                                                                @elseif ($tran->status == 2)
                                                                    <span class="tb-status badge badge-warning rounded-pill">WTA</span>
                                                                @elseif ($tran->status == 3)
                                                                    <span class="tb-status badge badge-success rounded-pill">IPG</span>
                                                                @elseif ($tran->status == 4)
                                                                    <span class="tb-status badge badge-danger rounded-pill">CNC</span>
                                                                @elseif ($tran->status == 5)
                                                                    <span class="tb-status badge badge-primary rounded-pill">DNE</span>
                                                                @endif
                                                            </td>
                                                            <td class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="{{ url('transaction-approval-view',$tran->uuid) }}"
                                                                            class="btn btn-trigger btn-icon"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="View" target="_blank">
                                                                            <em class="icon ni ni-external"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="" 
                                                                            data-target="#contact" data-toggle="modal"
                                                                            data-contactname="{{ $tran->customer->contact_name }}"
                                                                            data-contactno="{{ $tran->customer->contact_no }}"
                                                                            data-aoname="{{ $tran->customer->ao_name }}"
                                                                            data-aono="{{ $tran->customer->ao_no }}"
                                                                            class="btn btn-trigger btn-icon" 
                                                                            data-toggle="tooltip"
                                                                            data-placement="top" 
                                                                            title="Contact">
                                                                            <em class="icon ni ni-user-circle"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#"
                                                                            data-id="{{ $tran->id }}"
                                                                            data-name="{{ $tran->customer->name ?? 'N/A'}}"
                                                                            class="toggle btn btn-trigger btn-icon btn-approval"
                                                                            data-target="cancel-modal" 
                                                                            data-toggle="tooltip"
                                                                            data-placement="top" 
                                                                            title="Cancel">
                                                                            <em class="icon ni ni-cross-circle"></em>
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
                                             @hasanyrole('Head|Supervisor|Administrator|System Administrator')
                                                    <div class="row justify-content-end">
                                                        <div class="col-md-2">
                                                            <div class="btn-wrap" id="next-container">
                                                                <span class="">
                                                                    <button 
                                                                        class="btn btn-block btn-primary delete_all" type="submit"
                                                                        id="btn_confirm">Approved</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endhasrole
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Toggle Approval Modal -->
        <div class="nk-add-product toggle-slide toggle-slide-right" data-content="approve-modal" data-toggle-screen="any"
            data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">Approval Order / Request</h5>
                    <div class="nk-block-des">
                        <p class="small text-primary">Are you sure want to approve this?
                            <span id="name"></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <form action="{{ route('transaction-approval') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <input type="hidden" name="covisTransaction_id" id="id" class="id">
                            <button class="btn btn-primary" type="submit"><span>Approve</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        @include('errors.forbidden')
    @endhasanyrole


    <!-- modal cancel -->
    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="cancel-modal" data-toggle-screen="any"
        data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Cancel Order / Request</h5>
                <code class="small text-danger">* Required</code>
                <div class="nk-block-des mt-2">
                    <p class="small text-primary">Are you sure want to cancel this order / request? <br><strong><span id="name"></span></strong> </p>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <form action="{{ route('transaction-cancel') }}" method="get">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="">Note<code class="ml-1">*</code></label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="cancel_note" name="cancel_note" rows="10" required></textarea>
                                <input type="hidden" name="id" id="id" class="form-control id">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit"><span>Submit</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /modal cancel -->


    <!-- contact -->
    <div class="modal right fade" id="contact" tabindex="-1" aria-labelledby="order-modalLabel" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="modal-title">Contact Information</h5>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <span><strong>PIC Name:</strong></span>
                        </div>
                        <div class="col-12 mb-2">
                            <span id="contactname"></span>
                        </div>
                        <div class="col-12">
                            <span><strong>PIC Mobile No:</strong></span>
                        </div>
                        <div class="col-12 mb-4">
                            <a href="#"><span id="contactno"></span></a>
                        </div>
                        <div class="col-12">
                            <span><strong>AO Name:</strong></span>
                        </div>
                        <div class="col-12 mb-2">
                            <span id="aoname"></span>
                        </div>
                        <div class="col-12">
                            <span><strong>AO Mobile No:</strong></span>
                        </div>
                        <div class="col-12">
                            <a href="#"><span id="aono"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /contact -->

@endsection


@push('addon-script')
    @push('addon-script')
    <script>
        $('#table_approval').on('click', '.btn-approval', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('.id').val(id);
            $('#name').html(name);
        })

        $('#contact').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget);
            var modal = $(this);
            modal.find('#contactname').html(div.data('contactname'));
            modal.find('#contactno').html(div.data('contactno'));
            modal.find('#aoname').html(div.data('aoname'));
            modal.find('#aono').html(div.data('aono'));
        })
    </script>

    <script>
        $(document).ready(function() {

            // check semua checbox
            $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });


        });

        // }
    </script>
@endpush
@endpush
