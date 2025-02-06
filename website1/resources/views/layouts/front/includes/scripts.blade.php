   <!-- footer end -->
   <script src="{{asset('web-assets/js/jquery-3.6.0.min.js')}}"></script>
   <script src="{{asset('web-assets/js/wow.js')}}"></script>
   <script src="{{asset('web-assets/slick/slick.js')}}"></script>
   <script src="{{asset('web-assets/slick/slick.min.js')}}"></script>
   <script src="{{asset('web-assets/js/jquery.slicknav.js')}}"></script>
   <script src="{{asset('web-assets/js/fancybox.js')}}"></script>
   <script src="{{asset('web-assets/js/bootstrap.js')}}"></script>
   <script src="{{asset('web-assets/js/custom.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
  @if(Session::has('message'))
  toastr.options =
  {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "6000",
    "extendedTimeOut": "6000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  toastr.success("{{ session('message') }}");
  @endif
  @if(Session::has('error'))
  toastr.options =
  {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "6000",
    "extendedTimeOut": "6000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  toastr.error("{{ session('error') }}");
  @endif
  @if(Session::has('info'))
  toastr.options =
  {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "6000",
    "extendedTimeOut": "6000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "6000",
    "extendedTimeOut": "6000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  toastr.warning("{{ session('warning') }}");
  @endif
</script>
<script type="text/javascript">
  $(document).ready(function(){
      toastr.options =
      {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "6000",
          "extendedTimeOut": "6000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
      }

      $("#newsletter_form").submit(function(e){
          e.preventDefault();
          var url = "{{ route('newsletter') }}";
          var form_data = $('#newsletter_form').serialize();
          $.ajax({
              type: "POST",
              url: url,
              data: form_data,
              dataType : 'JSON',
              success:function(result){
                  if(result.success) {

                      toastr.success('Thankyou For Subscribing To Our Newsletter.');
                      $('input[name="newsletter_email"]').val('');
                      $('#myModal').hide();
                  }
                  else{
                      toastr.error(result.error);
                  }
              },
          });
      });
    
  });
</script>
<!-- <script>
  document.getElementById('search-icon').addEventListener('click', function() {
    var searchBox = document.getElementById('search-box');
    if (searchBox.style.display === 'none' || searchBox.style.display === '') {
        searchBox.style.display = 'block';
    } else {
        searchBox.style.display = 'none';
    }
});
</script> -->
<!-- <script type="text/javascript">
    var cleave = new Cleave('#reg_contact', {
        numericOnly: true,
        delimiters: ['-', '-', ' '],
        blocks: [3, 3, 4],
    });
</script> -->

<script>
function submitForm() {
    $('.error-message').text('');

    var formData = $('#registrationForm').serialize();  // Use serialize() to collect form data

    $.ajax({
        type: 'POST',
        url: $('#registrationForm').attr('action'),
        data: formData,
        dataType: 'json',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        success: function (data) {
          toastr.success('You have Registered Successfully.');
          setTimeout(function(){
            window.location.href = '{{ route('login') }}';// Reload the page
}, 3000); // Reload the page after successful submission
            // Handle success (e.g., redirect, display success message)
        },
        error: function (data) {
            // Log the entire response to the console
            console.log(data);

            if (data && data.responseJSON && data.responseJSON.errors) {
                var errors = data.responseJSON.errors;

                // Loop through errors and display Toastr messages
                $.each(errors, function (key, value) {
                    toastr.error(value[0]);
                });
            } else {
                toastr.error('An unexpected error occurred.');
            }
        }
    });
}
</script>

@yield('js')