@extends('backend.index')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-0">
      <span class="text-muted fw-light">Team /</span><span class="fw-medium"> Detail Team</span>
    </h4>
      <!-- Add Product -->

      <div class="row">
        <!-- First column-->
        <div class="col-12 col-lg-12">
          <!-- Product Information -->
          <div class="card mb-4">
            <div class="card-header">
              <h5 class="card-tile mb-0">Detail Team</h5>
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

            <form action="{{ route('update.team',$data->id) }}" method="post" enctype="multipart/form-data" id="form_validation">
                @csrf

              <div class="row mb-3 ">
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="title">Team Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      placeholder="Enter a Team Name"
                      name="name"
                      value="{{ $data->name }}"
                      aria-label="Team Name" />
                </div>
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="stadium">Stadium Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="stadium"
                      value="{{ $data->stadium }}"
                      placeholder="Enter a Stadium Name"
                      name="stadium"
                      aria-label="Stadium Name" />
                </div>
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="country">Country</label>
                    <input
                      type="text"
                      class="form-control"
                      id="country"
                      value="{{ $data->country }}"
                      placeholder="Enter a Country"
                      name="country"
                      aria-label="Country" />
                </div>
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="city">City</label>
                    <input
                      type="text"
                      class="form-control"
                      id="city"
                      value="{{ $data->city }}"
                      placeholder="Enter a City"
                      name="city"
                      aria-label="City" />
                </div>
            </div>
            <div class="row mb-3 ">
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="founded">Founded</label>
                    <input
                      type="date"
                      class="form-control"
                      id="founded"
                      value="{{ $data->founded }}"
                      placeholder="Enter a Founded"
                      name="founded"
                      aria-label="Founded" />
                </div>
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="coach">Coach</label>
                    <input
                      type="text"
                      class="form-control"
                      id="coach"
                      value="{{ $data->coach }}"
                      placeholder="Enter a Coach"
                      name="coach"
                      aria-label="Coach" />
                </div>
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="president">President</label>
                    <input
                      type="text"
                      class="form-control"
                      id="president"
                      value="{{ $data->president }}"
                      placeholder="Enter a President"
                      name="president"
                      aria-label="President" />
                </div>
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="captain">Captain</label>
                    <input
                      type="text"
                      class="form-control"
                      id="captain"
                      value="{{ $data->captain }}"
                      placeholder="Enter a Captain"
                      name="captain"
                      aria-label="Captain" />
                </div>
            </div>
            <div class="row mb-3 ">
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="vice_captain">Vice Captain</label>
                    <input
                      type="text"
                      class="form-control"
                      id="vice_captain"
                      value="{{ $data->vice_captain }}"
                      placeholder="Enter a Vice Captain"
                      name="vice_captain"
                      aria-label="Vice Captain" />
                </div>
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="email">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      value="{{ $data->email }}"
                      placeholder="Enter a Email"
                      name="email"
                      aria-label="Email" />
                </div>
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="phone">Phone</label>
                    <input
                      type="text"
                      class="form-control"
                      id="phone"
                      value="{{ $data->phone }}"
                      placeholder="Enter a Phone"
                      name="phone"
                      aria-label="Phone" />
                </div>
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="address">Address</label>
                    <input
                      type="text"
                      class="form-control"
                      id="address"
                      value="{{ $data->address }}"
                      placeholder="Enter a Address"
                      name="address"
                      aria-label="Address" />
                </div>
            </div>
            <div class="row mb-3 ">
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="twitter">Twitter</label>
                    <input
                      type="text"
                      class="form-control"
                      id="twitter"
                      value="{{ $data->twitter }}"
                      placeholder="Enter a Twitter"
                      name="twitter"
                      aria-label="Twitter" />
                </div>
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="facebbok">Facebook</label>
                    <input
                      type="text"
                      class="form-control"
                      id="facebook"
                      value="{{ $data->facebook }}"
                      placeholder="Enter a Facebook"
                      name="facebook"
                      aria-label="Facebook" />
                </div>
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="instagram">Instagram</label>
                    <input
                      type="text"
                      class="form-control"
                      id="instagram"
                      value="{{ $data->instagram }}"
                      placeholder="Enter a Instagram"
                      name="instagram"
                      aria-label="Instagram" />
                </div>
                <div class="col-lg col-md-6 col-sm">
                    <label class="form-label" for="youtube">Youtube</label>
                    <input
                      type="text"
                      class="form-control"
                      id="youtube"
                      value="{{ $data->youtube }}"
                      placeholder="Enter a Youtube"
                      name="youtube"
                      aria-label="Youtube" />
                </div>
            </div>


              <div class="row mb-3">
              <div class="col-lg col-md-6 col-sm">
                <label class="form-check-label">Status</label>
                <div class="col mt-2">
                  <div class="form-check form-check-inline">
                    <input
                      name="status"
                      class="form-check-input"
                      type="radio"
                      value="active"
                      {{ $data->status == 'active' ? 'checked' : '' }}
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
                      {{ $data->status == 'inactive' ? 'checked' : '' }}
                      id="inactive"
                      />
                    <label class="form-check-label" for="inactive">
                        Inactive
                    </label>
                  </div>
                </div>
              </div>

              <div class="col-lg col-md-6 col-sm">
                <label class="form-label" for="description">Description</label>
                <textarea
                  class="form-control"
                  id="description"
                    value="{{ old('description') }}"
                  placeholder="Enter a Description"
                  name="description"
                  aria-label="description">{{ $data->description }}</textarea>
              </div>
            </div>


            <div class="mb-3">
                 <label class="form-label" for="upload">Team Logo</label>
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img
                      src="{{ !empty($data->logo) ? asset($data->logo): 'https://via.placeholder.com/150x150&text=team-logo' }}"
                      alt="team-logo"
                      class="d-block w-px-100 h-px-100 rounded"
                      id="uploadedAvatar" />
                    <div class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                        <span class="d-none d-sm-block">Upload Logo</span>
                        <i class="ti ti-upload d-block d-sm-none"></i>
                        <input
                          type="file"
                          id="upload"
                          class="account-file-input"
                          name="logo"
                          hidden
                          accept="logo/png, logo/jpeg, logo/jpg, logo/gif" />
                      </label>
                      <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                        <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                      </button>
                      <div class="text-muted">Allowed JPG, JPGE, GIF or PNG. Max size of 1MB</div>
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
                    title: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter sponsor title'
                        }
                      }
                    },
                    logo: {
                      validators: {
                        file: {
                          extension: 'jpeg,jpg,png,gif',
                          type: 'image/jpeg,image/png,image/gif',
                          maxSize: 1024 * 1024,
                          message: 'The selected file is not valid'
                        }
                      }
                    },
                    description: {
                        stringLength: {
                          min: 10,
                          max: 250,
                          message: 'The description must be more than 10 and less than 250 characters long'
                        }
                    },
                    status: {
                      validators: {
                        notEmpty: {
                          message: 'Please check a status'
                        },
                      }
                    },
                    type: {
                      validators: {
                        notEmpty: {
                          message: 'Please select a type'
                        },
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
                      case 'title':
                      case 'image':
                      case 'logo':
                      case 'description':
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

                if (type.length) {
              type.wrap('<div class="position-relative"></div>');
              type
                .select2({
                  placeholder: 'Select country',
                  dropdownParent: type.parent()
                })
                .on('change', function () {
                  // Revalidate the color field when an option is chosen
                  fv.revalidateField('type');
                });
            }


            })();


        });
                </script>
@endsection
