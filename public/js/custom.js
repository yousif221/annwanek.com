
// new WOW().init();


$(function(){
    $("div#navbar > ul > li").each(function(){
        var mobbody = $(this).html();
        $('.sidenav').append('<div>'+mobbody+'</div>');
    });
    $( "#mySidenav a" ).each(function(){
        if ($(this).find(".caret").length > 0){
          $(this).parent('div').attr('id','hassubmenu');
          $(this).after('<i class="fa fa-angle-down"></i>');
        }
    });
    $('#mySidenav #hassubmenu i.fa.fa-angle-down').click(function(){
        $(this).next('ul.dropdown-menu').slideToggle();
    }
    );
});
$('.reg-form').click(function(){
    $('#myModalreg').show();
    $('#myModal1').hide();
    $('.modal-backdrop').hide();
});
function openNav() {
        document.getElementById("mySidenav").style.left = "0px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.left = "-250px";
}

$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: true,
  centerMode: false,
  focusOnSelect: true
});

$(function(){
 $('.trade-slider').slick({
  dots: true,
  infinite: false,
  speed: 300,
  rows:1,
  slidesToShow: 6,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]

});

 });
    $('.togle_btn a').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
});
$( "#myModal2" ).on('shown.bs.modal', function (e) {
    account = $('#accountType').val();
    $("#plan ."+account).show();
    $('#plan option').removeAttr('selected');
    $("#plan").find('.' +account).first().attr('selected','selected');
});
$("#accountType").change(function () {
    account = $('#accountType').val();
    $("#plan option").hide();
    $("#plan ."+account).show();
    $('#plan option').removeAttr('selected');
    $("#plan").find('.' +account).first().attr('selected','selected');
});  
$( document ).ready(function() {
    $("#plan option").hide();
    $('#registration').validate({
        rules: {
            first_name: {required: true, lettersonly: true},
            last_name: {required: true, lettersonly: true},
            email: {required: true},
            contact: { required: true, phoneUS: true },
            username: {required: true, nowhitespace: true},
        },
        highlight: function(element, errorClass, validClass) {
            $(element).parent().addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parent().removeClass('error');
        },
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length || element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        // submitHandler: function(form) { }
    });
});

$('#login').submit(function (e) {
    e.preventDefault();
    $('#login .error p').text('');
    $('#login .error').removeClass('error');
    $('.sign-in').hide();
    $('.sign-in-loader').removeClass('loader');
    let form = $('#login');
    $.ajax({
        url: form[0].action,
        type: form[0].method,
        data: form.serialize(),
        success(response) {
            $('.sign-in-loader').addClass('loader');
            $('.sign-in').show();
            if(response.success == 1) {
                if(response.redirect)
                    window.location.href = "/wti/panel";
                else
                    location.reload();
            }
            else {
                Swal.fire({
                    title: 'Error!',
                    text: response.error,
                    icon: 'error',
                    confirmButtonText: 'Okay!'
                });
            }
        },
        error(exception) {
            $.each(exception.responseJSON.errors, function (key, message) {
                let inputRow = $('.' + key);
                inputRow.parent().addClass('error');
                inputRow.text(message);
            });
            $('.sign-in-loader').addClass('loader');
            $('.sign-in').show();
        }
    });
});
$(document).ready(function () {
        const subscription = $("#subscribe");
        subscription.submit(function (event) {
            event.preventDefault();
            $.ajax({
                type: subscription[0].method,
                url: subscription[0].action,
                data: subscription.serialize(),
                success(response) {
                    if(response.success) {
                        Swal.fire({
                            title: 'Congratulations!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Great!'
                        });
                    }
                },
                error(exception) {
                    $.each(exception.responseJSON.errors, function (key, message) {
                        Swal.fire({
                            title: 'Error!',
                            text: message,
                            icon: 'error',
                            confirmButtonText: 'Okay!'
                        });
                    });
                }
            });
        });
    });

var initStripePayment=function(){
        // console.log("Payment initialzing");
        var stripe = Stripe('pk_test_51JpJ1MKTYCYA59IByGqGpiY3zhTtfXJr25TAm9IkT3GpooiwYWOsiJ8FCaDxAmxHLPm58uvl5tNjKUQZHc5gnQkv0005S4ifST');
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                padding: '20px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        var options = {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                    padding: '2px 2px 4px 2px',
                },
            }
        }
        var card = elements.create('card', {style: style});
        card.mount('#card-element');
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        const cardHolderName = document.getElementById('fName')+' '+document.getElementById('lName');
        var form = document.getElementById('registration');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            if(1===1){
                const { paymentMethod, error } = await stripe.createPaymentMethod(
                    'card', card, {
                        billing_details: { name: cardHolderName.value }
                    }
                );
                if (error) {
                    // alert(error.message);
                } else {
                    console.log(paymentMethod);
                    stripePaymentMethodHandler(paymentMethod.id);
                }
            }
        });

        function stripePaymentMethodHandler(payment_id) {
            var form = document.getElementById('registration');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripePaymentId');
            hiddenInput.setAttribute('value', payment_id);
            form.appendChild(hiddenInput);
            $('.error p').text('');
            $('.error').removeClass('error');
            $('.sign-up').hide();
            $('.sign-up-loader').removeClass('loader');
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success(response) {
                    $('.sign-up-loader').addClass('loader');
                    $('.sign-up').show();
                    if(response.success) {
                        window.location.href = "/wti/panel";
                    }
                },
                error(exception) {
                    $.each(exception.responseJSON.errors, function (key, message) {
                        let inputRow = $('.' + key);
                        inputRow.parent().addClass('error');
                        inputRow.text(message);
                    });
                    $('.sign-up-loader').addClass('loader');
                    $('.sign-up').show();
                }
            });
        }
    }
    window.onload = function () {
        initStripePayment();
    }



