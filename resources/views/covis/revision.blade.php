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
                                <h3 class="nk-block-title page-title mb-0">Customer Revision</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{ $transaction->count() }} data.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="{{ url('transaction-request-complete') }}"
                                                    class="btn btn-white btn-outline-light"><em
                                                        class="icon ni ni-check-circle-cut text-success"></em><span>Complete</span></a>
                                            </li>
                                            <li><a href="{{ url('transaction-request') }}"
                                                    class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                                        class="icon ni ni-arrow-left"></em><span>Back</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- datatable -->
                    <div class="components-preview">
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init-export nk-tb-list nk-tb-ulist" data-auto-responsive="false"
                                        data-export-title="Export" id="revision_table">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">Customer Name</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Complete Date</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Revision Date</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Assigned
                                                        To</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></th>
                                                <th class="nk-tb-col nk-tb-col-tools text-right"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaction as $tran)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-avatar d-none d-sm-flex" style="background-color: #FF8C00;">
                                                            <span>{{ substr($tran->customer->code ,1, 3)}}</span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ $tran->customer->name }} <span
                                                                    class="dot dot-success d-md-none ml-1"></span></span>
                                                                    <span>{{ $tran->customer->branch->name }} ({{ $tran->customer->region->name }})
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
                                                                {{ ucwords(strtolower($tran->customer->cityCustomer->name ?? '--')) }},
                                                                {{ ucwords(strtolower($tran->customer->provinceCustomer->name ?? '--')) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md" nowrap>
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            <span class="tb-lead">
                                                                {{ date('d-M-Y', strtotime($tran->visited_at)) }} <span
                                                                    class="dot dot-success d-md-none ml-1"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg" nowrap>
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            <span class="tb-lead">
                                                                @if($tran->revision_date == NULL)
                                                                N/A <span class="dot dot-success d-md-none ml-1"></span>
                                                                @else
                                                                {{ date('d-M-Y', strtotime($tran->revision_date)) }} <span class="dot dot-success d-md-none ml-1"></span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead text-primary">{{ $tran->surveyor->name }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    @if ($tran->is_revision == 1)
                                                        <span class="tb-lead text-success">In Progress</span>
                                                        
                                                    @else
                                                        <span class="tb-lead text-primary">Done</span>

                                                    @endif
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{ url('transaction-revision-view',$tran->uuid) }}"
                                                                class="btn btn-trigger btn-icon" data-toggle="tooltip"
                                                                data-placement="top" title="View">
                                                                <em class="icon ni ni-external"></em>
                                                            </a>
                                                        </li>
                                                        @if ($tran->is_revision == 2)
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{ route('print-transaction',$tran->id) }}" 
                                                                target="_blank" 
                                                                class="btn btn-trigger btn-icon" 
                                                                data-toggle="tooltip" 
                                                                data-placement="top" 
                                                                title="Print Report">
                                                                <em class="icon ni ni-printer"></em>
                                                            </a>
                                                        </li>
                                                        @else
                                                        
                                                        @endif
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
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
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
                        </div>
                    </div>
                    <!-- /datatable -->

                </div>
            </div>
        </div>
    </div>
    <!-- /content -->
    
    
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
   $('#re-assign-modal').on('show.bs.modal', function(event) {
        var div = $(event.relatedTarget);
        var modal = $(this);
        modal.find('#idsurveyor').attr("value", div.data('idsurveyor'));
        modal.find('#id').attr("value", div.data('id'));
    })
    
    $('#contact').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget);
            var modal = $(this);
            modal.find('#contactname').html(div.data('contactname'));
            modal.find('#contactno').html(div.data('contactno'));
            modal.find('#aoname').html(div.data('aoname'));
            modal.find('#aono').html(div.data('aono'));
        })
    
     $('#re-assign-modal').on('show.bs.modal', function(event) {
        var div = $(event.relatedTarget);
        var modal = $(this);
        modal.find('#name').html(div.data('name'));
    })
</script>
@endpush
