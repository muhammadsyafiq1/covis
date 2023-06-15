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
                                <h3 class="nk-block-title page-title mb-0">Customer Data</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{ $customer }} data.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-primary"
                                                        data-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="{{ url('customer-new') }}"><span>Add New
                                                                        Customer</span></a></li>
                                                            <li><a href="{{ url('customer-new-import') }}"><span>Import
                                                                        New Customer & Order Transaction</span></a></li>
                                                            <li><a href="{{ url('order-new-import') }}"><span>Import
                                                                New Order Transaction</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                        </ul>
                                    </div>
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

                    <!-- datatable -->
                    <div class="components-preview">
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <form method="POST" action="{{ url('test') }}">
                                        @csrf
                                        <table class="nk-tb-list nk-tb-ulist" id="customer-table" data-export-title="Export">
                                            <thead>
                                                <tr class="nk-tb-item nk-tb-head">
                                                    <!--<th class="nk-tb-col"><span class="sub-text">ID Customer</span>-->
                                                    <!--<th class="nk-tb-col"><input type="checkbox"id="master" class="ml-4"></th>-->
                                                    <th class="nk-tb-col"><span class="sub-text">Customer Name</span>
                                                    </th>
                                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Mode</span>
                                                    </th>
                                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Region</span>
                                                    </th>
                                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type</span>
                                                    </th>
                                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Address</span>
                                                    </th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">PIC /
                                                            Contact</span></th>
                                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Account
                                                            Officer</span></th>
                                                    <th class="nk-tb-col nk-tb-col-tools text-right"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        {{-- <div class="row justify-content-end">
                                            <div class="col-2">
                                                <div class="btn-wrap" id="next-container">
                                                    <span class="d-none d-md-block">
                                                        <button
                                                            class="btn btn-block btn-primary delete_all" type="submit"
                                                            id="btn_confirm">Confirm</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div> --}}
                                            
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /datatable -->

                </div>
            </div>
        </div>
    </div>
    <!-- /content -->

    <!-- modal order -->
    <div class="modal right fade" id="order-modal" tabindex="-1" aria-labelledby="order-modalLabel" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="modal-title">Order / Request</h5>
                            <code class="small text-danger">* Required</code>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <form action="{{ url('post-customer-request') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <input type="hidden" name="covis_customer_id" id="covis_customer_id">
                                        <input type="hidden" name="covis_customer_branch_id" id="covis_customer_branch_id">
                                        <div class="form-group">
                                            <label class="form-label" for="user_id">Assigned To <code
                                                    class="text-danger ml-1">*</code></label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="user_id" name="user_id" required>
                                                    <option disabled selected>--- Select ---</option>
                                                    @foreach ($surveyor as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="covis_class_id">Classification <code
                                                    class="text-danger ml-1">*</code></label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="covis_class_id" name="covis_class_id"
                                                    required>
                                                    <option disabled selected>--- Select ---</option>
                                                    @foreach ($classification as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="covis_priority_id">Priority <code
                                                    class="text-danger ml-1">*</code></label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="covis_priority_id"
                                                    name="covis_priority_id" required>
                                                    <option disabled selected>--- Select ---</option>
                                                    @foreach ($priority as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="termination_date">Termination Date <code
                                                    class="text-danger ml-1">*</code></label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control datepicker" id="termination_date"
                                                    name="termination_date" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="col-12">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label class="form-label" for="backdate">Backdate <span class="badge rounded-pill badge-primary">New</span> </label>-->
                                    <!--        <div class="form-control-wrap">-->
                                    <!--            <input type="date" class="form-control" id="backdate"-->
                                    <!--                name="backdate"  autocomplete="off">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="col-12">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label class="form-label" for="nextdate">Nextdate  <span class="badge rounded-pill  badge-primary">New</span> </label>-->
                                    <!--        <div class="form-control-wrap">-->
                                    <!--            <input type="text" class="form-control datepicker" id="nextdate"-->
                                    <!--                name="nextdate"  autocomplete="off">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="admin_note">Note <code
                                                    class="text-danger ml-1">*</code></label>
                                            <div class="form-control-wrap">
                                                <textarea class="form-control" id="admin_note"
                                                    name="admin_note" rows="3" required autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary btn-block"
                                            type="submit"><span>Submit</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal right fade" id="delete-modal" tabindex="-1" aria-labelledby="order-modalLabel" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p class="mt-4 modal-title">Are you sure delete this Customer ? </p>
                            <span id="name"></span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <form action="{{url('customer-delete')}}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="hidden" name="covis_customer_id" id="covis_customer_id">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary btn-block"
                                            type="submit"><span>Delete</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#order-modal').on('show.bs.modal', function(event) {
                var div = $(event.relatedTarget);
                var modal = $(this);

                modal.find('#covis_customer_id').attr("value", div.data('id'));
                modal.find('#covis_customer_branch_id').attr("value", div.data('branch'));
            })
            
            $('#delete-modal').on('show.bs.modal', function(event) {
                var div = $(event.relatedTarget);
                var modal = $(this);

                modal.find('#covis_customer_id').attr("value", div.data('id'));
            })
            
            $('#delete-modal').on('show.bs.modal', function(event) {
                var div = $(event.relatedTarget);
                var modal = $(this);
                modal.find('#name').html(div.data('name'));
            })
            
             $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });
        })

        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            
            $('#customer-table').DataTable({
                dom: '<"row justify-between g-2"<"col-7 col-sm-4 text-start"<"dt-export-buttons d-flex align-center"<"d-none d-md-inline-block">B>><"col-5 col-sm-8 text-start"<"datatable-filter"<"d-flex justify-content-end g-2"lf>>>><"datatable-wrap my-3"tr><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-start text-md-end"i>>',
                pageLength: 25,
                lengthMenu: [
                    [10, 25, 50, 100], [10, 25, 50, 100]
                ],
                ordering: false,
                searching: true,
                language: {
                    search: "",
                    searchPlaceholder: "Type in to Search",
                    lengthMenu: "<span class='d-none d-sm-inline-block'>Show</span><div class='form-control-select'> _MENU_ </div>",
                    info: "_START_ -_END_ of _TOTAL_",
                    infoEmpty: "No records found",
                    infoFiltered: "( Total _MAX_  )",
                    paginate: {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Prev"
                    },
                },
                processing: true,
                serverSide: true,
                ajax: "{{ url('list-customer-json') }}",
                deferRender: true,
                createdRow: function(row) {
                    $(row).addClass( 'nk-tb-item' );
                },
                columns: [
                    // {data: null, className: 'nk-tb-col',
                    //     render: function(data, type, row, meta){
                    //         return'<td>'+row.customer_id+'</td>';
                    //     }
                    // },
                    // {data: null, className: 'nk-tb-col',
                    //     render: function(data, type, row, meta){
                    //         return'<td class="nk-tb-col"><input type="checkbox" class="sub_chk ml-4 checkboxInput" value="'+row.customer_id+'" name="id[]"></td>';
                    //     }
                    // },
                    {data: null, className: 'nk-tb-col',
                        render: function(data, type, row, meta) {
                            return '<div class="user-card"><div class="user-avatar bg-dim-primary d-none d-sm-flex"><span>'+row.code+'</span></div><div class="user-info"><span class="tb-lead">'+row.name+'<span class="dot dot-success d-md-none ml-1"></span></span><span>'+row.project_code+' '+row.branch_name+'</span></div></div>';
                        },name:'name'
                    },
                    {data: null, className: 'nk-tb-col tb-col-lg',
                        render: function(data, type, row, meta) {
                            return '<span class="tb-lead">'+row.region_name+'</span>';
                        },
                    },
                    {data: null, className: 'nk-tb-col tb-col-mb',
                        render: function(data, type, row, meta) {

                            return '<div class="user-card"><div class="user-info"><span class="tb-lead">'+row.type_name+'<span class="dot dot-success d-md-none ml-1"></span></span><span>' + row.district_name + ', ' + row.city_name + '</span></div></div>';
                        },name:'type_name'
                    },
                    {data: null, className: 'nk-tb-col tb-col-mb',
                        render: function(data, type, row, meta) {
                            return '<span class="tb-lead">'+row.address+'</span>';
                        },
                    },
                    {data: null, className: 'nk-tb-col tb-col-md',
                        render: function(data, type, row, meta) {
                            if(row.contact_no == null){
                                return '<div class="user-card"><div class="user-info"><span class="tb-lead">'+row.contact_name+'<span class="dot dot-success d-md-none ml-1"></span></span><span>N/A</span></div></div>';
                            }else{
                                return '<div class="user-card"><div class="user-info"><span class="tb-lead">'+row.contact_name+'<span class="dot dot-success d-md-none ml-1"></span></span><span>'+row.contact_no+'</span></div></div>';
                            }
                            
                        },
                    },
                    {data: null, className: 'nk-tb-col tb-col-lg',
                        render: function(data, type, row, meta) {
                            
                           
                            
                            if(row.ao_no == null){
                                return '<div class="user-card"><div class="user-info"><span class="tb-lead">'+row.ao_name+' <span class="dot dot-success d-md-none ml-1"></span></span><span>N/A</span></div></div>';
                            } else {
                                return '<div class="user-card"><div class="user-info"><span class="tb-lead">'+row.ao_name+' <span class="dot dot-success d-md-none ml-1"></span></span><span>'+row.ao_no+'</span></div></div>';
                            }
                            
                        },name:'ao_name'
                    },
                    {data: null, className: 'nk-tb-col nk-tb-col-tools',
                        render: function(data, type, row, meta) {
                            return '<ul class="nk-tb-actions gx-1"><li class="nk-tb-action-hidden"><a href="customer-view/'+row.customer_id+'" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="View"><em class="icon ni ni-external"></em></a></li><li class="nk-tb-action-hidden"><a href="#" class="toggle btn btn-icon" data-target="#order-modal" data-toggle="modal" data-id="'+row.customer_id+'" data-branch="'+row.branch_id+'"><em class="icon ni ni-repeat" data-toggle="tooltip"data-placement="top" title="Order"></em></a></li><li><div class="drodown"><a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a></div></li></ul>';


                            
                        },
                    },
                ]
            });
        });
    </script>
@endpush
