@extends('backend.index')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-0">
      <span class="text-muted fw-light">Poll /</span><span class="fw-medium"> Edit Poll</span>
    </h4>
      <!-- Add Product -->

      <div class="row">
        <!-- First column-->
        <div class="col-12 col-lg-10">
          <!-- Product Information -->
          <div class="card mb-4">
            <div class="card-header">
              <h5 class="card-tile mb-0">Edit Poll</h5>
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

            <form action="{{ route('update.poll',[$poll]) }}" method="post" enctype="multipart/form-data" id="form_validation">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="category_id">Category</label>

                    <select class="form-select" id="category_id" name="category_id" aria-label="Category">
                        <option selected>Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $poll->category_id == $category->id ? 'selected':'' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row mb-3 ">
                    <div class="col-lg col-md-6 col-sm">
                        <label class="form-label" for="start_date">Start Date</label>
                        <input
                        type="text"
                        class="form-control datepickr"
                        id="start_date"
                        value="{{ $poll->start_date }}"
                        placeholder="YYYY-MM-DD"
                        name="start_date"
                        aria-label="Start Date" />
                    </div>
                    <div class="col-lg col-md-6 col-sm">
                        <label class="form-label" for="start_time">Start Time</label>
                        <input
                        type="text"
                        class="form-control timepickr"
                        id="start_time"
                        value="{{ $poll->start_time}}"
                        placeholder="HH:MM"
                        name="start_time"
                        aria-label="Start Time" />
                    </div>
                </div>
                <div class="row mb-3 ">
                    <div class="col-lg col-md-6 col-sm">
                        <label class="form-label" for="end_date">End Date</label>
                        <input
                        type="text"
                        class="form-control datepickr"
                        id="end_date"
                        placeholder="YYYY-MM-DD"
                        name="end_date"
                        value="{{ $poll->end_date }}"
                        aria-label="End Date" />
                    </div>
                    <div class="col-lg col-md-6 col-sm">
                        <label class="form-label" for="end_time">End Time</label>
                        <input
                        type="text"
                        class="form-control timepickr"
                        id="end_time"
                        value="{{ $poll->end_time }}"
                        placeholder="HH:MM"
                        name="end_time"
                        aria-label="End Time" />
                    </div>
                </div>
                <!--begin::Repeater-->
                <div id="options" class="mb-3">
                    <label class="form-label" >Options </label>
                    <div class="form-group">
                        <div data-repeater-list="options">
                          @foreach ($poll->options as $option)
                        <div data-repeater-item>
                          <div class="form-group row mb-5">
                            <div class="col-md-3">
                              <select name="options[][player_id]" id="player_id"  class="form-select mb-2">
                                <option selected>Select Player</option>
                                @foreach ($players as $player)
                                  <option value="{{ $player->id }}" {{ $option->player_id == $player->id ? 'selected' : '' }}>{{ $player->full_name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-3">
                              <input name="options[][video_url]" type="text" class="form-control mb-2" placeholder="Video Url" value="{{  $option->video_url  }}">
                            </div>
                            <div class="col-md-2">
                              <a href="javascript:;" data-repeater-delete class="btn btn-flex btn-outline-danger">
                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                Delete
                              </a>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>

                    <div class="form-group">
                      <a href="javascript:;" data-repeater-create class="btn btn-flex btn-outline-primary">
                        <i class="ki-duotone ki-plus fs-3"></i>
                        Add
                      </a>
                    </div>

                  </div>
                <!--end::Repeater-->

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

        $(document).ready(function(){

        $('#options').repeater({
            initEmpty: false,
            isFirstItemUndeletable: true,

            show: function () {
                $(this).slideDown();
                $('.select2-container').remove();

                $('select').select2({
                    width: '100%',
                    placeholder: "Select an Player",
                    allowClear: true
                });
            },


            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function(){
                // Init select2
                $('.form-select').select2({
                    placeholder: 'Select an Player',
                });
            }
        });




        })



        const startTimeInput = document.getElementById("start_time");
    const startTimeValue = startTimeInput.value;

    // Function to format time with AM/PM
    function formatTime(time) {
        const timeParts = time.split(":");
        const hours = parseInt(timeParts[0]);
        const minutes = timeParts[1];
        let amPm = "AM";

        if (hours >= 12) {
            amPm = "PM";
            hours -= 12; // Adjust for PM hours
        }

        if (hours === 0) {
            hours = 12; // Display 12 for midnight
        }

        const formattedTime = hours.toString().padStart(2, "0") + ":" + minutes + " " + amPm;
        return formattedTime;
    }

    startTimeInput.value = formatTime(startTimeValue);
            </script>
@endsection
