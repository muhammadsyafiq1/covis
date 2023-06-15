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
                                <h3 class="nk-block-title page-title mb-0">Dashboard</h3>
                                <div class="nk-block-des text-soft">
                                    <p>COVIS Dashboard Analytics.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#"
                                                        class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                                        data-toggle="dropdown"><em
                                                            class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span
                                                                class="d-none d-md-inline">This</span> Years</span>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-md-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-0">
                                            <div class="card-title">
                                                <h6 class="subtitle">Total Data</h6>
                                            </div>
                                            <div class="card-tools">
                                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip"
                                                    data-placement="left" title="Total Data"></em>
                                            </div>
                                        </div>
                                        <div class="card-amount">
                                            <span class="amount"> {{ $totalTransaction }} </span>
                                            <!-- <span class="change up text-danger"><em
                                                    class="icon ni ni-arrow-long-up"></em>{{ round($upMonthTotalData) }}%</span> -->
                                        </div>
                                        <div class="invest-data">
                                            <div class="invest-data-amount g-2">
                                                <div class="invest-data-history">
                                                    <div class="title">This Month</div>
                                                    <div class="amount">{{ $totalTransactionCurrentMonth }}</div>
                                                </div>
                                                <div class="invest-data-history">
                                                    <div class="title">This Week</div>
                                                    <div class="amount">{{ $totalTransactionCurrentWeek }}</div>
                                                </div>
                                            </div>
                                            <div class="invest-data-ck">
                                                <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-0">
                                            <div class="card-title">
                                                <h6 class="subtitle">Completed</h6>
                                            </div>
                                            <div class="card-tools">
                                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip"
                                                    data-placement="left" title="Completed"></em>
                                            </div>
                                        </div>
                                        <div class="card-amount">
                                            <span class="amount"> {{ $transactionCompleted }} </span>
                                            <!-- <span class="change down text-danger"><em
                                                    class="icon ni ni-arrow-long-down"></em>{{ round($upMonthTotalDataComplete) }}%</span> -->
                                        </div>
                                        <div class="invest-data">
                                            <div class="invest-data-amount g-2">
                                                <div class="invest-data-history">
                                                    <div class="title">This Month</div>
                                                    <div class="amount">
                                                        {{ $totalTransactionCompletedCurrentMonth }}</div>
                                                </div>
                                                <div class="invest-data-history">
                                                    <div class="title">This Week</div>
                                                    <div class="amount">
                                                        {{ $totalTransactionCompletedCurrentWeek }}</div>
                                                </div>
                                            </div>
                                            <div class="invest-data-ck">
                                                <canvas class="iv-data-chart" id="totalWithdraw"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-bordered  card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-0">
                                            <div class="card-title">
                                                <h6 class="subtitle">Outstanding</h6>
                                            </div>
                                            <div class="card-tools">
                                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip"
                                                    data-placement="left" title="Outstanding"></em>
                                            </div>
                                        </div>
                                        <div class="card-amount">
                                            <span class="amount"> {{ $transactionInProgress }}
                                            </span>
                                            <!-- <span class="change up text-danger"><em
                                                    class="icon ni ni-arrow-long-up"></em>{{ round($upMonthTotalDataProgress) }}%</span> -->
                                        </div>
                                        <div class="invest-data">
                                            <div class="invest-data-amount g-2">
                                                <div class="invest-data-history">
                                                    <div class="title">This Month</div>
                                                    <div class="amount">
                                                        {{ $totalTransactionInProgressCurrentMonth }}</div>
                                                </div>
                                                <div class="invest-data-history">
                                                    <div class="title">This Week</div>
                                                    <div class="amount">
                                                        {{ $totalTransactionInProgressCurrentWeek }}</div>
                                                </div>
                                            </div>
                                            <div class="invest-data-ck">
                                                <canvas class="iv-data-chart" id="totalBalance"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xxl-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group mb-0">
                                            <div class="card-title">
                                                <h6 class="title">Class Overview</h6>
                                                <p>Collateral visit classification overview.
                                                </p>
                                            </div>
                                        </div>
                                        <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#overview">Regular</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#thisyear">LK Motor</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#alltime">LK Mobil</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content mt-0">
                                            {{-- regular --}}
                                            <div class="tab-pane active" id="overview">
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle">Currently Active</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">
                                                                {{ $transactionRegularCurrentMonth }}</div>
                                                            <div class="title">TOTAL</div>
                                                        </div>
                                                        <div class="invest-ov-stats">
                                                            <div><span
                                                                    class="amount">{{ $transactionRegularCurrentMonthCompleted }}</span>
                                                            </div>
                                                            <div class="title">Complete</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle">This Week</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">
                                                                {{ $transactionRegularCurrentWeek }}</div>
                                                            <div class="title">TOTAL</div>
                                                        </div>
                                                        <div class="invest-ov-stats">
                                                            <div><span
                                                                    class="amount">{{ $transactionRegularCurrentWeekCompleted }}
                                                                </span>
                                                            </div>
                                                            <div class="title">Complete</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- lk motor --}}
                                            <div class="tab-pane" id="thisyear">
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle">Currently Active</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">
                                                                {{ $transactionLKMotorCurrentMonth }}</div>
                                                            <div class="title">TOTAL</div>
                                                        </div>
                                                        <div class="invest-ov-stats">
                                                            <div><span
                                                                    class="amount">{{ $transactionLKMotorCurrentMonthCompleted }}</span>
                                                            </div>
                                                            <div class="title">Complete</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle">This Week</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">
                                                                {{ $transactionLKMotorCurrentWeek }}</div>
                                                            <div class="title">TOTAL</div>
                                                        </div>
                                                        <div class="invest-ov-stats">
                                                            <div><span
                                                                    class="amount">{{ $transactionLKMotorCurrentWeekCompleted }}</span>
                                                            </div>
                                                            <div class="title">Complete</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- lk mobil --}}
                                            <div class="tab-pane" id="alltime">
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle">Currently Active</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">
                                                                {{ $transactionLKMobilCurrentMonth }}</div>
                                                            <div class="title">TOTAL</div>
                                                        </div>
                                                        <div class="invest-ov-stats">
                                                            <div><span
                                                                    class="amount">{{ $transactionLKMobilCurrentMonthCompleted }}</span>
                                                            </div>
                                                            <div class="title">Complete</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle">This Week</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">
                                                                {{ $transactionLKMobilCurrentWeek }}</div>
                                                            <div class="title">TOTAL</div>
                                                        </div>
                                                        <div class="invest-ov-stats">
                                                            <div><span
                                                                    class="amount">{{ $transactionLKMobilCurrentWeekCompleted }}</span>
                                                            </div>
                                                            <div class="title">Complete</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xxl-8">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner d-flex flex-column h-100">
                                        <div class="card-title-group mb-3">
                                            <div class="card-title">
                                                <h6 class="title">Top Surveyor</h6>
                                                <p>Last top 5 surveyors.</p>
                                            </div>
                                        </div>
                                        <div class="progress-list gy-3">
                                            
                                            @foreach ($finalTopSurvey as $top)
                                            <div class="progress-wrap">
                                                <div class="progress-text">
                                                    <div class="progress-label">{{ $top['nama'] }}</div>
                                                    <div class="progress-amount">{{ round($top['total']) }}%
                                                        <span class="text-info"></span>
                                                    </div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-azure" data-progress="{{ round($top['total']) }}"></div>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-xxl-12">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner border-bottom">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Recent Collateral Visit</h6>
                                            </div>
                                            <div class="card-tools">
                                                <a href="{{ url('transaction-request-complete') }}"
                                                    class="link">View All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-list">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span>Customer Name</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>Type</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span>Account Officer</span></div>
                                            <div class="nk-tb-col"><span>Termination Date</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>Visited Date</span></div>
                                            <div class="nk-tb-col tb-col-sm">Survey By</div>
                                            <div class="nk-tb-col"></div>
                                        </div>
                                        @foreach ($recentTransaction as $transaction)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div
                                                            class="user-avatar
                                                                @if ($transaction->covis_class_id == 1) bg-success
                                                                @elseif ($transaction->covis_class_id == 2) bg-info
                                                                @elseif ($transaction->covis_class_id == 3) bg-warning @endif d-none d-sm-flex">
                                                            <span>{{ $transaction->class->code }}</span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead">
                                                                {{ $transaction->customer->name }}
                                                            </span>
                                                            <span><span>{{ $transaction->customer->project->code }}
                                                                    {{ $transaction->customer->branch->name }}</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            <span class="tb-lead">
                                                                {{ $transaction->customer->covisType->name }}
                                                            </span>
                                                            <span>{{ !$transaction->customer->district_code ? '---' : ucwords(strtolower($transaction->customer->districtCustomer->name)) }},
                                                                {{ !$transaction->customer->city_code ? '---' : ucwords(strtolower($transaction->customer->cityCustomer->name)) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            <span class="tb-lead">
                                                                {{ $transaction->customer->ao_name }}
                                                            </span>
                                                            <span>
                                                                {{ $transaction->customer->ao_number }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span
                                                        class="tb-sub tb-amount">{{ Carbon\Carbon::parse($transaction->termination_date)->format('d M, Y') }}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm">
                                                    <span
                                                        class="tb-sub tb-amount">{{ Carbon\Carbon::parse($transaction->revision_date)->format('d M, Y') }}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm">
                                                    <span
                                                        class="tb-sub tb-amount">{{ $transaction->surveyor->name }}</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-action">
                                                    <div class="dropdown">
                                                        <a href="{{ url('transaction-request-complete') }}"
                                                            target="_blank"
                                                            class="text-soft btn btn-sm btn-icon btn-trigger"><em
                                                                class="icon ni ni-chevron-right"></em></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content -->
    
@endsection
