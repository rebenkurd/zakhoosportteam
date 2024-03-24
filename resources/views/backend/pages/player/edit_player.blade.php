@extends('backend.index')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-0">
      <span class="text-muted fw-light">Player /</span><span class="fw-medium"> Edit Player</span>
    </h4>
      <!-- Add Product -->

      <div class="row">
        <!-- First column-->
        <div class="col-12 col-lg-10">
          <!-- Product Information -->
          <div class="card mb-4">
            <div class="card-header">
              <h5 class="card-tile mb-0">Edit Player</h5>
            </div>
            <div class="card-body">

                @if($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body
                    ">
                        <span>{{ $error }}</span>
                    </div>
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endforeach
                @endif

            <form action="{{ route('update.player',$data->id) }}" method="post" enctype="multipart/form-data" id="form_validation">
                @csrf
              <div class="row mb-3 ">
                <div class="col-12 col-sm">
                    <label class="form-label" for="first_name">First Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="first_name"
                        value="{{ $data->first_name }}"
                      placeholder="Enter a First Name"
                      name="first_name"
                      aria-label="First Name" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="middle_name">Middle Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="middle_name"
                      placeholder="Enter a Middle Name"
                      name="middle_name"
                      value="{{ $data->middle_name }}"
                      aria-label="Middle Name" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="last_name">Last Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="last_name"
                      value="{{ $data->last_name }}"
                      placeholder="Enter a Last Name"
                      name="last_name"
                      aria-label="Last Name" />
                </div>
                </div>
              <div class="row mb-3 ">
                <div class="col-12 col-sm">
                    <label class="form-label" for="age">Age</label>
                    <input
                      type="date"
                      class="form-control"
                      value="{{ $data->age}}"
                      id="age"
                      placeholder="Enter a Age"
                      name="age"
                      aria-label="Age" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="national">National</label>
                    <input
                      type="text"
                      class="form-control"
                      value="{{ $data->national }}"
                      id="national"
                      placeholder="Enter a National"
                      name="national"
                      aria-label="National" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="position">Position</label>
                    <select type="text" class="form-control" id="position" name="position">
                        <option value="">Select</option>
                        <option {{ $data->position=='goalkeeper'?'selected':'' }} value="goalkeeper">Goalkeeper</option>
                        <option {{ $data->position=='defender'?'selected':'' }} value="defender">Defender</option>
                        <option {{ $data->position=='midfielder'?'selected':'' }} value="midfielder">Midfielder</option>
                        <option {{ $data->position=='forward'?'selected':'' }} value="forward">Forward</option>
                    </select>
                </div>

              </div>
              <div class="row mb-3 ">
                <div class="col-12 col-sm">
                    <label class="form-label" for="phone">Phone</label>
                    <input
                      type="text"
                      class="form-control"
                      id="phone"
                      placeholder="Enter a Phone"
                      name="phone"
                        value="{{ $data->phone }}"
                      aria-label="Phone" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="email">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      placeholder="Enter a Email"
                      name="email"
                      value="{{ $data->email }}"
                      aria-label="Email" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="address">Address</label>
                    <textarea name="address" id="address" class="form-control" placeholder="Enter an Address">{{ $data->address }}</textarea>
                </div>

              </div>
              <div class="row mb-3 ">
                <div class="col-12 col-sm">
                    <label class="form-label" for="height">Height</label>
                    <input
                      type="text"
                      class="form-control"
                      id="height"
                      placeholder="Enter a Height"
                      value="{{ $data->height}}"
                      name="height"
                      aria-label="Height" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="weight">Weight</label>
                    <input
                      type="text"
                      class="form-control"
                      id="weight"
                      value="{{ $data->weight}}"
                      placeholder="Enter a Weight"
                      name="weight"
                      aria-label="Weight" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="foot">Foot</label>
                    <select type="text" class="form-select" id="foot" name="foot">
                        <option value="">Select</option>
                        <option {{ $data->foot=='right'?'selected':'' }} value="right">Rright</option>
                        <option {{ $data->foot=='left'?'selected':'' }} value="left">Left</option>
                    </select>
                </div>

              </div>
              <div class="row mb-3 ">
                <div class="col-12 col-sm">
                    <label class="form-label" for="joined">Joined</label>
                    <input
                      type="date"
                      class="form-control"
                      id="joined"
                      value="{{ $data->joined}}"
                      placeholder="Enter a Joined"
                      name="joined"
                      aria-label="Joined" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="contract_expires">Contract Expires</label>
                    <input
                      type="date"
                      value="{{ $data->contract_expires}}"
                      class="form-control"
                      id="contract_expires"
                      placeholder="Enter a Contract Expires"
                      name="contract_expires"
                      aria-label="Contract Expires" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="shirt_number">Shirt Number</label>
                    <input type="number"
                            min="1"
                            max="99"
                            value="{{ $data->shirt_number}}"
                            placeholder="Enter an Shirt Number"
                            class="form-control"
                            id="shirt_number"
                            name="shirt_number"
                        />
                </div>

              </div>

              <div class="row mb-3">

              <div class="col-12 col-sm">
                <label class="form-label" for="upload">Image</label>
               <div class="d-flex align-items-start align-items-sm-center gap-4">
                   <img
                     src="{{ !empty($data->image) ? asset($data->image) :'https://via.placeholder.com/150x150'}} "
                     alt="user-avatar"
                     class="d-block w-px-100 h-px-100 rounded"
                     id="uploadedAvatar" />
                   <div class="button-wrapper">
                     <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                       <span class="d-none d-sm-block">Upload photo</span>
                       <i class="ti ti-upload d-block d-sm-none"></i>
                       <input
                         type="file"
                         id="upload"
                         class="account-file-input"
                         name="image"
                         hidden
                         accept="image/png, image/jpeg, image/jpg, image/gif" />
                     </label>
                     <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                       <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                       <span class="d-none d-sm-block">Reset</span>
                     </button>
                     <div class="text-muted">Allowed JPG, JPGE, GIF or PNG. Max size of 1MB</div>
                   </div>
                 </div>
         </div>

         <div class="col-12 col-sm">
          <label class="form-check-label">Status</label>
          <div class="col mt-2">
            <div class="form-check form-check-inline">
              <input
                name="status"
                class="form-check-input"
                type="radio"
                value="active"
                id="active" />
              <label class="form-check-label" for="active"
                >Active</label
              >
            </div>
            <div class="form-check form-check-inline">
              <input
                name="status"
                class="form-check-input"
                type="radio"
                value="inactive"
                id="inactive"
                checked
                />
              <label class="form-check-label" for="inactive">
                  Inactive
              </label>
            </div>
          </div>
        </div>

            </div>


            <div class="pt-4">
                <div class="row">
                  <div class="mx-auto col-3">
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

    <script>
        document.addEventListener('DOMContentLoaded', function (e) {
          (function () {
            var form = document.getElementById('form_validation');
           var fv= FormValidation.formValidation( form , {
                  fields: {
                    first_name: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter your first name'
                        },
                        stringLength: {
                          min: 3,
                          max: 30,
                          message: 'The first name must be more than 4 and less than 30 characters long'
                        },
                      }
                    },
                    email: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter your email'
                        },
                        emailAddress: {
                          message: 'The value is not a valid email address'
                        }
                      }
                    },
                    image: {
                      validators: {
                        file: {
                          extension: 'jpeg,jpg,png,gif',
                          type: 'image/jpeg,image/png,image/gif',
                          maxSize: 1024 * 1024,
                          message: 'The selected file is not valid'
                        }
                      }
                    },
                  },
                  plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                  // Use this for enabling/changing valid/invalid class
                  // eleInvalidClass: '',
                  eleValidClass: '',
                  rowSelector: function (field, ele) {
                    // field is the field name & ele is the field element
                    switch (field) {
                      case 'name':
                      case 'email':
                      case 'image':
                      default:
                        return '.row';
                    }
                  }
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // Submit the form when all fields are valid
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
              },
              init: instance => {
                instance.on('plugins.message.placed', function (e) {
                  //* Move the error message out of the `input-group` element
                  if (e.element.parentElement.classList.contains('input-group')) {
                    // `e.field`: The field name
                    // `e.messageElement`: The message element
                    // `e.element`: The field element
                    e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                  }
                  //* Move the error message out of the `row` element for custom-options
                  if (e.element.parentElement.parentElement.classList.contains('custom-option')) {
                    e.element.closest('.row').insertAdjacentElement('afterend', e.messageElement);
                  }
                });
              }
                });

                if (role.length) {
              role.wrap('<div class="position-relative"></div>');
              role
                .select2({
                  placeholder: 'Select country',
                  dropdownParent: role.parent()
                })
                .on('change', function () {
                  // Revalidate the color field when an option is chosen
                  fv.revalidateField('role');
                });
            }


            })();


        });
                </script>
@endsection
