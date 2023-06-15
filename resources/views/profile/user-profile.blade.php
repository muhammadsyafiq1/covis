@extends('layouts.app')
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- BEGIN: Alert -->
                    @if ($message = Session::get('success'))
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <div class="alert-body text-center">
                                            {{ $message }}
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            {{-- <span aria-hidden="true">&times;</span> --}}
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @elseif ($message = Session::get('error'))
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <div class="alert-body text-center">
                                            {{ $message }}
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            {{-- <span aria-hidden="true">&times;</span> --}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- END: Alert -->

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Personal Information</h4>
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
                                                <h6 class="overline-title">Basics</h6>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Full Name</span>
                                                    <span class="data-value">{{ Auth::user()->name }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-lock-alt"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">User ID</span>
                                                    <span class="data-value">{{ Auth::user()->nip }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-lock-alt"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Email</span>
                                                    <span class="data-value">{{ Auth::user()->email }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-lock-alt"></em></span></div>
                                            </div>
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Mobile No.</span>
                                                    <span class="data-value">{{ Auth::user()->mobile_no }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Job Position</span>
                                                    <span
                                                        class="data-value">{{ Auth::user()->jobPosition->name }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-lock-alt"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Role</span>
                                                    <span class="data-value">
                                                        {{ Auth::user()->user_role->name }}
                                                    </span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-lock-alt"></em></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                                    data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card">
                                                <div class="user-avatar bg-primary">
                                                    <span><img
                                                            src="{{ asset('images/avatar/' . auth()->user()->userImage->name) }}"
                                                            alt=""></span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ Auth::user()->name }}</span>
                                                    <span
                                                        class="sub-text">{{ Auth::user()->jobPosition->name }}</span>
                                                </div>
                                                <div class="user-action">
                                                    <div class="dropdown">
                                                        <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown"
                                                            href="#"><em class="icon ni ni-more-v"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li>
                                                                    <form action="{{ route('update-profil-image') }}"
                                                                        enctype="multipart/form-data" method="POST">
                                                                        @csrf
                                                                        @error('foto')
                                                                            <span class="invalid-feedback">
                                                                                <div class="alert alert-danger">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            </span>
                                                                        @enderror
                                                                        <input name="foto" type="file" id="file"
                                                                            style="display: none;" onchange="form.submit()">

                                                                        <a onclick="thisFileUpload()" type="button">
                                                                            <em class="icon ni ni-camera-fill"></em>
                                                                            <span>Change Photo</span>
                                                                        </a>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-inner">
                                            <div class="user-account-info py-0">
                                                <h6 class="overline-title-alt">{{ Auth::user()->company->name }}</h6>
                                                <div class="user-balance"><img src="images/logo/company/absolute.png"
                                                        width="150"></div>
                                                <div class="user-balance-sub">
                                                    <span>{{ Auth::user()->company->address }}</span>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0">
                                            <ul class="link-list-menu">
                                                <li><a class="active" href="{{ url('profile') }}"><em
                                                            class="icon ni ni-user-fill-c"></em><span>Personal
                                                            Information</span></a></li>
                                                <!-- <li><a href="html/user-profile-notification.html"><em class="icon ni ni-bell-fill"></em><span>Notifications</span></a></li> -->
                                                <!-- <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li> -->
                                                <li>
                                                    <a href="{{ url('change-password') }}">
                                                        <em class="icon ni ni-lock-alt-fill"></em>
                                                        <span>Security Settings</span>
                                                    </a>
                                                </li>
                                                <!-- <li><a href="html/user-profile-social.html"><em class="icon ni ni-grid-add-fill-c"></em><span>Connected with Social</span></a></li> -->
                                            </ul>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- card-aside -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    <h5 class="title mb-0">Update Mobile No.</h5>
                    <form action="{{ url('update-phone') }}" method="post" id="change-password-form">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label for="" class="label">New Mobile No.</label>
                                    <input type="text" class="form-control phone-formatter" id="phone" name="phone"
                                        placeholder="Input mobile number" required autofocus>
                                    <div id="notif-phone"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </div>
                    </form>
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#phone').on('keyup', function() {
                var number = $(this).val()
                let start_with = number.startsWith(0, 0);

                if (start_with == true) {
                    $('#notif-phone').html(`
                        <small class="text-danger"> <em> No need to input the number 0! </em> </small>
                    `);
                    $('#phone').val("")

                } else {
                    // console.log('salah');
                    $('#notif-phone').html("");
                }

            });
        })

        function thisFileUpload() {
            document.getElementById("file").click();
        }
    </script>
@endpush
