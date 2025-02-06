@yield('before-css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
<link rel="stylesheet" id="css-main" href="{{asset('a-asset/css/custom.min.css')}}">
<style>
.count {
    position: relative;
    height: 18px;
    width: 18px;
    display: inline-block;
    /* line-height: 24px; */
    margin-left: -14px;
    font-size: 15px;
    vertical-align: bottom;
    left: 9px;
    bottom: 8px;
    border-radius: 50%;
    background-color: #ff1800;
}
        
</style>
@yield('css')
