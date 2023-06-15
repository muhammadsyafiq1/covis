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
                                        <li class="breadcrumb-item active"><a href="#">You have total (0)</a></li>
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
                                        {{--  --}}
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
@endsection
