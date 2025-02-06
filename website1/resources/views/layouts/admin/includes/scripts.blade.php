<script src="{{asset('a-asset/js/custom.core.min.js')}}"></script>
<script src="{{asset('a-asset/js/custom.app.min.js')}}"></script>
<script src="{{asset('js/sweetalert.js')}}"></script>
@if(Session::has('error'))
    <script>
        Swal.fire({
            title: 'Error!',
            text: "{{Session::get('error')}}",
            icon: 'error',
            confirmButtonText: 'Okay!'
        });
    </script>
@endif
@if(Session::has('success'))
    <script>
        Swal.fire({
            title: 'Congratulations!',
            text: "{{Session::get('success')}}",
            icon: 'success',
            confirmButtonText: 'Okay!'
        });
    </script>
   
@endif
<script>
           $(function() {
        $('.mark-as-read').click(function() {
            var request = sendRequest($(this).data('id'),$(this).data('type'));
            request.done(() => {
                $(this).parents('.main-cls').remove();
            });
        });
        $('#mark-all').click(function() {
            var request = sendRequest();
            request.done(() => {
                $('.main-cls').remove();
            })
        });
    });

    function sendRequest(id = null,type = null) {
      
        var _token = "{{ csrf_token() }}";
        return $.ajax("{{ route('admin.markAsNotification') }}", {
            method: 'POST',
            data: {_token, id},
            success: function(data){
                if(data.status == '1'){
                    if(type == 'Contact'){
                    var id = data.id;
                    var path = "{{route('admin.displayInquiry',':path')}}";
                    window.location.href = path.replace(':path', id);
                    // location.reload();
                    }else if(type == 'order'){
                    var id = data.id;
                    var path = "{{route('admin.displayOrders',':path')}}";
                    window.location.href = path.replace(':path', id);
                    // location.reload();
                    }
                 
                    


                }
            }
        });
    }
    </script>
@yield('js')
