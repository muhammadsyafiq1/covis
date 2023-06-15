@extends('layouts.app')
@section('content')

    @if (Auth::user()->user_role_id > 2)
        @include('errors.forbidden')
    @else

    <!-- content -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">

                        <!-- block -->
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title mb-0">Role Setting</h4>
                                        <div class="nk-block-des">
                                            <p>You have total {{ $total }} data.</p>
                                        </div> 
                                    </div>
                                    <div class="nk-block-head-content">
                                        <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                            <div class="toggle-expand-content" data-content="pageMenu"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- datatable -->
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Note / Description</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($view as $data)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-avatar xs bg-dim-primary d-none d-sm-flex">
                                                            <span>{{ $data->code }}</span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ $data->name }}
                                                                @if ($data->is_active == 1)
                                                                <span class="dot dot-success d-md-none ml-1"></span>
                                                                @else
                                                                <span class="dot dot-danger d-md-none ml-1"></span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span class="">{{ !$data->note ? 'N/A' : $data->note }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                @if ($data->is_active == 1)
                                                    <span class="badge badge-sm badge-success bg-outline-success d-md-inline-flex">Active</span>
                                                @else
                                                    <span class="badge badge-sm badge-danger bg-outline-danger d-md-inline-flex">Inactive</span>
                                                @endif
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#"
                                                                    class="dropdown-toggle btn btn-icon btn-trigger"
                                                                    data-toggle="dropdown"><em
                                                                        class="icon ni ni-more-h"></em></a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /datatable -->
                            
                        </div>
                        <!-- /block -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content -->

    @endif

@endsection

@push('addon-script')
    <script>
        $('#assign-role').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget);
            var modal = $(this);

            modal.find('#id').attr('value', div.data('id'));
            modal.find('#name').html(div.data('name'));
        })
    </script>
@endpush
