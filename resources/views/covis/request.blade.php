@extends('layouts.app')
@section('content')

    <!-- content -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="row">
                </div>
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title mb-0">Order / Request</h3>
                                <div class="nk-block-des text-soft d-none d-md-inline-flex">
                                    <ul class="breadcrumb breadcrumb-pipe">
                                        <li class="breadcrumb-item active"><a href="#">You have total ({{ $transaction->count() }})</a></li>
                                        <li class="breadcrumb-item"><a href="#">To Be Confirm ({{ $tobeconfirm }})</a></li>
                                        <li class="breadcrumb-item"><a href="#">Waiting Approval ({{ $tobeapproval }})</a></li>
                                        <li class="breadcrumb-item"><a href="#">In-Progress ({{ $inproggress }})</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="{{ url('transaction-revision') }}"
                                                    class="btn btn-white btn-outline-light"><em
                                                        class="icon ni ni-caution-fill text-warning"></em><span>Revision</span></a>
                                            </li>
                                            <li><a href="{{ url('transaction-request-complete') }}"
                                                    class="btn btn-white btn-outline-light"><em
                                                        class="icon ni ni-check-circle-cut text-success"></em><span>Completed</span></a>
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
                                    <!-- <div class="table-responsive"> -->
                                        <table class="datatable-init-export nk-tb-list nk-tb-ulist nowrap" data-auto-responsive="false"
                                            data-export-title="Export" id="customer_request_table">
                                            <thead>
                                                <tr class="nk-tb-item nk-tb-head">
                                                    <th class="nk-tb-col"></th>
                                                    <th class="nk-tb-col"><span class="sub-text">Customer Name</span>
                                                    </th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Type / Client</span>
                                                    </th>
                                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Address</span>
                                                    </th>
                                                   
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
                                            @php $no = 1; @endphp
                                            @foreach ($transaction as $tran)
                                                <tr class="nk-tb-item">
                                                    <td class="nk-tb-col" nowrap>
                                                        <span class="tb-status">{{ $no++ }}</span>
                                                    </td>
                                                    <td class="nk-tb-col" style="width: 220px; white-space:normal;">
                                                        <div class="user-card">
                                                            <div
                                                                class="user-avatar 
                                                                @if ($tran->covis_class_id == 1) bg-primary
                                                                @elseif ($tran->covis_class_id == 2) bg-info
                                                                @elseif ($tran->covis_class_id == 3) bg-warning @endif d-none d-sm-flex">
                                                                <span>{{ $tran->class->code }}</span>
                                                            </div>
                                                            <div class="user-info">
                                                                <span class="tb-lead">
                                                                    {{ $tran->customer->name }} <span
                                                                        class="dot dot-success d-md-none ml-1"></span>
                                                                </span>
                                                                <span> #{{ $tran->customer->code  ?? ''}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-mb" nowrap>
                                                        <div class="user-card">
                                                            <div class="user-info">
                                                                <span class="tb-lead">
                                                                    {{ $tran->customer->covisType->name }} <span
                                                                        class="dot dot-success d-md-none ml-1"></span>
                                                                </span>
                                                                <span>
                                                                    {{ $tran->customer->project->code  ?? '' }}
                                                                        {{ $tran->customer->branch->name ?? '' }} ({{ $tran->customer->region->name  ?? ''}})
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-mb" style="width: 220px; white-space:normal;">
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
                                                    
                                                    <td class="nk-tb-col tb-col-md" nowrap>
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
                                                    <td class="nk-tb-col nk-tb-col-tools" nowrap>
                                                        <ul class="nk-tb-actions gx-1">
                                                            <li class="nk-tb-action-hidden">
                                                                <a href="{{ url('transaction-request-view', $tran->uuid) }}"
                                                                    class="btn btn-trigger btn-icon" data-toggle="tooltip"
                                                                    data-placement="top" title="View" target="_blank">
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
                                                                <a href=""
                                                                    data-target="#re-assign-modal"
                                                                    data-toggle="modal"
                                                                    data-id="{{ $tran->id }}"
                                                                    data-name = "{{$tran->surveyor->name}}"
                                                                    data-idsurveyor = "{{$tran->surveyor->id}}"
                                                                    class="btn btn-trigger btn-icon" 
                                                                    data-toggle="tooltip"
                                                                    data-placement="top" 
                                                                    title="Re-Assign">
                                                                    <em class="icon ni ni-exchange"></em>
                                                                </a>
                                                            </li>
                                                            @if ($tran->status != 4)
                                                            <li class="nk-tb-action-hidden">
                                                                <a href="#"
                                                                    data-id="{{ $tran->id }}"
                                                                    data-name="{{ $tran->customer->name ?? 'N/A'}}"
                                                                    class="toggle btn btn-trigger btn-icon btn-activated-deactivated"
                                                                    data-target="cancel-modal" 
                                                                    data-toggle="tooltip"
                                                                    data-placement="top" 
                                                                    title="Cancel">
                                                                    <em class="icon ni ni-cross-circle"></em>
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
                                            </tbody>
                                        </table>
                                    <!-- </div> -->
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


    <!-- re assign modal -->
    <div class="modal right fade" id="re-assign-modal" tabindex="-1" aria-labelledby="order-modalLabel" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="modal-title">Re-Assign Surveyor</h5>
                            <code class="small text-danger">* Required</code>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <form action="{{url('re-assign')}}" method="POST">
                                @csrf
                                <input type="hidden" id="id" name="idtransaction">
                                <div class="row g-3">
                                    <div class="col-12">
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
    <!-- / -->

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
<script>
    $('#customer_request_table').on('click','.btn-activated-deactivated', function(){
        let id = $(this).data('id');
        let name = $(this).data('name');
        $('.id').val(id);
        $('.name').val(name);
        $('#name').html(name);
    })
    
    $('#re-assign-modal').on('show.bs.modal', function(event) {
        var div = $(event.relatedTarget);
        var modal = $(this);
        modal.find('#idsurveyor').attr("value", div.data('idsurveyor'));
        modal.find('#id').attr("value", div.data('id'));
    })
    
     $('#re-assign-modal').on('show.bs.modal', function(event) {
        var div = $(event.relatedTarget);
        var modal = $(this);
        modal.find('#name').html(div.data('name'));
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
@endpush
