@extends('backend.index')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
    <!-- Card Border Shadow -->

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
                <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-truck ti-md"></i></span>
                </div>
                <h4 class="ms-1 mb-0">42</h4>
            </div>
            <p class="mb-1">On route vehicles</p>
            <p class="mb-0">
                <span class="fw-medium me-1">+18.2%</span>
                <small class="text-muted">than last week</small>
            </p>
            </div>
        </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow-warning h-100">
            <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
                <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-warning"
                    ><i class="ti ti-alert-triangle ti-md"></i
                ></span>
                </div>
                <h4 class="ms-1 mb-0">8</h4>
            </div>
            <p class="mb-1">Vehicles with errors</p>
            <p class="mb-0">
                <span class="fw-medium me-1">-8.7%</span>
                <small class="text-muted">than last week</small>
            </p>
            </div>
        </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow-danger h-100">
            <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
                <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-danger"
                    ><i class="ti ti-git-fork ti-md"></i
                ></span>
                </div>
                <h4 class="ms-1 mb-0">27</h4>
            </div>
            <p class="mb-1">Deviated from route</p>
            <p class="mb-0">
                <span class="fw-medium me-1">+4.3%</span>
                <small class="text-muted">than last week</small>
            </p>
            </div>
        </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow-info h-100">
            <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
                <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-info"><i class="ti ti-clock ti-md"></i></span>
                </div>
                <h4 class="ms-1 mb-0">13</h4>
            </div>
            <p class="mb-1">Late vehicles</p>
            <p class="mb-0">
                <span class="fw-medium me-1">-2.5%</span>
                <small class="text-muted">than last week</small>
            </p>
            </div>
        </div>
        </div>
        <!--/ Card Border Shadow -->

      <!-- Projects table -->
      <div class="col-12 col-xl-12 col-sm-12 order-1 order-lg-2 mb-4 mb-lg-0">
        <div class="card">
          <div class="card-datatable table-responsive">
            <table class="datatables-projects table border-top">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th>Name</th>
                  <th>Leader</th>
                  <th>Team</th>
                  <th class="w-px-200">Status</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <!--/ Projects table -->
    </div>
  </div>
@endsection
