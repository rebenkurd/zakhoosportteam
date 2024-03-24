@extends('backend.index')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-0">
      <span class="text-muted fw-light">Sponsor /</span><span class="fw-medium"> Edit Sponsor</span>
    </h4>
      <!-- Add Product -->

      <div class="row">
        <!-- First column-->
        <div class="col-12 col-lg-10">
          <!-- Product Information -->
          <div class="card mb-4">
            <div class="card-header">
              <h5 class="card-tile mb-0">Edit Sponsor</h5>
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

            <form action="{{ route('update.sponsor',$sponsor->id) }}" method="post" enctype="multipart/form-data" id="form_validation">
                @csrf
              <div class="row mb-3 ">
                <div class="col">
                    <label class="form-label" for="title">Sponsor Title</label>
                    <input
                      type="text"
                      class="form-control"
                      id="title"
                      placeholder="Enter a Sponsor Title"
                      name="title"
                      value="{{ $sponsor->title }}"
                      aria-label="Sponsor Title" />
                </div>
                <div class="col">
                    <label class="form-label" for="link">Sponsor Link</label>
                    <input
                      type="text"
                      class="form-control"
                      id="link"
                      value="{{ $sponsor->link }}"
                      placeholder="Enter a Sponsor Link"
                      name="link"
                      aria-label="Sponsor Link" />
                </div>
                </div>
              <div class="mb-3">
                <label class="form-label" for="description">Description</label>
                <textarea
                  class="form-control"
                  id="description"
                    value="{{ old('description') }}"
                  placeholder="Enter a Description"
                  name="description"
                  aria-label="description">{{ $sponsor->description }}</textarea>
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
                      {{ $sponsor->status == 'active' ? 'checked' : '' }}
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
                      {{ $sponsor->status == 'inactive' ? 'checked' : '' }}
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
                    <label class="form-label" for="type">Type</label>
                    <select id="type" name="type" class="select2 form-select" data-allow-clear="true">
                      <option value="">Select</option>
                        <option {{ $sponsor->type == 'main' ? 'selected' : '' }} value="main">Main</option>
                        <option {{ $sponsor->type == 'global' ? 'selected' : '' }} value="global">Global</option>
                        <option {{ $sponsor->type == 'individual' ? 'selected' : '' }} value="individual">Individual</option>
                        <option {{ $sponsor->type == 'organization' ? 'selected' : '' }} value="organization">Organization</option>
                        <option {{ $sponsor->type == 'other' ? 'selected' : '' }} value="other">Other</option>
                    </select>
              </div>
            </div>


            <div class="mb-3">
                 <label class="form-label" for="upload">Sponsor Logo</label>
                <div class="d-flex align-items-start align-items-sm-center gap-4 ">
                    <img
                      src="{{ !empty($sponsor->logo) ? asset($sponsor->logo) :'https://via.placeholder.com/150x150&text=sponsor-logo' }}"
                      alt="sponsor-logo"
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
