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
                                <h3 class="nk-block-title page-title mb-0">New Customer</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Create your new customer here.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ url('customer-new-table') }}"
                                    class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                        class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="{{ url('customer-new-table') }}"
                                    class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em
                                        class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div>
                    <div class="components-preview">
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <code class="small text-danger">* Field Required</code>
                                    </div>
                                    <form action="{{ url('post-customer') }}" class="gy-3" method="POST">
                                        @csrf
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label" for="">Customer Code<code
                                                            class="ml-1 text-danger">*</code></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" readonly value="{{$code}}" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label" for="">Customer Name<code
                                                            class="ml-1 text-danger">*</code></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="name" id="name"
                                                            placeholder="Input customer name" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">Company<code
                                                            class="ml-1 text-danger">*</code></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select name="company_id" id="company_id" class="form-control"
                                                            required>
                                                            <option disabled selected>--- Select ---</option>
                                                            @foreach ($company as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">Project / Client<code
                                                            class="ml-1 text-danger">*</code></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select name="project_id" id="project_id" class="form-control"
                                                            required>
                                                            <option disabled selected>--- Select ---</option>
                                                            @foreach ($project as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">Region<code
                                                            class="ml-1 text-danger">*</code></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select name="region_id" id="region_id" class="form-control"
                                                            required>
                                                            <option disabled selected>--- Select ---</option>
                                                            @foreach ($region as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">Branch<code
                                                            class="ml-1 text-danger">*</code></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select name="branch_id" id="branch_id" class="form-control"
                                                            required>
                                                            <option disabled selected>--- Select ---</option>
                                                            @foreach ($branch as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">Collateral Type<code
                                                            class="ml-1 text-danger">*</code></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select name="covis_type_id" id="covis_type_id"
                                                            class="form-control" required>
                                                            <option disabled selected>--- Select ---</option>
                                                            @foreach ($type as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">Address<code
                                                            class="ml-1 text-danger">*</code></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="address"
                                                            id="address" placeholder="Input customer address" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">Province<code
                                                            class="ml-1 text-danger">*</code></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select name="province_code" id="province_code"
                                                            class="form-control" required>
                                                            <option disabled selected>--- Select ---</option>
                                                            @foreach ($province as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">City<code
                                                            class="ml-1 text-danger">*</code></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select name="city_code" id="city_code" class="form-control"
                                                            required>
                                                            <option disabled selected>--- Select ---</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">District<code
                                                            class="ml-1 text-danger">*</code></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select name="district_code" id="district_code"
                                                            class="form-control" required>
                                                            <option disabled selected>--- Select ---</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">PIC Name</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="contact_name"
                                                            id="contact_name" placeholder="Input PIC name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">PIC Office No.</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="contact_office_no"
                                                            id="contact_office_no" placeholder="Input PIC office number">
                                                        <div id="notif-phone-office"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">PIC Mobile No.</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="contact_no"
                                                            id="contact_no" placeholder="Input PIC mobile number">
                                                        <div id="notif-phone-pic"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">PIC Second Mobile No.</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="contact_no_second"
                                                            id="contact_no_second"
                                                            placeholder="Input PIC mobile number second">
                                                        <div id="notif-phone-pic-second"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">Account Officer Name</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="ao_name"
                                                            id="ao_name" placeholder="Input Account Officer Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-label">Account Officer Mobile No.</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="ao_no" id="ao_no"
                                                            placeholder="Input Account Officer mobile number">
                                                        <div id="notif-phone-ao"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 justify-content-end">
                                            <div class="col-lg-7">
                                                <div class="form-group mt-2">
                                                    <button type="submit"
                                                        class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content -->

@endsection

@push('prepend-style')
@endpush

@push('addon-script')
    <script>
        $(document).ready(function() {
            var route = [
                "{{ url('get-region') }}",
                "{{ url('get-branch') }}",
                "{{ url('get-cities') }}",
                "{{ url('get-districts') }}",
            ];

            $('#project_id').change(function() {
                var value = $(this).val();

                $.ajax({
                    url: route[0] + '/' + value,
                    type: 'GET',
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                        console.log(thrownError);
                    },
                    success: function(data) {
                        // console.log(data);
                        $("#region_id").empty();

                        $("#region_id").append(
                            `<option disabled selected>--- Select ---</option>`);
                        $.each(data, function(id, name) {
                            // console.log(name);
                            $("#region_id").append(new Option(name, id));
                        })

                    }
                })
            })

            $('#region_id').change(function() {
                var value = $(this).val();

                $.ajax({
                    url: route[1] + '/' + value,
                    type: 'GET',
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                        console.log(thrownError);
                    },
                    success: function(data) {
                        // console.log(data);
                        // $("#id_city").show();
                        $("#branch_id").empty();

                        $("#branch_id").append(
                            `<option disabled selected>--- Select ---</option>`);
                        $.each(data, function(id, name) {
                            // console.log(name);
                            $("#branch_id").append(new Option(name, id));
                        })

                    }
                })
            })

            $('#province_code').change(function() {
                var value = $(this).val();

                $.ajax({
                    url: route[2] + '/' + value,
                    type: 'GET',
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                        console.log(thrownError);
                    },
                    success: function(data) {
                        console.log(data);
                        // $("#id_city").show();
                        $("#city_code").empty();

                        $("#city_code").append(
                            `<option disabled selected>--- Select ---</option>`);
                        $.each(data, function(id, name) {
                            // console.log(name);
                            $("#city_code").append(new Option(name, id));
                        })

                    }
                })
            })

            $('#city_code').change(function() {
                var value = $(this).val();

                $.ajax({
                    url: route[3] + '/' + value,
                    type: 'GET',
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                        console.log(thrownError);
                    },
                    success: function(data) {
                        console.log(data);
                        // $("#id_city").show();
                        $("#district_code").empty();

                        $("#district_code").append(
                            `<option disabled selected>--- Select ---</option>`);
                        $.each(data, function(id, name) {
                            console.log(name);
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

            $('#contact_office_no').on('keyup', function() {
                var number = $(this).val()
                let start_with = number.startsWith(0, 0);

                if (start_with == true) {
                    $('#notif-phone-office').html(`
                        <small class="text-danger"> <em> No need to input the number 0! </em> </small>
                    `);
                    $('#contact_office_no').val("")

                } else {
                    // console.log('salah');
                    $('#notif-phone-office').html("");
                }

            });

            $('#contact_no_second').on('keyup', function() {
                var number = $(this).val()
                let start_with = number.startsWith(0, 0);

                if (start_with == true) {
                    $('#notif-phone-pic-second').html(`
                        <small class="text-danger"> <em> No need to input the number 0! </em> </small>
                    `);
                    $('#contact_no_second').val("")

                } else {
                    // console.log('salah');
                    $('#notif-phone-pic-second').html("");
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
@endpush
