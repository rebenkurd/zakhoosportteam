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

      <!-- Earning Reports -->
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
            <div class="card-title mb-0">
              <h5 class="mb-0">Earning Reports</h5>
              <small class="text-muted">Weekly Earnings Overview</small>
            </div>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="earningReportsId"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <i class="ti ti-dots-vertical ti-sm text-muted"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
              </div>
            </div>
            <!-- </div> -->
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-md-4 d-flex flex-column align-self-end">
                <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap">
                  <h1 class="mb-0">$468</h1>
                  <div class="badge rounded bg-label-success">+4.2%</div>
                </div>
                <small>You informed of this week compared to last week</small>
              </div>
              <div class="col-12 col-md-8">
                <div id="weeklyEarningReports"></div>
              </div>
            </div>
            <div class="border rounded p-3 mt-4">
              <div class="row gap-4 gap-sm-0">
                <div class="col-12 col-sm-4">
                  <div class="d-flex gap-2 align-items-center">
                    <div class="badge rounded bg-label-primary p-1">
                      <i class="ti ti-currency-dollar ti-sm"></i>
                    </div>
                    <h6 class="mb-0">Earnings</h6>
                  </div>
                  <h4 class="my-2 pt-1">$545.69</h4>
                  <div class="progress w-75" style="height: 4px">
                    <div
                      class="progress-bar"
                      role="progressbar"
                      style="width: 65%"
                      aria-valuenow="65"
                      aria-valuemin="0"
                      aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="d-flex gap-2 align-items-center">
                    <div class="badge rounded bg-label-info p-1"><i class="ti ti-chart-pie-2 ti-sm"></i></div>
                    <h6 class="mb-0">Profit</h6>
                  </div>
                  <h4 class="my-2 pt-1">$256.34</h4>
                  <div class="progress w-75" style="height: 4px">
                    <div
                      class="progress-bar bg-info"
                      role="progressbar"
                      style="width: 50%"
                      aria-valuenow="50"
                      aria-valuemin="0"
                      aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="d-flex gap-2 align-items-center">
                    <div class="badge rounded bg-label-danger p-1">
                      <i class="ti ti-brand-paypal ti-sm"></i>
                    </div>
                    <h6 class="mb-0">Expense</h6>
                  </div>
                  <h4 class="my-2 pt-1">$74.19</h4>
                  <div class="progress w-75" style="height: 4px">
                    <div
                      class="progress-bar bg-danger"
                      role="progressbar"
                      style="width: 65%"
                      aria-valuenow="65"
                      aria-valuemin="0"
                      aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Earning Reports -->

      <!-- Projects table -->
      <div class="col-12 col-xl-8 col-sm-12 order-1 order-lg-2 mb-4 mb-lg-0">
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
