@extends('layouts.app')
@section('content')

    <!-- content -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    <!-- block -->
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
                                            <div class="nk-block-head-content">
                                                <a href="{{ route('setting-user') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- alert -->
                                    @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <div class="alert-body">
                                            {{ $message }}
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @elseif ($message = Session::get('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <div class="alert-body">
                                            {{ $message }}
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    <!-- /alert -->

                                    <!-- password button -->
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
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /password button -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->

                </div>
            </div>
        </div>
    </div>
    <!-- /content -->

    <!-- modal change password -->
    <div class="modal fade" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    <h5 class="title">Change Password</h5>
                    <form action="{{ route('post-password-set-user', encrypt($data->id)) }}" method="post" id="change-password-form">
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
    <!-- /modal change password -->
    
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
    </script>
@endpush
