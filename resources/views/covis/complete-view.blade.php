@extends('layouts.app')
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><strong
                                        class="text-primary small">{{ $item->customer->name }}</strong></h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>Customer Code: <span class="text-base">{{ $item->customer->code }}</span>
                                        </li>
                                        <li>Client: <span
                                                class="text-base">{{ $item->customer->project->name }}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ url('transaction-request-complete') }}"
                                    class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                        class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="{{ url('transaction-request-complete') }}"
                                    class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em
                                        class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-content">
                                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabItem1"><em
                                                    class="icon ni ni-user-circle"></em><span>Information</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabItem2"><em
                                                    class="icon ni ni-repeat"></em><span>Transactions</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabItem3"><em
                                                    class="icon ni ni-file-text"></em><span>Documents</span></a>
                                        </li>
                                        <li class="nav-item nav-item-trigger ">
                                            <a href="{{ url('print-transaction', $item->id) }}"
                                                class="btn btn-icon btn-trigger" target="_blank"><em
                                                    class="icon ni ni-printer"></em></a>
                                        </li>
                                    </ul>
                                    <div class="card-inner">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tabItem1">
                                                <div class="nk-block">
                                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                                        <h5 class="title">Customer Information</h5>
                                                    </div>
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Branch</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $item->customer->branch->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Region</span>
                                                                <span class="profile-ud-value">Kanwil
                                                                    {{ $item->customer->region->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Collateral Type</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $item->customer->covisType->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Termination Date</span>
                                                                <span
                                                                    class="profile-ud-value">{{ Carbon\Carbon::parse($item->termination_date)->format('d M Y') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">PIC Name</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $item->customer->contact_name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Mobile No.</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $item->customer->contact_no }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">AO Name</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $item->customer->ao_name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">AO No.</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $item->customer->ao_no }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-block">
                                                    <div class="nk-block-head nk-block-head-line">
                                                        <h6 class="title overline-title text-base">Additional Information
                                                        </h6>
                                                    </div>
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Address</span>
                                                                <span
                                                                    class="profile-ud-value">{{ ucwords(strtolower($item->customer->address)) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">District</span>
                                                                <span
                                                                    class="profile-ud-value">{{ ucwords(strtolower($tran->customer->districtCustomer->name ?? '--')) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">City</span>
                                                                <span
                                                                    class="profile-ud-value">{{ ucwords(strtolower($tran->customer->cityCustomer->name ?? '--')) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Province</span>
                                                                <span
                                                                    class="profile-ud-value">{{ ucwords(strtolower($tran->customer->provinceCustomer->name ?? '--')) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-divider divider md"></div>
                                                <div class="nk-block">
                                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                                        <h5 class="title">Note </h5>
                                                    </div>
                                                    <div class="bq-note">
                                                        <div class="bq-note-item">
                                                            @if ($item->admin_note)
                                                                <div class="bq-note-text">
                                                                    {{ $item->admin_note }}
                                                                </div>
                                                            @else
                                                                <div class="bq-note-text">
                                                                    <p>N/A</p>
                                                                </div>
                                                            @endif

                                                            <div class="bq-note-meta">
                                                                <span class="bq-note-added">Added on
                                                                    <span
                                                                        class="date">{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</span>
                                                                    at <span
                                                                        class="time">{{ Carbon\Carbon::parse($item->created_at)->format('H : i') }}
                                                                    </span>
                                                                </span>
                                                                <span class="bq-note-sep sep">|</span>
                                                                <span class="bq-note-by">By <span
                                                                        class="text-primary">{{ $item->created_by }}</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tabItem2">
                                                <div class="nk-block">
                                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                                        <h5 class="title">Visit Information</h5>
                                                    </div>
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Condition</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $item->covisCondition->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Used For</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $item->covisUsedFor->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Road Access</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $item->covisRoadAccess->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Complete Date</span>
                                                                <span
                                                                    class="profile-ud-value">{{ Carbon\Carbon::parse($item->visited_at)->format('d M Y, G:m:i') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Surveyor Note</span>
                                                                @if (!$item->note)
                                                                    <span class="profile-ud-value">N/A</span>
                                                                @else
                                                                    <span
                                                                        class="profile-ud-value">{{ $item->note }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tabItem3">
                                                <div class="nk-fmg-quick-list nk-block">
                                                    <div class="nk-block-head-xs">
                                                        <div class="nk-block-between g-2">
                                                            <div class="nk-block-head-content">
                                                                <h6 class="nk-block-title title">Images / Photo</h6>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="nk-block">
                                                        <div class="row g-gs">

                                                            <div class="col-sm-6 col-lg-6">
                                                                <div class="card card-bordered">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <a href="{{ asset('/images/collateral/' . $item->customer->project->code . '/' . $item->customer->branch->code . '/' . $item->uuid . '/' . $item->transactionImage->photo_front1) }}"
                                                                                target="
                                                                                    _blank">
                                                                                <img src="{{ asset('/images/collateral/' . $item->customer->project->code . '/' . $item->customer->branch->code . '/' . $item->uuid . '/' . $item->transactionImage->photo_front1) }}"
                                                                                    class="zoom">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-1 text-center">
                                                                        <div class="col-sm-4 col-lg-12">
                                                                            <span class="lead-text">Tampak Depan 
                                                                                A </span>
                                                                            <span class="sub-text">
                                                                                {{ Carbon\Carbon::parse($item->visited_at)->format('d, M Y') }}
                                                                                at
                                                                                {{ Carbon\Carbon::parse($item->transactionImage->created_at)->format('H : i') }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-lg-6">
                                                                <div class="card card-bordered">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <a href="{{ asset('/images/collateral/' . $item->customer->project->code . '/' . $item->customer->branch->code . '/' . $item->uuid . '/' . $item->transactionImage->photo_front2) }}"
                                                                                target="
                                                                                    _blank">
                                                                                <img
                                                                                    src="{{ asset('/images/collateral/' . $item->customer->project->code . '/' . $item->customer->branch->code . '/' . $item->uuid . '/' . $item->transactionImage->photo_front2) }}">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-1 text-center">
                                                                        <div class="col-sm-4 col-lg-12">
                                                                            <span class="lead-text">Tampak Depan 
                                                                                B </span>
                                                                            <span class="sub-text">
                                                                                {{ Carbon\Carbon::parse($item->visited_at)->format('d, M Y') }}
                                                                                at
                                                                                {{ Carbon\Carbon::parse($item->transactionImage->created_at)->format('H : i') }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-lg-6">
                                                                <div class="card card-bordered">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <a href="{{ asset('/images/collateral/' . $item->customer->project->code . '/' . $item->customer->branch->code . '/' . $item->uuid . '/' . $item->transactionImage->photo_left) }}"
                                                                                target="
                                                                                    _blank">
                                                                                <img
                                                                                    src="{{ asset('/images/collateral/' . $item->customer->project->code . '/' . $item->customer->branch->code . '/' . $item->uuid . '/' . $item->transactionImage->photo_left) }}">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-1 text-center">
                                                                        <div class="col-lg-12 col-sm-4">
                                                                            <span class="lead-text">Tampak Kiri</span>
                                                                            <span class="sub-text">
                                                                                {{ Carbon\Carbon::parse($item->visited_at)->format('d, M Y') }}
                                                                                at
                                                                                {{ Carbon\Carbon::parse($item->transactionImage->created_at)->format('H : i') }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-lg-6">
                                                                <div class="card card-bordered">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <a href="{{ asset('/images/collateral/' . $item->customer->project->code . '/' . $item->customer->branch->code . '/' . $item->uuid . '/' . $item->transactionImage->photo_right) }}"
                                                                                target="
                                                                                    _blank">
                                                                                <img
                                                                                    src="{{ asset('/images/collateral/' . $item->customer->project->code . '/' . $item->customer->branch->code . '/' . $item->uuid . '/' . $item->transactionImage->photo_right) }}">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-1 text-center">
                                                                        <div class="col-lg-12 col-sm-4">
                                                                            <span class="lead-text">Tampak
                                                                                Kanan</span>
                                                                            <span class="sub-text">
                                                                                {{ Carbon\Carbon::parse($item->visited_at)->format('d, M Y') }}
                                                                                at
                                                                                {{ Carbon\Carbon::parse($item->transactionImage->created_at)->format('H : i') }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-style')
    <style>
    </style>
@endpush
