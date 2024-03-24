@extends('backend.index')

@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">User /</span> Profile</h4>

    <!-- Header -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="user-profile-header-banner">
            <img src="{{ asset('backend/assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top" />
          </div>
          <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
              <img
                src="{{ !empty($user->image)? asset($user->image) : 'https://via.placeholder.com/150x150?text=Profile+Image'}}"
                alt="user image"
                class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
            </div>
            <div class="flex-grow-1 mt-3 mt-sm-5">
              <div
                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                <div class="user-profile-info">
                  <h4>{{ $user->name }}</h4>
                  <small>@ {{ $user->username }}</small>
                </div>
                <div class="d-flex align-items-center gap-2">

                <a href="{{ route('edit.user',$user->id) }}" class="btn btn-primary">
                  <i class="ti ti-edit me-1"></i>Edit Profile
                </a>
                <a href="{{ route('logout.user') }}" class="btn btn-danger">
                  <i class="ti ti-logout me-1"></i>Logout
                </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Header -->

    <!-- User Profile Content -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <!-- About User -->
        <div class="card mb-4">
          <div class="card-body">
            <small class="card-text text-uppercase">About</small>
            <ul class="list-unstyled mb-4 mt-3">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-user text-heading"></i
                ><span class="fw-medium mx-2 text-heading">Full Name:</span> <span class="text-capitalize">{{ $user->name }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-at text-heading"></i
                ><span class="fw-medium mx-2 text-heading">Username:</span> <span>{{ $user->username  }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-check text-heading"></i
                ><span class="fw-medium mx-2 text-heading">Status:
                    @if ($user->status == 'active')
                    <a href="{{ route('change.status',$user->id) }}"><span class="badge bg-label-success">Active</span></a>
                    @else
                    <a href="{{ route('change.status',$user->id) }}"><span class="badge bg-label-danger">Inactive</span></a>
                    @endif
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-crown text-heading"></i
                ><span class="fw-medium mx-2 text-heading">Role:</span> <span class="text-capitalize">{{ !empty($user->getRoleNames()->first())? $user->getRoleNames()->first() : 'Subscriber'}}</span>
              </li>
            </ul>
            <small class="card-text text-uppercase">Contacts</small>
            <ul class="list-unstyled mb-4 mt-3">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email:</span>
                <span>{{ $user->email }}</span>
              </li>
            </ul>
          </div>
        </div>
        <!--/ About User -->
      </div>
    </div>
    <!--/ User Profile Content -->
  </div>

@endsection
