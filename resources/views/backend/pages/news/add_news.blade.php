@extends('backend.index')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-0">
      <span class="text-muted fw-light">News /</span><span class="fw-medium"> Add New News</span>
    </h4>
      <!-- Add Product -->

      <div class="row">
        <!-- First column-->
        <div class="col-12 col-lg-10">
          <!-- Product Information -->
          <div class="card mb-4">
            <div class="card-header">
              <h5 class="card-tile mb-0">Add New News</h5>
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

            <form action="{{ route('store.news') }}" method="post" enctype="multipart/form-data" id="form_validation">
                @csrf
              <div class="row mb-3 ">
                <div class="col-12 col-sm">
                    <label class="form-label" for="title_en">English Title</label>
                    <input
                      type="text"
                      class="form-control"
                      id="title_en"
                      placeholder="Enter a English Title"
                      name="title_en"
                      value="{{ old('title_en') }}"
                      aria-label="English Title" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="title_ar">Arabic Title</label>
                    <input
                      type="text"
                      class="form-control"
                      id="title_ar"
                      placeholder="Enter a Arabic Title"
                      name="title_ar"
                      value="{{ old('title_ar') }}"
                      aria-label="Arabic Title" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="title_ckb">Kurdish Sorani Title</label>
                    <input
                      type="text"
                      class="form-control"
                      id="title_ckb"
                      placeholder="Enter a Kurdish Sorani Title"
                      name="title_ckb"
                      value="{{ old('title_ckb') }}"
                      aria-label="Kurdish Sorani Title" />
                </div>
                <div class="col-12 col-sm">
                    <label class="form-label" for="title_ku">Kurdish Badini Title</label>
                    <input
                      type="text"
                      class="form-control"
                      id="title_ku"
                      placeholder="Enter a Kurdish Badini Title"
                      name="title_ku"
                      value="{{ old('title_ku') }}"
                      aria-label="Kurdish Badini Title" />
                </div>
                </div>
              <div class="mb-3">
                <label class="form-label" for="description_en">English Description</label>
                <textarea
                  class="form-control"
                  id="description_en"
                  placeholder="Enter a English Description"
                  name="description_en"
                  aria-label="English Description">{{ old('description_en') }}</textarea>
              </div>
              <div class="mb-3">
                <label class="form-label" for="description_ar">Arabic Description</label>
                <textarea
                  class="form-control"
                  id="description_ar"
                  placeholder="Enter a Arabic Description"
                  name="description_ar"
                  aria-label="Arabic Description">{{ old('description_ar') }}</textarea>
              </div>
              <div class="mb-3">
                <label class="form-label" for="description_ckb">Kurdish Sorani Description</label>
                <textarea
                  class="form-control"
                  id="description_ckb"
                  placeholder="Enter a Kurdish Sorani Description"
                  name="description_ckb"
                  aria-label="Kurdish Sorani Description">{{ old('description_ckb') }}</textarea>
              </div>
              <div class="mb-3">
                <label class="form-label" for="description_ku">Kurdish Badini Description</label>
                <textarea
                  class="form-control"
                  id="description_ku"
                  placeholder="Enter a Kurdish Badini Description"
                  name="description_ku"
                  aria-label="Kurdish Badini Description">{{ old('description_ku') }}</textarea>
              </div>

              <div class="row mb-3">
              <div class="col-12 col-sm">
                <label class="form-check-label">Status</label>
                <div class="col mt-2">
                  <div class="form-check form-check-inline">
                    <input
                      name="status"
                      class="form-check-input"
                      type="radio"
                      value="active"
                      {{ old('status') == 'active' ? 'checked' : '' }}
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
                      {{ old('status') == 'inactive' ? 'checked' : '' }}
                      value="inactive"
                      id="inactive"
                      />
                    <label class="form-check-label" for="inactive">
                        Inactive
                    </label>
                  </div>
                </div>
              </div>



            <div class="mb-s">
                 <label class="form-label" for="upload">Reklam Image</label>
                <div class="d-flex align-items-start align-items-sm-center gap-4 flex-wrap">
                    <img
                      src="https://via.placeholder.com/400x400&text=400x400"
                      alt="sponsor-logo"
                      class="d-block w-px-400 h-px-400 rounded"
                      id="uploadedAvatar" />
                    <div class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                        <span class="d-none d-sm-block">Upload Image</span>
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
                    title_en: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter English title'
                        },
                         stringLength: {
                          min: 10,
                          max: 500,
                          message: 'The Title must be more than 10 and less than 500 characters long'
                        }
                      }
                    },
                    title_ar: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter Arabic title'
                        },
                         stringLength: {
                          min: 10,
                          max: 500,
                          message: 'The Title must be more than 10 and less than 500 characters long'
                        }
                      }
                    },
                    title_ckb: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter Kurdish Sorani title'
                        },
                         stringLength: {
                          min: 10,
                          max: 500,
                          message: 'The Title must be more than 10 and less than 500 characters long'
                        }
                      }
                    },
                    title_ku: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter Kurdish Badini title'
                        },
                         stringLength: {
                          min: 10,
                          max: 500,
                          message: 'The Title must be more than 10 and less than 500 characters long'
                        }
                      }
                    },
                    description_en: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter English description'
                        },
                         stringLength: {
                          min: 10,
                          max: 5000,
                          message: 'The description must be more than 10 and less than 5000 characters long'
                        }
                      }
                    },
                    description_ar: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter Arabic description'
                        },
                         stringLength: {
                          min: 10,
                          max: 5000,
                          message: 'The description must be more than 10 and less than 5000 characters long'
                        }
                      }
                    },
                    description_ckb: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter Kurdish Sorani description'
                        },
                         stringLength: {
                          min: 10,
                          max: 5000,
                          message: 'The description must be more than 10 and less than 5000 characters long'
                        }
                      }
                    },
                    description_ku: {
                      validators: {
                        notEmpty: {
                          message: 'Please enter Kurdish Badini description'
                        },
                         stringLength: {
                          min: 10,
                          max: 5000,
                          message: 'The description must be more than 10 and less than 5000 characters long'
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
                    status: {
                      validators: {
                        notEmpty: {
                          message: 'Please check a status'
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
                      case 'title_en':
                      case 'title_ar':
                      case 'title_ckb':
                      case 'title_ku':
                      case 'description_en':
                      case 'description_ar':
                      case 'description_ckb':
                      case 'description_ku':
                      case 'image':
                      case 'status':
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
