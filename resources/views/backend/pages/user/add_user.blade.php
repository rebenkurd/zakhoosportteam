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

            <form action="{{ route('store.user') }}" method="post" enctype="multipart/form-data" id="form_validation">
                @csrf
              <div class="row mb-3 ">
                <div class="col">
                    <label class="form-label" for="name">Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      placeholder="Enter a Name"
                      name="name"
                      aria-label="Name" />
                </div>
                <div class="col">
                    <label class="form-label" for="username">Username</label>
                    <input
                      type="text"
                      class="form-control"
                      id="username"
                      placeholder="Enter a Username"
                      name="username"
                      aria-label="Username" />
                </div>
                </div>

              <div class="row mb-3 ">
                <div class="col form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    placeholder="Enter a Password"
                    name="password"
                    aria-label="Password" />
                    <span class="input-group-text cursor-pointer" id="password"><i class="ti ti-eye-off"></i></span>

                </div>
                </div>
                <div class="col form-password-toggle">
                  <label class="form-label" for="confirm-password">Confirm Password</label>
                  <div class="input-group input-group-merge">
                  <input
                    type="password"
                    class="form-control"
                    id="confirm-password"
                    placeholder="Enter a Confirm Password"
                    name="password_confirmation"
                    aria-label="Confirm Password" />
                    <span class="input-group-text cursor-pointer" id="confirm-password"><i class="ti ti-eye-off"></i></span>

                </div>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  placeholder="Enter a Email"
                  name="email"
                  aria-label="Email" />
              </div>

              <div class="row mb-3">
              <div class="col">
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

              <div class="col">
                    <label class="form-label" for="role">Role</label>
                    <select id="role" name="role" class="select2 form-select" data-allow-clear="true">
                      <option value="">Select</option>
                      @forelse ( $roles as $role )

                      <option value="{{ $role->name }}">{{ $role->name }}</option>
                      @empty
                        <option value="">Role Not Found</option>
                      @endforelse
                    </select>
              </div>
            </div>


            <div class="mb-3">
                 <label class="form-label" for="upload">Image</label>
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img
                      src="https://via.placeholder.com/150x150"
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
                    name: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter your name'
                        },
                        stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The name must be more than 4 and less than 30 characters long'
                        },
                        regexp: {
                          regexp: /^[a-zA-Z0-9 ]+$/,
                          message: 'The name can only consist of alphabetical, number and space'
                        }
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
                    username: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter your username'
                        },
                        stringLength: {
                          min: 7,
                          max: 30,
                          message: 'The username must be more than 7 and less than 30 characters long'
                        },
                        regexp: {
                          regexp: /^[a-zA-Z0-9]+$/,
                          message: 'The username can only consist of alphabetical, number '
                        }
                      }
                    },
                    password_confirmation: {
                      validators: {
                        notEmpty: {
                          message: 'Please confirm password'
                        },
                        identical: {
                          compare: function () {
                            return form.querySelector('[name="password"]').value;
                          },
                          message: 'The password and its confirm are not the same'
                        }
                      }
                    },
                    password: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter a password'
                        },
                        stringLength: {
                          min: 6,
                          message: 'The name must be more than 6 characters long'
                        },
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
                    status: {
                      validators: {
                        notEmpty: {
                          message: 'Please check a status'
                        },
                      }
                    },
                    role: {
                      validators: {
                        notEmpty: {
                          message: 'Please select a role'
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
                      case 'name':
                      case 'email':
                      case 'username':
                      case 'password':
                      case 'password_confirmation':
                      case 'image':
                      case 'status':
                      case 'role':
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
