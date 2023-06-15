@extends('layouts.app')
@section('content')

    <!-- content -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview">
                        <div class="nk-block nk-block-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title mb-0">Personnel</h4>
                                        <div class="nk-block-des">
                                            <p>You have total {{ $total }} data.</p>
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
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Company</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Department</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Job Position</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Mobile No.</span></th>
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
                                                        @if ($data->userImage)
                                                            <div class="user-avatar">
                                                                <img src="images/avatar/{{ $data->userImage->name }}" alt="">
                                                            </div>
                                                        @else
                                                            <div class="user-avatar">
                                                                <img src="images/avatar/unknown" alt="">
                                                            </div>
                                                        @endif
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ $data->name }}
                                                                @if ($data->is_active == 1)
                                                                <span class="dot dot-success d-md-none ml-1"></span>
                                                                @else
                                                                <span class="dot dot-danger d-md-none ml-1"></span>
                                                                @endif
                                                            </span>
                                                            <span><a href="mailto:{{ $data->email }}">{{ $data->email }}</a></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{ $data->company->name }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span>{{ $data->department->name }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md" data-order="35040.34">
                                                    <span class="currency">{{ $data->jobPosition->name  }}</span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span><a href="tel:{{ $data->mobile_no }}">{{ $data->mobile_no }}</a></span>
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
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="{{ url('personnel-view',$data->id) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="View">
                                                                <em class="icon ni ni-external-alt"></em>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="btn btn-icon btn-trigger"><em class="icon ni ni-more-h"></em></a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content -->
    
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
