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
                        ">List of Recycle Users</h4>
                    </div>
                    <a href="#" class="btn btn-secondary add-new btn-primary waves-effect waves-light m-2"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New User</span></span></a>

                  <table class="table" id="zakho_table">
                    <thead>
                      <tr>
                        <th><input class="form-check-input select-all" type="checkbox" id="selectAll" data-value="all"></th>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td><input class="form-check-input" type="checkbox" id="select"></td>
                                <td>{{ $index+1 }}</td>
                                <td>
                                    <input type="hidden" value="{{ $user->id }}">
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar me-3"><img src="{{ !empty($user->image)? asset($user->image) : 'https://via.placeholder.com/150x150' }}" alt="Avatar"
                                                    class="rounded-circle"></div>
                                        </div>
                                        <div class="d-flex flex-column"><a href="{{ route('detail.user',$user->id) }}"
                                                class="text-body text-truncate"><span
                                                    class="fw-medium">{{ Illuminate\Support\Str::of($user->name)->apa() }}</span></a><small
                                                class="text-muted">{{ $user->email }}</small></div>
                                    </div>
                                </td>                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ !empty($user->getRoleNames()->first())? $user->getRoleNames()->first() : 'Subscriber'}}
                                </td>
                                <td>
                                    @if ($user->status == 'active')
                                   <span class="badge bg-label-success">Active</span>
                                @else
                                    <span class="badge bg-label-danger">Inactive</span>
                                @endif
                                </td>
                                <td>
                                        <button
                                          type="button"
                                          class="btn text-primary btn-icon rounded-2 dropdown-toggle hide-arrow"
                                          data-bs-toggle="dropdown"
                                          aria-expanded="false">
                                          <i class="ti ti-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="{{ route('detail.user',$user->id) }}" class="dropdown-item"><i class="ti ti-user"></i> Detail</a></li>
                                            <li><a href="javascript:void(0);" class="dropdown-item " id="restore-btn" data-id="{{ $user->id }}"><i class="ti ti-restore"></i> Restore</a></li>
                                            <li><a href="javascript:void(0);" class="dropdown-item " id="delete-btn" data-id="{{ $user->id }}"><i class="ti ti-trash"></i> Delete</a></li>
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




  {{-- force delete user --}}
<script>
    $(document).ready(function(){
        if($('#delete-btn').length){
            $(document).on('click', '#delete-btn', function (e) {
                e.preventDefault();
                var deleteBtn = $(this); // Store reference to $(this)
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

                        var UserId = deleteBtn.data('id');
                        var url = "{{ route('delete.user', ':id') }}".replace(':id', UserId);

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


{{-- restore User --}}
<script>
    $(document).ready(function(){
        if($('#restore-btn').length){
            $(document).on('click', '#restore-btn', function (e) {
                e.preventDefault();
                var restoreBtn = $(this);
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

                        var userId = restoreBtn.data('id');
                        var url = "{{ route('restore.user', ':id') }}".replace(':id', userId);

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                restoreBtn.closest('tr').remove();
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




