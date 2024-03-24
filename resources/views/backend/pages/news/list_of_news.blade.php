@extends('backend.index')

@section('content')



<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Session</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">21,459</h3>
                                <p class="text-success mb-0">(+29%)</p>
                            </div>
                            <p class="mb-0">Total Users</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="ti ti-user ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Paid Users</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">4,567</h3>
                                <p class="text-success mb-0">(+18%)</p>
                            </div>
                            <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-danger">
                                <i class="ti ti-user-plus ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Active Users</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">19,860</h3>
                                <p class="text-danger mb-0">(-14%)</p>
                            </div>
                            <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="ti ti-user-check ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Pending Users</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">237</h3>
                                <p class="text-success mb-0">(+42%)</p>
                            </div>
                            <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="ti ti-user-exclamation ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Users List Table -->
    <div class="card">
        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-datatable pt-0">
                <div class="card-header pb-0 ">
                    <h4 class="card-title
                        ">List of News</h4>
                </div>
                <a href="{{ route('add.news') }}" class="btn btn-secondary add-new btn-primary waves-effect waves-light m-2"><span><i
                            class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New
                            News</span></span></a>

                <table class="table" id="zakho_table">
                    <thead>
                        <tr>
                            <th><input class="form-check-input select-all" type="checkbox" id="selectAll"
                                    data-value="all"></th>
                            <th>No.</th>
                            <th>title</th>
                            <th>Status</th>
                            <th>Creator</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $index => $new)
                        <tr>
                            <td><input class="form-check-input" type="checkbox" id="select"></td>
                            <td>{{ $index+1 }}</td>
                            <td>
                                <input type="hidden" value="{{ $new->id }}">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-3"><img src="{{ !empty($new->image)? asset($new->image) : 'https://via.placeholder.com/150x150' }}" alt="Avatar"
                                                class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column"><a href="#"
                                            class="text-body text-truncate"><span
                                                class="fw-medium" title="{{ $new->title_en }}">{{ Illuminate\Support\Str::substr($new->title_en,0,30) }}...</span></a></div>
                                </div>
                            </td>
                            <td>
                                @if ($new->status == 'active')
                                <a href="javascript:void(0);" class="status-toggle" data-id="{{ $new->id }}" data-status="inactive"><span class="badge bg-label-success">Active</span></a>
                            @else
                                <a href="javascript:void(0);" class="status-toggle" data-id="{{ $new->id }}" data-status="active"><span class="badge bg-label-danger">Inactive</span></a>
                            @endif
                            </td>
                            <td>
                                {{ $new->user->name }}
                            </td>
                            <td>
                                <button type="button"
                                    class="btn text-primary btn-icon rounded-2 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a href="{{ route('detail.news',$new->id) }}" class="dropdown-item"><i
                                                class="ti ti-detail"></i> Detail</a></li>
                                    <li><a href="{{ route('edit.news',$new->id) }}" class="dropdown-item"><i
                                                class="ti ti-edit"></i> Edit</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item " id="ban-btn" data-id="{{ $new->id }}"><i class="ti ti-ban"></i> Ban</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item " id="delete-btn" data-id="{{ $new->id }}"><i class="ti ti-trash"></i> Delete</a></li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




{{-- Activate and diactivate news --}}
<script>
    $(document).ready(function(){

        $(document).on('click', '.status-toggle', function(e){
            var id = $(this).data('id');
            var newStatus = $(this).data('status');
            var url = "{{ route('news.status', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: newStatus
                },
                success: function(response) {
                    // Assuming the response contains updated status information

                    if (response.status === 'active') {
                        $('.status-toggle[data-id="' + id + '"]').html('<span class="badge bg-label-success">Active</span>');
                        // toastr.success(response.notify.message);
                         Swal.fire({
                            title: 'Good job!',
                            text:response.notify.message,
                            icon: 'success',
                            customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        });
                    } else {
                        $('.status-toggle[data-id="' + id + '"]').html('<span class="badge bg-label-danger">Inactive</span>');
                        // toastr.success(response.notify.message);
                         Swal.fire({
                            title: 'Good job!',
                            text:response.notify.message,
                            icon: 'success',
                            customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        });
                    }

                },
                error: function(xhr, status, error) {
                    toastr.error(error);
                }
            });
        });
    });
</script>


{{-- force delete news --}}
<script>
    $(document).ready(function(){
        if($('#delete-btn').length){
            $(document).on('click', '#delete-btn', function (e) {
                e.preventDefault();
                var deleteBtn = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                        cancelButton: 'btn btn-label-secondary waves-effect waves-light'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            customClass: {
                                confirmButton: 'btn btn-success waves-effect waves-light'
                            }
                        });

                        var id = deleteBtn.data('id');
                        var url = "{{ route('delete.news', ':id') }}".replace(':id', id);

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                deleteBtn.closest('tr').remove();
                            },
                            error: function(xhr, error) {
                                toastr.error(error);
                            }
                        });
                    }
                });
            });
        }
    });
</script>

{{-- ban news --}}
<script>
    $(document).ready(function(){
        if($('#ban-btn').length){
            $(document).on('click', '#ban-btn', function (e) {
                e.preventDefault();
                var banBtn = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, ban it!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                        cancelButton: 'btn btn-label-secondary waves-effect waves-light'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            icon: 'success',
                            title: 'baned!',
                            text: 'Your file has been baned.',
                            customClass: {
                                confirmButton: 'btn btn-success waves-effect waves-light'
                            }
                        });

                        var id = banBtn.data('id');
                        var url = "{{ route('ban.news', ':id') }}".replace(':id', id);

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                banBtn.closest('tr').remove();
                            },
                            error: function(xhr, error) {
                                toastr.error(error);
                            }
                        });
                    }
                });
            });
        }
    });
</script>

@endsection
