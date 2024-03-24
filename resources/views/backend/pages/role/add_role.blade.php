@extends('backend.index')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-0">
      <span class="text-muted fw-light">User /</span><span class="fw-medium"> Add New User</span>
    </h4>
      <!-- Add Product -->

      <div class="row">
        <!-- First column-->
        <div class="col-12 col-lg-10">
          <!-- Product Information -->
          <div class="card mb-4">
            <div class="card-header">
              <h5 class="card-tile mb-0">Add New User</h5>
            </div>
            <div class="card-body">

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body
                    ">
                        @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                        @endforeach
                    </div>
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

            <form action="{{ route('store.role') }}" method="post">
                @csrf
              <div class="mb-3 ">
                    <label class="form-label" for="name">Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      placeholder="Enter a Name"
                      name="name"
                      aria-label="Name" />
                </div>
            </div>
            <div class="pt-4">
                <div class="row justify-content-end">
                  <div class="col-2 mx-auto">
                    <button type="submit" class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">Submit</button>
                    <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                  </div>
                </div>
              </div>
            </form>
            </div>
          </div>
          <!-- /Product Information -->

        </div>
      </div>
    </div>



@endsection
