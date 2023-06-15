@extends('layouts.app')
@section('content')

    <!-- content -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">

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
                <!-- alert -->

                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Additional Information</h4>
                                                <div class="nk-block-des">
                                                </div>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                    data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Private</h6>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Birth Place</span>
                                                    <span class="data-value">---</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-lock-alt"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Birth Date</span>
                                                    <span class="data-value">---</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-lock-alt"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">E-KTP</span>
                                                    <span class="data-value">{{ $data->userDetail->ektp_no ?? '---' }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-lock-alt"></em></span></div>
                                            </div>
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Address</span>
                                                    <span class="data-value">---</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-lock-alt"></em></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($lastLod)
                                        <div class="nk-block">
                                            <div class="nk-data data-list">
                                                <div class="data-head">
                                                    <h6 class="overline-title">Letter of Duty</h6>
                                                </div>
                                                <div class="data-item" data-toggle="modal" data-target="#lod-modal">
                                                    <div class="data-col">
                                                        <span class="data-label">LOD No.</span>
                                                        <span class="data-value">{{ $lastLod->number }}</span>
                                                    </div>
                                                    <div class="data-col data-col-end"><span class="data-more"><em
                                                                class="icon ni ni-forward-ios"></em></span></div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Start Date</span>
                                                        <span class="data-value">{{ date('d-M-Y',strtotime($lastLod->start_date)) }}</span>
                                                    </div>
                                                    <div class="data-col data-col-end"><span class="data-more"><em
                                                                class="icon ni ni-lock-alt"></em></span></div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">End Date</span>
                                                        <span class="data-value">{{ date('d-M-Y',strtotime($lastLod->end_date)) }}</span>
                                                    </div>
                                                    <div class="data-col data-col-end"><span class="data-more"><em
                                                                class="icon ni ni-lock-alt"></em></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="nk-block">
                                            <div class="nk-data data-list">
                                                <div class="data-head">
                                                    <h6 class="overline-title">Letter of Duty</h6>
                                                </div>
                                                <div class="data-item" data-toggle="modal" data-target="#lod-modal">
                                                    <div class="data-col">
                                                        <span class="data-label">LOD No.</span>
                                                        <span class="data-value">--</span>
                                                    </div>
                                                    <div class="data-col data-col-end"><span class="data-more"><em
                                                                class="icon ni ni-forward-ios"></em></span></div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Start Date</span>
                                                        <span class="data-value">--</span>
                                                    </div>
                                                    <div class="data-col data-col-end"><span class="data-more"><em
                                                                class="icon ni ni-lock-alt"></em></span></div>
                                                </div>
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">End Date</span>
                                                        <span class="data-value">--</span>
                                                    </div>
                                                    <div class="data-col data-col-end"><span class="data-more"><em
                                                                class="icon ni ni-lock-alt"></em></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    
                                </div>
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                                    data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card">
                                                <div class="user-avatar bg-primary">
                                                    <span><img
                                                            src="{{ asset('/images/avatar/' . $data->userImage->name) }}"
                                                            alt=""></span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ $data->name }}</span>
                                                    <span class="sub-text">{{ $data->jobPosition->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-inner">
                                            <div class="user-account-info py-0">
                                                <h6 class="overline-title-alt">{{ $data->company->name }}</h6>
                                                <div class="user-balance"><img
                                                        src="{{ asset('images/logo/company/absolute.png') }}" width="150">
                                                </div>
                                                <div class="user-balance-sub">
                                                    <span>{{ $data->company->address }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-inner p-0">
                                            <ul class="link-list-menu">
                                                <li><a href="{{ route('personnel-view', $data->id) }}"><em
                                                            class="icon ni ni-user-fill-c"></em><span>Personal
                                                            Information</span></a></li>
                                                <li>
                                                    <a class="active" href="#">
                                                        <em class="icon ni ni-lock-alt-fill"></em>
                                                        <span>Additional Information</span>
                                                    </a>
                                                </li>
                                            </ul>
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
    <!-- /content -->

    <!-- modal lod -->
    <div class="modal fade" role="dialog" id="lod-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    <h5 class="title">New LOD</h5>
                    <form action="{{ route('user-lod') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $data->id }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label for="number" class="label mb-0">LOD No.</label>
                                    <input type="text" class="form-control" id="number" name="number" placeholder=""
                                        required autofocus>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="" class="label mb-0">Company</label>
                                    <select class="form-control" name="company_id" id="company_id" required>
                                        <option disabled selected>--- Select ---</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="job_position_id" class="label mb-0">Job Position</label>
                                    <input value="Surveyor" readonly type="text" class="form-control" id="job_position_id" name="job_position_id" required>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="project_id" class="label mb-0">Project / Client</label>
                                    <select class="form-control" name="project_id" id="project_id" required>
                                        <option disabled selected>--- Select ---</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="start_date" class="label mb-0">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                        placeholder="Start Date" required>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="end_date" class="label mb-0">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                        placeholder="End Date" required>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal lod -->

@endsection
