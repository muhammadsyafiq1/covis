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
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Security Settings</h4>
                                                <div class="nk-block-des">
                                                    <p>These settings are helps you to keep your account secure.</p>
                                                </div>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                    data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="card card-bordered">
                                            <div class="card-inner-group">
                                                <div class="card-inner">
                                                    <div class="between-center flex-wrap g-3">
                                                        <div class="nk-block-text">
                                                            <h6>Change Password</h6>
                                                            <p>Set a unique password to protect your account.</p>
                                                        </div>
                                                        <div class="nk-block-actions flex-shrink-sm-0">
                                                            <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                                                <li class="order-md-last">
                                                                    <a href="#" class="btn btn-primary"
                                                                        class="data-item" data-toggle="modal"
                                                                        data-target="#profile-edit">Change Password</a>
                                                                </li>
                                                                <li>
                                                                    <em class="text-soft text-date fs-12px">Last changed:
                                                                        <span>{{ !Auth::user()->password_updated_at ? Carbon\Carbon::parse(Auth::user()->created_at)->format('M d, Y') : Carbon\Carbon::parse(Auth::user()->password_updated_at)->format('d M, Y') }}</span></em>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div><!-- .card-inner -->
                                            </div><!-- .card-inner-group -->
                                        </div><!-- .card -->
                                    </div><!-- .nk-block -->
                                </div><!-- .card-inner -->
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                                    data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card">
                                                <div class="user-avatar bg-primary">
                                                    <span><img src="images/avatar/{{ Auth::user()->userImage->name }}"
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
                                            </div><!-- .user-card -->
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                            <div class="user-account-info py-0">
                                                <h6 class="overline-title-alt">{{ Auth::user()->company->name }}</h6>
                                                <div class="user-balance"><img src="images/logo/company/absolute.png"
                                                        width="150">
                                                </div>
                                                <div class="user-balance-sub">
                                                    <span>{{ Auth::user()->company->address }}</span>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0">
                                            <ul class="link-list-menu">
                                                <li><a class="" href="{{ route('profile') }}"><em
                                                            class="icon ni ni-user-fill-c"></em><span>Personal
                                                            Information</span></a></li>
                                                <!-- <li><a href="html/user-profile-notification.html"><em class="icon ni ni-bell-fill"></em><span>Notifications</span></a></li> -->
                                                <!-- <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li> -->
                                                <li><a class="active" href="{{ route('change-password') }}"><em
                                                            class="icon ni ni-lock-alt-fill"></em><span>Security
                                                            Settings</span></a></li>
                                                <!-- <li><a href="html/user-profile-social.html"><em class="icon ni ni-grid-add-fill-c"></em><span>Connected with Social</span></a></li> -->
                                            </ul>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- .card-aside -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>

    <!-- @@ Profile Edit Modal @e -->
    <div class="modal fade" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    <h5 class="title">Change Password</h5>
                    <form action="{{ url('post-change-password') }}" method="post" id="change-password-form">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-9">
                                    <label for="" class="label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Input password" required>
                                </div>
                                <div class="col-2 mt-5">
                                    <input type="checkbox" name="" id="visibility-password" onclick="myFunction()">
                                    <span id="view-text" class="ml-2"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <span class="small">
                                        <em>
                                            Passwords must be at least 8 characters & contain three character (#A-z).
                                        </em>
                                    </span>
                                </div>
                            </div>
                            {{-- <div class="input-group mb-1"> --}}
                            {{-- <div class="input-group-append">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="" id="visibility-password" onclick="myFunction()"
                                            required>
                                        <span id="view-text" class="ml-2"></span>
                                    </div>
                                </div> --}}
                            {{-- </div> --}}
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
    <script src="{{ asset('assets/js/libs/jquery.validate.js') }}"></script>
    <script>
        var y = $('#view-text');
        y.text('Show');

        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
                y.text('');
                y.text("Hide");
            } else {
                x.type = "password";
                y.text('');
                y.text("Show");
            }
        }
        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please check your input"
        )

        $('#change-password-form').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 5,
                },
            }
        });
        $('#change-password-form').rules("add", {
            regex: "/^.*[0-9].*$/"
        })

        function thisFileUpload() {
            document.getElementById("file").click();
        }
    </script>
@endpush
