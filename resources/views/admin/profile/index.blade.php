@extends('layouts.admin.app')
@section('title', 'Profile Information')
@section('css')
@endsection
@section('content')
    <main id="main-container">
        <div class="bg-image bg-image-bottom mt-30" style="background-image: url({{asset('storage/images/profile-bg.jpg')}});">
            <div class="bg-black-op-75 py-30">
                <div class="content content-full text-center">
                    <div class="mb-15">
                        <a class="img-link" href="javascript:void(0)">
                            <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{(auth()->user()->profile_image != null)?asset(auth()->user()->profile_image) :asset('storage/images/profile/placeholder.jpg')}}" alt="{{auth()->user()->username}}">
                        </a>
                    </div>
                    <h1 class="h3 text-white font-w700 mb-10">{{auth()->user()->name()}}</h1>
                    <h2 class="h5 text-white-op">
                        {{auth()->user()->accountType()}}
                    </h2>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-user-circle mr-5 text-muted"></i> General Information
                    </h3>
                </div>
                <div class="block-content">
                    <form action="{{route('admin.profileUpdate', auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <p class="text-muted">
                                    Your account’s vital info. Your full name, username and profile image will be publicly visible.
                                    @csrf
                                </p>
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                <div class="form-group row">
                                    <div class="col-xl-3"></div>
                                    <div class="col-md-10 col-xl-6 text-center">
                                        <div class="push">
                                            <img class="img-avatar" src="{{(auth()->user()->profile_image != null)?asset(auth()->user()->profile_image) :asset('storage/images/profile/placeholder.jpg')}}" alt="{{auth()->user()->username}}">
                                        </div>
                                        <div class="custom-file text-left">
                                            <input type="file" class="custom-file-input" id="profile-settings-avatar" name="profile_image" data-toggle="custom-file-input">
                                            <label class="custom-file-label" for="profile-settings-avatar">Choose new Image</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="profile-settings-username">First Name</label>
                                        <input type="text" class="form-control form-control-lg" name="f_name" placeholder="Your First Name" value="{{auth()->user()->name(1)}}">
                                        @if($errors->has('f_name'))
                                            <p class="text-danger font-weight-bold">{{ $errors->first('f_name') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="profile-settings-username">Last Name</label>
                                        <input type="text" class="form-control form-control-lg" name="l_name" placeholder="Your Last Name" value="{{auth()->user()->name(2)}}">
                                        @if($errors->has('l_name'))
                                            <p class="text-danger font-weight-bold">{{ $errors->first('l_name') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="profile-settings-name">Username</label>
                                        <input type="text" class="form-control form-control-lg" name="username" placeholder="Your Username" value="{{auth()->user()->username}}">
                                        @if($errors->has('username'))
                                            <p class="text-danger font-weight-bold">{{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="profile-settings-name">Address</label>
                                        <input type="text" class="form-control form-control-lg" name="address_1" placeholder="Your Address" value="{{auth()->user()->address_1}}">
                                        @if($errors->has('address_1'))
                                            <p class="text-danger font-weight-bold">{{ $errors->first('address_1') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="profile-settings-email">Email Address</label>
                                        <input type="email" class="form-control form-control-lg disabled" name="email" placeholder="Your Email Address" value="{{auth()->user()->email}}" disabled title="You cannot change your Email Address">
                                    </div>
                                    <div class="col-6">
                                        <label for="profile-settings-name">Contact Number</label>
                                        <input type="tel" class="form-control form-control-lg Phone" name="contact" placeholder="Your Contact Number" value="{{auth()->user()->contact}}">
                                        @if($errors->has('contact'))
                                            <p class="text-danger font-weight-bold">{{ $errors->first('contact') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-alt-primary pull-right">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-asterisk mr-5 text-muted"></i> Change Password
                    </h3>
                </div>
                <div class="block-content">
                    <form action="{{route('admin.updatePassword', auth()->user()->id)}}" method="post">
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <p class="text-muted">
                                    Changing your sign in password is an easy way to keep your account secure.
                                </p>
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="profile-settings-password">Current Password</label>
                                        <input type="password" class="form-control form-control-lg" id="profile-settings-password" name="current_password">
                                    </div>
                                </div>
                                @csrf
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="profile-settings-password-new">New Password</label>
                                        <input type="password" class="form-control form-control-lg" id="profile-settings-password-new" name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="profile-settings-password-new-confirm">Confirm New Password</label>
                                        <input type="password" class="form-control form-control-lg" id="profile-settings-password-new-confirm" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-alt-primary">Change</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if(auth()->user()->accountType() == 'Business Developer')
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-paypal mr-5 text-muted"></i> Company Information
                    </h3>
                </div>
                <div class="block-content">
                    <form action="be_pages_generic_profile.edit.html" method="post" onsubmit="return false;">
                        <div class="row items-push">
                            <div class="col-lg-3">
                                <!--<p class="text-muted">-->
                                <!--    Your billing information is never shown to other users and only used for creating your invoices.-->
                                <!--</p>-->
                            </div>
                            <div class="col-lg-7 offset-lg-1">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="profile-settings-company">Company Name (Optional)</label>
                                        <input type="text" class="form-control form-control-lg" id="profile-settings-company" name="profile-settings-company">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="profile-settings-firstname">Firstname</label>
                                        <input type="text" class="form-control form-control-lg" id="profile-settings-firstname" name="profile-settings-firstname">
                                    </div>
                                    <div class="col-6">
                                        <label for="profile-settings-lastname">Lastname</label>
                                        <input type="text" class="form-control form-control-lg" id="profile-settings-lastname" name="profile-settings-lastname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="profile-settings-street-1">Street Address 1</label>
                                        <input type="text" class="form-control form-control-lg" id="profile-settings-street-1" name="profile-settings-street-1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="profile-settings-street-2">Street Address 2</label>
                                        <input type="text" class="form-control form-control-lg" id="profile-settings-street-2" name="profile-settings-street-2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="profile-settings-city">City</label>
                                        <input type="text" class="form-control form-control-lg" id="profile-settings-city" name="profile-settings-city">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="profile-settings-postal">Postal code</label>
                                        <input type="text" class="form-control form-control-lg" id="profile-settings-postal" name="profile-settings-postal">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="profile-settings-vat">VAT Number</label>
                                        <input type="text" class="form-control form-control-lg" id="profile-settings-vat" name="profile-settings-vat" value="IA00000000" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-alt-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            
        </div>
    </main>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>

<script type="text/javascript">
      var cleave = new Cleave('.Phone', {

numericOnly: true,

delimiters: ['-', '-', ' '],

blocks: [3, 3, 4]

});
</script>
@endsection
