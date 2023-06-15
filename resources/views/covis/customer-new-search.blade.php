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
                                <div class="nk-block-des text-soft d-none d-md-inline-flex">
                                    <ul class="breadcrumb breadcrumb-pipe">
                                        <li class="breadcrumb-item active"><a href="#">YOU HAVE TOTAL (0)</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <form action="{{ route('customer.search') }}" class="d-flex">
                                                    <input  autocomplete="off" class="form-control me-2 mr-3" style="width: 300px;" type="search" placeholder="Type customer name, code or address here..." aria-label="Search" name="keyword">
                                                    <button class="btn btn-icon btn-primary" type="submit" value="Search"><em class="icon ni ni-search"></em></button>
                                                </form>
                                            </li>
                                            <li class="nk-block-tools-opt">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle btn btn-icon btn-light" data-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt">
                                                            <li><a href="{{ url('customer-new') }}"><em class="icon ni ni-user"></em><span>New Customer</span></a></li>
                                                            <li><a href="{{ url('customer-new-import') }}"><em class="icon ni ni-inbox-in"></em><span>Import Customer</span></a></li>
                                                            <li><a href="{{ url('order-new-import') }}"><em class="icon ni ni-package"></em><span>Import Order</span></a></li>
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
                                    <table class="datatable-init-export nk-tb-list nk-tb-ulist" id="customer-table" data-auto-responsive="false" data-export-title="Export">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">Customer Name</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Mode</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Region</span>
                                                </th>
                                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type</span>
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


@endsection

@push('addon-script')
    <script>
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
