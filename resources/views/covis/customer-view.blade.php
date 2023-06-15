@extends('layouts.app')
@section('content')

    <!-- content -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><strong
                                        class="text-primary small">{{ $customer->name }}</strong></h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>Customer Code: <span class="text-base">{{ $customer->code }}</span></li>
                                        <li>Client: <span class="text-base">{{ $customer->project->name }}</span>
                                        </li>
                                    </ul>
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
                                                    class="icon ni ni-file-text"></em><span>Documents</span></a>
                                        </li>
                                        <li class="nav-item nav-item-trigger d-xxl-none">
                                            <a href="#" class="toggle btn btn-icon btn-trigger" data-target="userAside"><em
                                                    class="icon ni ni-user-list-fill"></em></a>
                                        </li>
                                    </ul>
                                    <div class="card-inner">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tabItem1">
                                                <div class="nk-block">
                                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                                        <h5 class="title">Customer Information</h5>
                                                        <a href="#" class="toggle link link-sm"
                                                            data-target="info-modal">Edit Information</a>
                                                    </div>
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Branch</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $customer->branch->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Region</span>
                                                                <span class="profile-ud-value">{{ $customer->region->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Collateral Type</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $customer->covisType->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Termination Date</span>
                                                                <span
                                                                    class="profile-ud-value">{{ Carbon\Carbon::parse($customer->termination_date)->format('d M, Y') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">PIC Name</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $customer->contact_name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Mobile No.</span>
                                                                <span
                                                                    class="profile-ud-value"><a href="tel:{{ '+62 ' . $customer->contact_no }}">{{ '+62 ' . $customer->contact_no }}</a></span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">AO Name</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $customer->ao_name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Account Officer No.</span>
                                                                <span
                                                                    class="profile-ud-value"><a href="tel:{{ '+62 ' . $customer->ao_no }}">{{ '+62 ' . $customer->ao_no }}</a></span>
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
                                                                <span class="profile-ud-value">
                                                                    {{ $customer->address }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">District</span>
                                                                <span
                                                                    class="profile-ud-value">{{ !$customer->district_code ? '---' : ucwords(strtolower($customer->districtCustomer->name)) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">City</span>
                                                                <span
                                                                    class="profile-ud-value">{{ !$customer->district_code ? '---' : ucwords(strtolower($customer->cityCustomer->name)) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Province</span>
                                                                <span
                                                                    class="profile-ud-value">{{ !$customer->district_code ? '---' : ucwords(strtolower($customer->provinceCustomer->name)) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-divider divider md"></div>
                                                <div class="nk-block trigger-div">
                                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                                        <h5 class="title">Admin Note</h5>
                                                        <a 
                                                            href="#" 
                                                            data-id="{{$customer->id}}"
                                                            class="toggle link link-sm btn-activated-deactivated"
                                                            data-target="note-modal">
                                                            Edit Note
                                                        </a>
                                                    </div>
                                                    <div class="bq-note">
                                                        <div class="bq-note-item">
                                                            <div class="bq-note-text">
                                                                <p>{{ $customer->note ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="bq-note-meta">
                                                                <span class="bq-note-added">Added on <span
                                                                        class="date">{{ Carbon\Carbon::parse($customer->updated_at)->format('d M, Y') }}</span>
                                                                    at
                                                                    <span
                                                                        class="time">{{ Carbon\Carbon::parse($customer->updated_at)->format('H.i') }}</span></span>
                                                                <span class="bq-note-sep sep">|</span>
                                                                <span class="bq-note-by">By <span
                                                                        class="text-primary">{{ $customer->created_by }}</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabItem2">
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
                                                            @forelse ($transactionCustomer as $data)
                                                                <div class="col-sm-6 col-lg-3">
                                                                    <div class="gallery card card-bordered">
                                                                        <div
                                                                            class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                                                            <div class="user-card">
                                                                                <div class="user-avatar">
                                                                                    <img src="{{ asset('/images/collateral/' . $data->customer->project->code . '/' . $data->customer->branch->code . '/' . $data->uuid . '/' . $data->transactionImage->photo_front1) }}" alt="">
                                                                                </div>
                                                                                <div class="user-info">
                                                                                    <span class="lead-text">Tampak Depan
                                                                                        (1)</span>
                                                                                    <span class="sub-text">Oct 3, 2022 at
                                                                                        9:30 PM</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 col-lg-3">
                                                                    <div class="gallery card card-bordered">
                                                                        <div
                                                                            class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                                                            <div class="user-card">
                                                                                <div class="user-avatar">
                                                                                    <img src="{{ asset('/images/collateral/' . $data->customer->project->code . '/' . $data->customer->branch->code . '/' . $data->uuid . '/' . $data->transactionImage->photo_front2) }}" alt="">
                                                                                </div>
                                                                                <div class="user-info">
                                                                                    <span class="lead-text">Tampak Depan
                                                                                        (2)</span>
                                                                                    <span class="sub-text">Oct 3, 2022 at
                                                                                        9:30 PM</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 col-lg-3">
                                                                    <div class="gallery card card-bordered">
                                                                        <div
                                                                            class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                                                            <div class="user-card">
                                                                                <div class="user-avatar">
                                                                                    <img src="{{ asset('/images/collateral/' . $data->customer->project->code . '/' . $data->customer->branch->code . '/' . $data->uuid . '/' . $data->transactionImage->photo_right) }}" alt="">
                                                                                </div>
                                                                                <div class="user-info">
                                                                                    <span class="lead-text">Tampak Kanan</span>
                                                                                    <span class="sub-text">Oct 3, 2022 at
                                                                                        9:30 PM</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 col-lg-3">
                                                                    <div class="gallery card card-bordered">
                                                                        <div
                                                                            class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                                                            <div class="user-card">
                                                                                <div class="user-avatar">
                                                                                    <img src="{{ asset('/images/collateral/' . $data->customer->project->code . '/' . $data->customer->branch->code . '/' . $data->uuid . '/' . $data->transactionImage->photo_left) }}" alt="">
                                                                                </div>
                                                                                <div class="user-info">
                                                                                    <span class="lead-text">Tampak Kiri</span>
                                                                                    <span class="sub-text">Oct 3, 2022 at
                                                                                        9:30 PM</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <div class="row">
                                                                    <div class="col-12 text-center">
                                                                        <p>Data not Found</p>
                                                                    </div>
                                                                </div>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- modal -->
                                <div class="card-aside card-aside-right user-aside toggle-slide toggle-slide-right toggle-break-xxl"
                                    data-content="userAside" data-toggle-screen="xxl" data-toggle-overlay="true"
                                    data-toggle-body="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card user-card-s2">
                                                <div class="user-avatar lg bg-primary">
                                                    <span><em class="icon ni ni-camera"></em></span>
                                                </div>
                                                <div class="user-info">
                                                    <div class="badge badge-outline-light badge-pill ucap">Customer</div>
                                                    <h5>{{ $customer->name }}</h5>
                                                    <span class="sub-text">{{ $customer->project->code }}
                                                        {{ $customer->branch->name }}</span>
                                                    <span class="sub-text">{{ $customer->region->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-inner">
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">{{ $totalOrder }}</span>
                                                        <span class="sub-text">Total Order</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">{{ $totalOrderCompleted }}</span>
                                                        <span class="sub-text">Complete</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">{{ $totalOrderInProgress }}</span>
                                                        <span class="sub-text">Progress</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-inner">
                                            <h6 class="overline-title-alt mb-2">Additional</h6>
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <span class="sub-text">Customer Code:</span>
                                                    <span>{{ $customer->code }}</span>
                                                </div>
                                                {{-- <div class="col-6">adde
                                                    <span class="sub-text">Termination Date:</span>
                                                    <span>{{ Carbon\Carbon::parse($customer->termination_date)->format('d M Y') }}</span>
                                                </div> --}}
                                                <div class="col-6">
                                                    <span class="sub-text">Register At:</span>
                                                    <span>{{ Carbon\Carbon::parse($customer->created_at)->format('d M Y') }}</span>
                                                </div>
                                                {{-- <div class="col-6">
                                                    <span class="sub-text">Updated At:</span>
                                                    <span>{{ Carbon\Carbon::parse($customer->updated_at)->format('d M Y') }}</span>
                                                </div> --}}
                                                <div class="col-6">
                                                    <span class="sub-text">Register By:</span>
                                                    <span>{{ $customer->created_by }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /modal -->

                                <!-- modal info -->
                                <div class="nk-add-product toggle-slide toggle-slide-right" data-content="info-modal"
                                    data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true"
                                    data-simplebar>
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">New Customer Information</h5>
                                            <div class="nk-block-des">
                                                <p class="small text-danger">* Required</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <form action="{{ url('update-customer', $customer->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="branch">Branch Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control"
                                                                value="{{ $customer->branch->name }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="code">Code</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control"
                                                                value="{{ $customer->code }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="region">Region</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $customer->region->name }}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="type">Type</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $customer->covisType->name }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="termination_date">Termination
                                                            Date</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control"
                                                                    value="{{ Carbon\Carbon::parse($customer->termination_date)->format('d M Y') }}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="contact_name">Name <span
                                                                class="text-danger ml-1">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ old('name') ? old('name') : $customer->name }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="contact_name">PIC Name <span
                                                                class="text-danger ml-1">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="contact_name"
                                                                name="contact_name" value="{{ old('contact_name') ? old('contact_name') : $customer->contact_name }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="contact_no">PIC Office No</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="contact_office_no"
                                                                name="contact_office_no"
                                                                value="{{ str_replace('+62 ', '', str_replace('-', '', $customer->contact_office_no)) }}">
                                                            <div id="notif-phone-pic"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="contact_no">PIC Mobile No</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="contact_no"
                                                                name="contact_no"
                                                                value="{{ str_replace('+62 ', '', str_replace('-', '', $customer->contact_no)) }}">
                                                            <div id="notif-phone-pic"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="ao_name">AO Name <span
                                                                class="text-danger ml-1">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="ao_name"
                                                                name="ao_name" value="{{old('ao_name') ? old('ao_name') : $customer->ao_name }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="ao_no">AO Mobile No</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="ao_no"
                                                                name="ao_no"
                                                                value="{{ str_replace('+62 ', '', str_replace('-', '', $customer->ao_no)) }}"
                                                                >
                                                            <div id="notif-phone-ao"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="address">Address <span
                                                                class="text-danger ml-1">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="address"
                                                                name="address" value="{{ old('address') ? old('address') : $customer->address }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="province">Province <span
                                                                class="text-danger ml-1">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-control-wrap">
                                                                <select class="form-control" name="province_code"
                                                                    id="province_code">
                                                                    <option disabled selected>--- Select ---</option>
                                                                    @foreach ($province as $key => $value)
                                                                        @if ($key == $customer->province_code)
                                                                            <option value="{{ $key }}" selected>
                                                                                {{ $value }}</option>
                                                                        @else
                                                                            <option value="{{ $key }}">
                                                                                {{ $value }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="city">City <span
                                                                class="text-danger ml-1">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-control" name="city_code" id="city_code">
                                                                <option disabled selected>--- Select ---</option>
                                                                @foreach ($city as $key => $value)
                                                                    @if ($key == $customer->city_code)
                                                                        <option value="{{ $key }}" selected>
                                                                            {{ $value }}</option>
                                                                    @else
                                                                        <option value="{{ $key }}">
                                                                            {{ $value }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="district">District <span
                                                                class="text-danger ml-1">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-control-wrap">
                                                                <select class="form-control" name="district_code"
                                                                    id="district_code">
                                                                    <option disabled selected>--- Select ---</option>
                                                                    @foreach ($district as $key => $value)
                                                                        @if ($key == $customer->district_code)
                                                                            <option value="{{ $key }}" selected>
                                                                                {{ $value }}</option>
                                                                        @else
                                                                            <option value="{{ $key }}">
                                                                                {{ $value }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-primary"
                                                        type="submit"><span>Save</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /modal info -->

                                <!-- modal note -->
                                <div class="nk-add-product toggle-slide toggle-slide-right" data-content="note-modal"
                                    data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true"
                                    data-simplebar>
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">New Note</h5>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <form action="{{ route('update-note-customer') }}" method="POST">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control" id="note" name="note" rows="10" required></textarea>
                                                            <input type="hidden"  name="idCustomer" value="{{$customer->id}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-primary"
                                                        type="submit"><span>Save</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /modal note -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content -->

@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            var route = [
                "{{ url('get-cities') }}",
                "{{ url('get-districts') }}",
            ];

            $('#province_code').change(function() {
                var value = $(this).val();
                $('#city_code').empty();
                // $('#city_code').append(`<option disabled selected>--- Select ---</option>`);
                $('#district_code').empty();
                $('#district_code').append(`<option disabled selected>--- Select ---</option>`);

                $.ajax({
                    url: route[0] + '/' + value,
                    type: 'GET',
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                        console.log(thrownError);
                    },
                    success: function(data) {
                        $("#city_code").append(
                            `<option disabled selected>--- Select ---</option>`);
                        $.each(data, function(code, name) {
                            $("#city_code").append(new Option(name, code));
                        })
                    }
                })
            })

            $('#city_code').change(function() {
                var value = $(this).val();

                $('#district_code').empty();
                $.ajax({
                    url: route[1] + '/' + value,
                    type: "GET",
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                        console.log(thrownError);
                    },
                    success: function(data) {
                        $("#district_code").append(
                            `<option disabled selected>--- Select ---</option>`);
                        $.each(data, function(id, name) {
                            $("#district_code").append("<option value='"+name+"'>"+id+"</option>");
                        })
                    }
                })
            })

            $('#contact_no').on('keyup', function() {
                var number = $(this).val()
                let start_with = number.startsWith(0, 0);

                if (start_with == true) {
                    $('#notif-phone-pic').html(`
                        <small class="text-danger"> <em> No need to input the number 0! </em> </small>
                    `);
                    $('#contact_no').val("")

                } else {
                    // console.log('salah');
                    $('#notif-phone-pic').html("");
                }

            });

            $('#ao_no').on('keyup', function() {
                var number = $(this).val()
                let start_with = number.startsWith(0, 0);

                if (start_with == true) {
                    $('#notif-phone-ao').html(`
                        <small class="text-danger"> <em> No need to input the number 0! </em> </small>
                    `);
                    $('#ao_no').val("")

                } else {
                    // console.log('salah');
                    $('#notif-phone-ao').html("");
                }

            });
        })
    </script>

    <script>
        $('.trigger-div').on('click','.btn-activated-deactivated', function(){
            let id = $(this).data('id');
            $('.id').val(id);
        })
    </script>
@endpush
