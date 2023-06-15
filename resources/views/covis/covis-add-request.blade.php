@extends('layouts.app')
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Add New Visit Request</h3>
                                <div class="nk-block-des text-soft">
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="{{ url('visit-request') }}"
                                                    class="btn btn-white btn-outline-light"><em
                                                        class="icon ni ni-back-arrow"></em><span>Back</span></a></li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    <div class="components-preview">
                        <div class="nk-block nk-block-lg">
                            <!-- <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">Data Table</h4>
                                            <div class="nk-block-des">
                                                <p>Using the most basic table markup, here’s how <code class="code-class">.table</code> based tables look by default.</p>
                                            </div>
                                        </div>
                                    </div> -->
                            <div class="card card-bordered card-preview">
                                <form action="" method="post">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Client</label>
                                                    <select name="client" id="client" class="form-control">
                                                        <option selected disabled>-- Choose Client ---</option>
                                                        @foreach ($client as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Zone</label>
                                                    <select name="zone" id="zone" class="form-control">
                                                        <option selected disabled>--- Choose Zone ---</option>
                                                        @foreach ($zone as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Branch</label>
                                                    <select name="branch" id="branch" class="form-control">
                                                        <option selected disabled>--- Choose Branch ---</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Account Officer Name</label>
                                                    <input type="text" name="account_officer_name" id="account_officer_name"
                                                        class="form-control" placeholder="Input Account Officer Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Account Officer Mobile No.</label>
                                                    <input type="text" name="account_officer_mobile_no"
                                                        id="account_officer_mobile_no" class="form-control"
                                                        placeholder="Input Account Officer Mobile No.">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Name</label>
                                                    <input type="text" name="name" id="name" class="form-control"
                                                        placeholder="Input Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Collateral Type</label>
                                                    <select name="type_id" id="type_id" class="form-control">
                                                        <option selected disabled>--- Choose Zone ---</option>
                                                        @foreach ($col_type as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Guarantee Address</label>
                                                    <input type="text" name="guarantee_address" id="guarantee_address"
                                                        class="form-control" placeholder="Input Guarantee Address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Province</label>
                                                    <select name="province" id="province"
                                                        class="js-example-basic-single form-control">
                                                        <option selected disabled>--- Choose Province ---</option>
                                                        @foreach ($province as $prov)
                                                            <option value="{{ $prov->code }}">{{ $prov->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">City</label>
                                                    <select name="city_code" id="city_code"
                                                        class="js-example-basic-single form-control">
                                                        <option selected disabled>--- Choose City ---</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">District</label>
                                                    <select name="district_code" id="district_code"
                                                        class="js-example-basic-single form-control">
                                                        <option selected disabled>--- Choose District ---</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Contact Name</label>
                                                    <input type="text" name="contact_name" id="contact_name"
                                                        class="form-control" placeholder="Input Contact Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Contact No</label>
                                                    <input type="text" name="contact_no" id="contact_no"
                                                        class="form-control" placeholder="Input Contact No">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Request Date</label>
                                                    <input type="text" name="request_date" id="request_date"
                                                        data-toggle="datepicker" class="form-control"
                                                        placeholder="Input Request Date">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Termination Date</label>
                                                    <input type="text" name="termination_date" id="termination_date"
                                                        data-toggle="datepicker" class="form-control"
                                                        placeholder="Input Termination Date">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Collateral Class</label>
                                                    <select name="class_id" id="class_id" class="form-control">
                                                        <option selected disabled>--- Choose Class ---</option>
                                                        @foreach ($class as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Priority</label>
                                                    <select name="priority_id" id="priority_id" class="form-control">
                                                        <option selected disabled>--- Choose Priority ---</option>
                                                        @foreach ($priority as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row justify-content-end">
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- .card-preview -->
                        </div> <!-- nk-block -->
                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('addon-script')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            var url = [
                "{{ url('get-branch') }}",
                "{{ url('get-cities') }}",
                "{{ url('get-districts') }}",
            ];

            $('#zone').change(function() {
                var value = $(this).val();

                $.ajax({
                    url: url[0] + '/' + value,
                    type: 'GET',
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                        console.log(thrownError);
                    },
                    success: function(data) {
                        // console.log(data);
                        // $("#kota").show();
                        $("#branch").empty();

                        // console.log()
                        var isEmpty = jQuery.isEmptyObject(data)
                        if (!isEmpty) {
                            $.each(data, function(id, name) {
                                $("#branch")
                                    .prepend(
                                        "<option selected disabled>--- Choose Branch ---</option>"
                                    )
                                    .append(new Option(name, id))
                            })
                        } else {
                            $('#branch')
                                .prepend(
                                    "<option selected disabled>--- Choose Branch ---</option>")
                                .append(
                                    "<option selected disabled>There is no data to display</option>"
                                )
                        }

                    }
                })
            })

            $('#province').change(function() {
                var value = $(this).val();

                $.ajax({
                    url: url[1] + '/' + value,
                    type: 'GET',
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                        console.log(thrownError);
                    },
                    success: function(data) {
                        console.log(data);
                        $("#city_code").empty();
                        $("#city_code").append(
                            "<option selected disabled>--- Choose City ---</option>");

                        // console.log()
                        $.each(data, function(id, name) {
                            $("#city_code").append(new Option(name, id))
                        })
                    }
                })
            })

            $('#city_code').change(function() {
                var value = $(this).val();

                $.ajax({
                    url: url[2] + '/' + value,
                    type: 'GET',
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                        console.log(thrownError);
                    },
                    success: function(data) {
                        console.log(data);
                        $("#district_code").empty();
                        $("#district_code").append(
                            "<option selected disabled>--- Choose City ---</option>");

                        // console.log()
                        $.each(data, function(id, name) {
                            $("#district_code").append(new Option(name, id))
                        })
                    }
                })
            })

            $('[data-toggle="datepicker"]').datepicker({
                format: 'dd-mm-yyyy'
            });
        })
    </script>
@endpush
