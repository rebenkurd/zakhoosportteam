 <!-- build:js assets/vendor/js/core.js -->

 <script src="{{ asset('backend/assets/vendor/libs/popper/popper.js') }}"></script>
 <script src="{{ asset('backend/assets/vendor/js/bootstrap.js') }}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/hammer/hammer.js') }}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/i18n/i18n.js') }}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
 <script src="{{ asset('backend/assets/vendor/js/menu.js') }}"></script>

 <!-- endbuild -->

 <!-- Vendors JS -->
 <script src="{{ asset('backend/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/swiper/swiper.js')}}') }}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/moment/moment.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/select2/select2.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/@form-validation/popular.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/@form-validation/auto-focus.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/cleavejs/cleave.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/quill/katex.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/quill/quill.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/dropzone/dropzone.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/tagify/tagify.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/jquery-sticky/jquery-sticky.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/toastr/toastr.js') }}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/jquery-timepicker/jquery-timepicker.js')}}"></script>
 <script src="{{ asset('backend/assets/vendor/libs/pickr/pickr.js')}}"></script>
 <!-- Main JS -->
 <script src="{{ asset('backend/assets/js/main.js') }}"></script>
 <script src="{{ asset('backend/assets/js/forms-editors.js')}}"></script>



    {{-- data table--}}
    <script>
        $('#zakho_table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,

            displayLength: 5,
            lengthMenu: [5, 10, 25, 50, 75, 100],
        });
    </script>
    {{-- Toastr Notifications --}}
    <script>


        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message')}}" );
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
    {{-- Image Uploader --}}
    <script>
        (function () {
            // Update/reset user image of account page
            let accountUserImage = document.getElementById('uploadedAvatar');
            const fileInput = document.querySelector('.account-file-input'),
            resetFileInput = document.querySelector('.account-image-reset');

            if (accountUserImage) {
            const resetImage = accountUserImage.src;
            fileInput.onchange = () => {
                if (fileInput.files[0]) {
                accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                }
            };
            resetFileInput.onclick = () => {
                fileInput.value = '';
                accountUserImage.src = resetImage;
            };
            }
        })();
    </script>


    <script>

        var select2 = $('.form-select');
        if (select2.length) {
            select2.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder: 'Select value',
                dropdownParent: $this.parent()
            });
            });
        }

    </script>

<script>
    $('.datepickr').flatpickr({
      enableTime: false,
      dateFormat: 'Y-m-d'
    });
    $('.timepickr').flatpickr({
      noCalendar: true,
      enableTime: true,
      timeFormat: 'H:i'
    });
</script>

