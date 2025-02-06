@extends('layouts.admin.app')
@section('title', 'Account Information')
@section('css')
@endsection
@section('content')
    <main id="main-container">
        <div class="bg-image bg-image-bottom mt-30" style="background-image: url({{asset('storage/images/profile-bg.jpg')}});">
            <div class="bg-black-op-75 py-30">
                <div class="content content-full text-center">
                    <div class="mb-15">
                        <a class="img-link" href="javascript:void(0)">
                            <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{($user->profile_image != null)?asset($user->profile_image) :asset('storage/images/profile/placeholder.jpg')}}" alt="{{$user->username}}">
                        </a>
                    </div>
                    <h1 class="h3 text-white font-w700 mb-10">{{$user->name()}}</h1>
                    <h2 class="h5 text-white-op">
                        {{$user->accountType()}} - <a class="text-primary-light" href="mailto:{{$user->email}}">{{$user->email}}</a>
                    </h2>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="block">
                        <div class="block-content">
                            <h2 class="content-heading">Account Information</h2>
                            <form action="{{route('admin.profileUpdate', $user->id)}}" method="POST" enctype="multipart/form-data">
                                <div class="row items-push">
                                    <div class="col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="profile-settings-username">First Name</label>
                                                <input type="text" class="form-control form-control-lg" name="f_name" placeholder="Your First Name" value="{{$user->name(1)}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="profile-settings-username">Last Name</label>
                                                <input type="text" class="form-control form-control-lg" name="l_name" placeholder="Your Last Name" value="{{$user->name(2)}}">
                                            </div>
                                        </div>
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="profile-settings-name">Username</label>
                                                <input type="text" class="form-control form-control-lg" name="username" placeholder="Your Username" value="{{$user->username}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="profile-settings-email">Email Address</label>
                                                <input type="email" class="form-control form-control-lg" name="email" placeholder="Your Email Address" value="{{$user->email}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="profile-settings-name">Contact Number</label>
                                                <input type="tel" class="form-control form-control-lg" name="contact" placeholder="Your Contact Number" value="{{$user->contact}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="profile-settings-name">Password <small>(Only fill if you want to change the password)</small></label>
                                                <input type="password" class="form-control form-control-lg" name="password" placeholder="password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label class="css-control css-control-success css-switch">
                                                    <input type="checkbox" name="is_active" class="css-control-input" {{($user->is_active)? 'checked': ''}}>
                                                    <span class="css-control-indicator"></span> {{($user->is_active)? 'Active': 'Inactive'}}
                                                </label>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-alt-primary pull-right">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @isset($bds)
                        <h2 class="content-heading">Junior <small>Business Developer(s)</small></h2>
                        <div class="row">
                            @forelse($bds as $member)
                                <div class="col-md-6 col-xl-4">
                                    <a class="block block-link-pop text-center" href="{{route('admin.account', $member->id)}}">
                                        <div class="block-content block-content-full">
                                            <img class="img-avatar" src="{{($member->profile_image != null)?asset($member->profile_image) :asset('storage/images/profile/placeholder.jpg')}}" alt="{{$member->username}}">
                                        </div>
                                        <div class="block-content block-content-full bg-body-light">
                                            <div class="font-w600 mb-5">{{$member->name()}}</div>
                                            <div class="font-size-sm text-muted">{{$member->email}}</div>
                                            <div class="font-size-sm text-muted">ID: {{$member->id}}</div>
                                            @if($member->is_active)
                                                <button type="button" class="btn btn-rounded btn-noborder p-0 btn-success font-size-xs min-width-75 m-10">Active</button>
                                            @else
                                                <button type="button" class="btn btn-rounded btn-noborder p-0 btn-danger font-size-xs min-width-75 m-10">Disabled</button>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <p class="muted m-20">No Junior Business Developer associated with the Account.</p>
                            @endforelse
                        </div>
                    @endisset
                    @isset($sellers)
                    <h2 class="content-heading">Seller(s)</h2>
                    <div class="row">
                        @forelse($sellers as $member)
                            <div class="col-md-6 col-xl-4">
                                <a class="block block-link-pop text-center" href="{{route('admin.account', $member->id)}}">
                                    <div class="block-content block-content-full">
                                        <img class="img-avatar" src="{{($member->profile_image != null)?asset($member->profile_image) :asset('storage/images/profile/placeholder.jpg')}}" alt="{{$member->username}}">
                                    </div>
                                    <div class="block-content block-content-full bg-body-light">
                                        <div class="font-w600 mb-5">{{$member->name()}}</div>
                                        <div class="font-size-sm text-muted">{{$member->email}}</div>
                                        <div class="font-size-sm text-muted">ID: {{$member->id}}</div>
                                        @if($member->is_active)
                                            <button type="button" class="btn btn-rounded btn-noborder p-0 btn-success font-size-xs min-width-75 m-10">Active</button>
                                        @else
                                            <button type="button" class="btn btn-rounded btn-noborder p-0 btn-danger font-size-xs min-width-75 m-10">Disabled</button>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="muted m-20">No Seller associated with the Account.</p>
                        @endforelse
                    </div>
                    @endisset
                    @isset($manufacturers)
                    <h2 class="content-heading">Manufacturer(s)</h2>
                    <div class="row">
                        @forelse($manufacturers as $member)
                            <div class="col-md-6 col-xl-4">
                                <a class="block block-link-pop text-center" href="{{route('admin.account', $member->id)}}">
                                    <div class="block-content block-content-full">
                                        <img class="img-avatar" src="{{($member->profile_image != null)?asset($member->profile_image) :asset('storage/images/profile/placeholder.jpg')}}" alt="{{$member->username}}">
                                    </div>
                                    <div class="block-content block-content-full bg-body-light">
                                        <div class="font-w600 mb-5">{{$member->name()}}</div>
                                        <div class="font-size-sm text-muted">{{$member->email}}</div>
                                        <div class="font-size-sm text-muted">ID: {{$member->id}}</div>
                                        @if($member->is_active)
                                            <button type="button" class="btn btn-rounded btn-noborder p-0 btn-success font-size-xs min-width-75 m-10">Active</button>
                                        @else
                                            <button type="button" class="btn btn-rounded btn-noborder p-0 btn-danger font-size-xs min-width-75 m-10">Disabled</button>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="muted m-20">No Manufacturer associated with the Account.</p>
                        @endforelse
                    </div>
                    @endisset
                    @if($payments->count())
                    <div class="block">
                        <div class="block-content">
                            <h2 class="content-heading">Billing Information</h2>
                            <table class="table table-bordered text-center table-striped table-vcenter js-dataTable-full">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Amount</th>
                                    <th>Purpose</th>
                                    <th>status</th>
                                    <th>Action</th>
                                    <th>Paid On</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($payments as $key => $payment)
                                    <tr>
                                        <td>#{{str_pad($payment->id, 5, '0', STR_PAD_LEFT)}}</td>
                                        <td>${{number_format($payment->amount,2,".",".")}}</td>
                                        <td>{{(explode(':',$payment->purpose)[0] == 'subscription_create')? 'Subscription Fee': 'Payment'}}</td>
                                        <td>
                                            @if($payment->status == 'paid')
                                            <button type="button" class="btn btn-rounded btn-noborder p-0 btn-success font-size-xs min-width-75 m-10">{{$payment->status}}</button>
                                            @else
                                            <button type="button" class="btn btn-rounded btn-noborder p-0 btn-danger font-size-xs min-width-75 m-10">{{$payment->status}}</button>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{$payment->receipt_url}}" target="_blank" title="view Stripe Receipt">
                                                <i class="fa fa-cc-stripe" style="font-size: 2em"></i>
                                            </a>
                                        </td>
                                        <td>{{date('Y/m/d H:i', strtotime($payment->created_at))}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Payment Received</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-3">
                @if($user->referrer != null)
                    <h2 class="content-heading">Parent <br /><small>Business Developer</small></h2>
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <a class="block block-link-shadow" href="{{route('admin.account', $user->referrer)}}">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-right">
                                        <img class="img-avatar" src="{{(getUser($user->referrer)->profile_image != null)?asset(getUser($user->referrer)->profile_image) :asset('storage/images/profile/placeholder.jpg')}}" alt="{{getUser($user->referrer)->username}}">
                                    </div>
                                    <div class="float-left mt-10">
                                        <div class="font-w600 mb-5" style="max-width: 125px;">{{getUser($user->referrer)->name()}}</div>
                                        <div class="font-size-sm text-muted">ID: #{{str_pad(getUser($user->referrer)->id, 5, '0', STR_PAD_LEFT)}}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
                @if($user->hasRole('Business Developer'))
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <a class="block block-link-shadow text-right" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="float-left mt-10 d-none d-sm-block">
                                    <i class="si si-users fa-3x text-body-bg-dark"></i>
                                </div>
                                <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="500" data-to="{{$bds->count()+$sellers->count()+$manufacturers->count()}}">{{$bds->count()+$sellers->count()+$manufacturers->count()}}</div>
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Team Members</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <a class="block block-link-shadow text-right" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="float-left mt-10 d-none d-sm-block">
                                    <i class="si si-wallet fa-3x text-body-bg-dark"></i>
                                </div>
                                <div class="font-size-h3 font-w600">${{$earning}}</div>
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Earning</div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
            </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
@endsection
