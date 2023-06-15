@extends('layouts.app')
@section('content')

    @if (Auth::user()->user_role_id > 4)
        @include('errors.forbidden')
    @else

    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><strong
                                        class="text-primary small">{{ $transaction->customer->name }}</strong></h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>Customer Code: <span class="text-base">{{ $transaction->customer->code }}</span></li>
                                        <li>Client: <span class="text-base">{{ $transaction->customer->project->name }}</span>
                                        </li>
                                    </ul>
                                </div>
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
                                                    </div>
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Branch</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $transaction->customer->branch->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Region</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $transaction->customer->region->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Collateral Type</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $transaction->customer->covisType->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Termination Date</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $transaction->termination_date }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">PIC Name</span>
                                                                <span class="profile-ud-value">{{ $transaction->customer->contact_name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Mobile No.</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $transaction->customer->contact_no }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">AO Name</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $transaction->customer->ao_name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Mobile No.</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $transaction->customer->ao_no }}</span>
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
                                                                    class="profile-ud-value">{{ ucwords(strtolower($transaction->customer->address)) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">District</span>
                                                                <span
                                                                    class="profile-ud-value">{{ !$transaction->customer->district_code ? '---' : ucwords(strtolower($transaction->customer->districtCustomer->name)) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="profile-ud-list">
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">City</span>
                                                                <span
                                                                    class="profile-ud-value">{{ !$transaction->customer->city_code ? '---' : ucwords(strtolower($transaction->customer->cityCustomer->name)) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Province</span>
                                                                <span
                                                                    class="profile-ud-value">{{ !$transaction->customer->province_code ? '---' : ucwords(strtolower($transaction->customer->provinceCustomer->name)) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-divider divider md"></div>
                                                <div class="nk-block">
                                                    <div class="nk-block-head nk-block-head-sm nk-block-between trigger-div">
                                                        <h5 class="title">Admin Note</h5>
                                                    </div>
                                                    <div class="bq-note">
                                                        <div class="bq-note-item">
                                                            <div class="bq-note-text">
                                                                <p>{{ $customerTransaction->admin_note ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="bq-note-meta">
                                                                <span class="bq-note-added">Added on <span
                                                                        class="date">{{ Carbon\Carbon::parse($transaction->customer->updated_at)->format('d M, Y') }}</span>
                                                                    at
                                                                    <span
                                                                        class="time">{{ Carbon\Carbon::parse($transaction->customer->updated_at)->format('H.i') }}</span></span>
                                                                <span class="bq-note-sep sep">|</span>
                                                                <span class="bq-note-by">By <span
                                                                        class="text-primary">{{ $transaction->created_by }}</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
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
                                                    <h5>{{ $transaction->customer->name }}</h5>
                                                    <span
                                                        class="sub-text">{{ $transaction->customer->project->name }}</span>
                                                    <span
                                                        class="sub-text">{{ $transaction->customer->region->name }}</span>
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
                                                    <span>{{ $transaction->customer->code }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="sub-text">Register At:</span>
                                                    <span>{{ Carbon\Carbon::parse($transaction->customer->created_at)->format('d M Y') }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="sub-text">Register By:</span>
                                                    <span>{{ $transaction->customer->created_by }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Edit Info -->
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
                                        <form action="{{ url('update-customer', $transaction->customer->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="branch">Branch Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control"
                                                                value="{{ $transaction->customer->branch->name }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="code">Code</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control"
                                                                value="{{ $transaction->customer->code }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="region">Region</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control"
                                                                    value="Kanwil {{ $transaction->customer->region->name }}"
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
                                                                    value="{{ $transaction->customer->covisType->name }}" readonly>
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
                                                                    value="{{ Carbon\Carbon::parse($transaction->customer->termination_date)->format('d M Y') }}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="contact_name">PIC Name <span
                                                                class="text-danger ml-1">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="contact_name"
                                                                name="contact_name" value="{{ $transaction->customer->contact_name }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="contact_no">PIC Mobile No. <span
                                                                class="text-danger ml-1">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="contact_no"
                                                                name="contact_no"
                                                                value="{{ str_replace('+62', '', str_replace('-', '', $transaction->customer->contact_no)) }}"
                                                                required>
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
                                                                name="ao_name" value="{{ $transaction->customer->ao_name }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="ao_no">AO Mobile No. <span
                                                                class="text-danger ml-1">*</span></label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="ao_no"
                                                                name="ao_no"
                                                                value="{{ str_replace('+62', '', str_replace('-', '', $transaction->customer->ao_no)) }}"
                                                                required>
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
                                                                name="address" value="{{ $transaction->customer->address }}" required>
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
                                                                        @if ($key == $transaction->customer->province_code)
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
                                                                    @if ($key == $transaction->customer->city_code)
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
                                                                        @if ($key == $transaction->customer->district_code)
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

                                <!-- Modal Edit Note -->
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
                                                            <input type="hidden" id="id" class="id" name="id">
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
    
@endsection
