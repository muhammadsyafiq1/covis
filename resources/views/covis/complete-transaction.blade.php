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
                                <h3 class="nk-block-title page-title mb-0">Complete Order / Request</h3>
                                <div class="nk-block-des text-soft d-none d-md-inline-flex">
                                    <ul class="breadcrumb breadcrumb-pipe">
                                        <li class="breadcrumb-item active"><a href="#">You have total ({{ $result->count() }})</a></li>
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
                                            <li><a href="{{ url('transaction-request') }}"
                                                    class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                                        class="icon ni ni-arrow-left"></em><span>Back</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle mt-4">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="#" data-target="search-modal"
                                                    class="toggle btn btn-white btn-outline-light"><em
                                                        class="icon ni ni-calendar text-warning"></em><span>Search</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                
                            </div>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="nk-block nk-block-lg mb-1">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label class="form-label">Date Range</label>
                                        <div class="input-daterange date-picker-rang input-group">
                                            <input type="text" class="form-control" value="{{ date('d-M-Y', strtotime($start)) }}">
                                            <div class="input-group-addon">TO</div>
                                            <input type="text" class="form-control" value="{{ date('d-M-Y', strtotime($end)) }}">
                                        </div>
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
                                    <table class="datatable-init-export nk-tb-list nk-tb-ulist" id="customer-table" data-auto-responsive="false" data-export-title="Export">
                                        <thead>
                                          <tr class="nk-tb-item nk-tb-head">
                                              <th class="nk-tb-col"><span class="sub-text">Customer Name</span>
                                              </th>
                                              <th class="nk-tb-col tb-col-md"><span class="sub-text">Type</span>
                                              </th>
                                              <th class="nk-tb-col tb-col-md"><span class="sub-text">Address</span>
                                              </th>
                                              <th class="nk-tb-col tb-col-md"><span class="sub-text">Term / Completed Date</span></th>
                                              <th class="nk-tb-col tb-col-md"><span class="sub-text">Back
                                                      Date</span></th>
                                              <th class="nk-tb-col tb-col-md"><span class="sub-text">Surveyor</span>
                                              </th>
                                              <th class="nk-tb-col nk-tb-col-tools text-right">
                                              </th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($result as $result)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    @if ($result->customer->mode == 1)
                                                        @if ($result->class->id == 1)
                                                        <div class="user-card" style="width: 200px; white-space:normal;" ><div class="user-avatar xs bg-dim-primary d-none d-sm-flex"><span><em class="icon ni ni-camera"></em></span></div><div class="user-info"><span class="tb-lead">{{ $result->customer->name }}<span class="dot dot-success d-md-none ml-1"></span></span><span># {{ $result->customer->code }}  <i class="text-primary">(Regular)</i></span></div></div>
                                                        @elseif ($result->class->id == 2)
                                                        <div class="user-card" style="width: 200px; white-space:normal;" ><div class="user-avatar xs bg-dim-primary d-none d-sm-flex"><span><em class="icon ni ni-camera"></em></span></div><div class="user-info"><span class="tb-lead">{{ $result->customer->name }}<span class="dot dot-success d-md-none ml-1"></span></span><span># {{ $result->customer->code }}  <i class="text-primary">(LK Motor)</i></span></div></div>
                                                        @else
                                                        <div class="user-card" style="width: 200px; white-space:normal;" ><div class="user-avatar xs bg-dim-primary d-none d-sm-flex"><span><em class="icon ni ni-camera"></em></span></div><div class="user-info"><span class="tb-lead">{{ $result->customer->name }}<span class="dot dot-success d-md-none ml-1"></span></span><span># {{ $result->customer->code }} <i class="text-primary">(LK Mobil)</i></span></div></div>  
                                                        @endif
                                                    @else
                                                        @if ($result->class->id == 1)
                                                        <div class="user-card" style="width: 200px; white-space:normal;" ><div class="user-avatar xs bg-warning d-none d-sm-flex"><span><em class="icon ni ni-img"></em></span></div><div class="user-info"><span class="tb-lead">{{ $result->customer->name }}<span class="dot dot-success d-md-none ml-1"></span></span><span>#{{ $result->customer->code }} <i class="text-primary">(Regular)</i></span></div></div>
                                                        @elseif ($result->class->id == 2)
                                                        <div class="user-card" style="width: 200px; white-space:normal;" ><div class="user-avatar xs bg-dim-primary d-none d-sm-flex"><span><em class="icon ni ni-camera"></em></span></div><div class="user-info"><span class="tb-lead">{{ $result->customer->name }}<span class="dot dot-success d-md-none ml-1"></span></span><span># {{ $result->customer->code }}  <i class="text-primary">(LK Motor)</i></span></div></div>
                                                        @else
                                                        <div class="user-card" style="width: 200px; white-space:normal;" ><div class="user-avatar xs bg-dim-primary d-none d-sm-flex"><span><em class="icon ni ni-camera"></em></span></div><div class="user-info"><span class="tb-lead">{{ $result->customer->name }}<span class="dot dot-success d-md-none ml-1"></span></span><span># {{ $result->customer->code }} <i class="text-primary">(LK Mobil)</i></span></div></div>  
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="nk-tb-col tb-col-mb">
                                                    <div class="user-card"><div class="user-info"><span class="tb-lead">{{ $result->customer->covisType->name }}<span  class="dot dot-success d-md-none ml-1"></span></span><span>{{ $result->customer->project->alias }} {{ $result->customer->branch->name }} ({{ $result->customer->region->name }})</span></div></div>
                                                </td>
                                                <td class="nk-tb-col tb-col-mb">
                                                    <div class="user-card"><div class="user-info"><span class="tb-lead small">{{ $result->customer->address }}</span><span class="text-capitalize">{{ $result->customer->cityCustomer->name }}, {{ $result->customer->provinceCustomer->name }}</span></div></div>
                                                </td>
                                                <td class="nk-tb-col tb-col-mb">
                                                    <div class="user-card"><div class="user-info"><span class="tb-lead small">{{ date('d-M-Y', strtotime($result->termination_date)) }}</span><span>{{ date('d-M-Y', strtotime($result->visited_at)) }}</span></div></div>
                                                </td>
                                                <td class="nk-tb-col tb-col-mb">
                                                    @if ($result->backdate == null)
                                                        <span class="tb-status">N/A</span>
                                                    @else
                                                        <span class="tb-status">{{ $result->backdate }}</span>
                                                    @endif
                                                </td>
                                                <td class="nk-tb-col tb-col-mb">
                                                    <span class="tb-status text-primary">{{ $result->surveyor->name }}</span>
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1"><li class="nk-tb-action-hidden">
                                                        <a href="" 
                                                            data-target="#contact" data-toggle="modal"
                                                            data-contactname="{{ $result->customer->contact_name }}"
                                                            data-contactno="{{ $result->customer->contact_no }}"
                                                            data-aoname="{{ $result->customer->ao_name }}"
                                                            data-aono="{{ $result->customer->ao_no }}"
                                                            class="btn btn-trigger btn-icon" 
                                                            data-toggle="tooltip"
                                                            data-placement="top" 
                                                            title="Contact">
                                                            <em class="icon ni ni-user-circle"></em>
                                                        </a>
                                                    </li><li class="nk-tb-action-hidden"><a href="{{ route('transaction-complete-view',$result->uuid) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="View"><em class="icon ni ni-external"></em></a></li><li class="nk-tb-action-hidden"><a href="{{ route('print-transaction',$result->id) }}" target="_blank" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Print Report"><em class="icon ni ni-printer"></em></a></li><li class="nk-tb-action-hidden"><a href="" data-id="{{ $result->id }}" data-target="#re-assign-modal" data-toggle="modal" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Revisi"><em class="icon ni ni-pen"></em></a></li><li class="nk-tb-action-hidden"><a href="" data-idtransaction="{{ $result->id }}" data-target="#backdate-modal" data-toggle="modal" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Backdate"><em class="icon ni ni-calender-date"></em></a></li><li><div class="drodown"><a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a></div></li></ul>
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

        <div class="modal right fade" id="backdate-modal" tabindex="-1" aria-labelledby="order-modalLabel" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="nk-block-title">Data Backdate</h5>
                                <div class="nk-block-des">
                                    <p class="small text-primary">Are you sure want to backdate this? <span class="name"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <form action="{{ url('transaction-backdate') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="">Date</label>
                                                <div class="form-control-wrap">
                                                    <input type="date" class="form-control" id="id" name="reported_at" required>
                                                    <input type="hidden" id="idtransaction" name="transaction_id">
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
                    </div>
                </div>
            </div>
        </div>

        <!-- revisi -->
        <div class="modal right fade" id="re-assign-modal" tabindex="-1" aria-labelledby="order-modalLabel" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="nk-block-title">Data Revision</h5>
                                <div class="nk-block-des">
                                    <p class="small text-primary">Are you sure want to revisi this Transaction?</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <form action="{{ url('transaction-revision') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="">Note</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control" id="id" name="revision_note" rows="10" required></textarea>
                                                    <input type="hidden" class="id" id="id" name="id">
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

        <!-- modal search -->
        <div class="nk-add-product toggle-slide toggle-slide-right" data-content="search-modal" data-toggle-screen="any"
        data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Search Date</h5>
                <div class="nk-block-des">
                    <p class="small text-primary">Select data between two dsates.</p>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <form action="{{ url('get-transaction-completed') }}" method="POST">
            @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="">Start Date</label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control" name="startdate" id="startdate" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="">End Date</label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control" name="enddate" id="enddate" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit"><span>Get Result</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /modal search -->
@endsection

@push('addon-script')
    <script>
        $('#complete_table').on('click', '.btn-activated-deactivated', function() {
            let id = $(this).data('id');
            $('.id').val(id);
        })
        // assign
        
        $('#re-assign-modal').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget);
            var modal = $(this);
            modal.find('#id').attr("value", div.data('id'));
        })

        $('#backdate-modal').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget);
            var modal = $(this);
            modal.find('#idtransaction').attr("value", div.data('idtransaction'));
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
