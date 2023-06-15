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
                                <h3 class="nk-block-title page-title mb-0">Report</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Order / Request Transaction Report.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
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
                        </div>
                    </div>
                    <div class="nk-block nk-block-lg mb-1">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label class="form-label">Date Range</label>
                                        <div class="input-daterange date-picker-rang input-group">
                                            <input type="text" class="form-control" value="{{ date('d-M-y',strtotime($from)) }}">
                                            <div class="input-group-addon">TO</div>
                                            <input type="text" class="form-control" value="{{ date('d-M-y',strtotime($to)) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="components-preview">
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init-export nk-tb-list nk-tb-ulist" data-auto-responsive="false"
                                         data-export-title="Export">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Company</span></th>
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Region</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Total Data</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Complete</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Outstanding</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Cancel</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($report as $data)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                                            <span>{{ $data->code }}</span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ $data->name  ?? '--'}} <span class="dot dot-success d-md-none ml-1"></span></span>
                                                            <span>{{ $data->project ?? 'Prooject not Found'}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-mb">
                                                    <span class="">{{ $data->company}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-mb">
                                                    <span class="">Kanwil {{ $data->region ?? 'Region not Found'}}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md"><span class="text-dark">{{ $data->total_data }}</span></td>
                                                <td class="nk-tb-col tb-col-md"><span class="text-success">{{ $data->total_complete }}</span></td>
                                                <td class="nk-tb-col tb-col-md"><span class="text-warning">{{ $data->total_proggres }}</span></td>
                                                <td class="nk-tb-col tb-col-md"><span class="text-danger">{{ $data->total_cancel }}</span></td>
                                            </tr>
                                        @endforeach    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <p class="small text-primary">Select data between two dates.</p>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <form action="{{ url('transaction-report-result') }}" method="POST">
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
                        <button class="btn btn-primary" type="submit"><span>Get Report</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- E/modal search -->

@endsection
