


@extends('layouts.admin.app')
@section('title', 'Dashboard Admin')
@section('content')
<div class="content">
  <!-- Hero -->
	<div class="block block-rounded pb-4" >
        <div class="block-content block-content-full bg-pattern">
          <div class="py-20 text-center">
                <h2 class="font-w700 text-black mb-10">
                    Dashboard
                </h2>
                <h3 class="h5 text-muted mb-0">
                    You are currently logged in as {{auth()->user()->accountType()}}!
                </h3>
            </div>
        </div>
    </div>
</div>
@endsection





