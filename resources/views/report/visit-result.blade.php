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
                                    <p>Collateral Site Visit Report.</p>
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
                    <div class="components-preview">
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init-export nk-tb-list nk-tb-ulist" data-auto-responsive="false"
                                         data-export-title="Export">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">Visit Date</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Customer Name</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Customer Type</span></th>
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Surveyor Name</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Distance</span></th>
                                                <th class="nk-tb-col nk-tb-col-tools text-right"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($report as $data)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col" nowrap>
                                                    <div class="user-card">
                                                        <div
                                                            class="user-avatar 
                                                            @if ($data->covis_class_id == 1) bg-success
                                                            @elseif ($data->covis_class_id == 2) bg-info
                                                            @elseif ($data->covis_class_id == 3) bg-warning @endif d-none d-sm-flex">
                                                            <span>{{ $data->class->code }}</span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead">
                                                                {{ Carbon\Carbon::parse($data->visited_at)->format('d-M-y') }}
                                                            </span>
                                                            <span>
                                                                {{ Carbon\Carbon::parse($data->visited_at)->format('H:i A') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            <span class="tb-lead">
                                                                {{ $data->customer->name }} <span
                                                                    class="dot dot-success d-md-none ml-1"></span>
                                                            </span>
                                                            <span>{{ $data->customer->branch->name }}
                                                                ({{ $data->customer->region->name }})
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col" nowrap>
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            <span class="tb-lead">
                                                                {{ $data->customer->covisType->name }} <span
                                                                    class="dot dot-success d-md-none ml-1"></span>
                                                            </span>
                                                            <span>
                                                                {{ ucwords(strtolower($data->customer->cityCustomer->name ?? '--')) }},
                                                                {{ ucwords(strtolower($data->customer->provinceCustomer->name ?? '--')) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col" nowrap>
                                                    {{ $data->surveyor->name }}
                                                </td>
                                                <td class="nk-tb-col">{{ $data->distance }} KM</td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{ url('transaction-complete-view', $data->uuid) }}"
                                                                class="btn btn-trigger btn-icon" data-toggle="tooltip"
                                                                data-placement="top" title="View">
                                                                <em class="icon ni ni-external"></em>
                                                            </a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{ url('print-transaction', $data->id) }}"
                                                                target="_blank" class="btn btn-trigger btn-icon"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Print Report">
                                                                <em class="icon ni ni-printer"></em>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <div class="drodown">
                                                                <a href=""
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
            <form action="{{ url('visit-report-result') }}" method="POST">
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
    <!-- modal search -->

@endsection
