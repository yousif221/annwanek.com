@extends('layouts.admin.error')
@section('title', 'Service not Available')
@section('content')
    <main id="main-container">
        <div class="hero bg-white">
            <div class="hero-inner">
                <div class="content content-full">
                    <div class="py-30 text-center">
                        <div class="display-3 text-elegance">
                            <i class="fa fa-database"></i> 503
                        </div>
                        <h1 class="h2 font-w700 mt-30 mb-10">Oops.. You just found an error page..</h1>
                        <h2 class="h3 font-w400 text-muted mb-50">We are sorry but our service is currently not available..</h2>
                        <a class="btn btn-hero btn-rounded btn-alt-secondary" href="{{route('admin.panel')}}">
                            <i class="fa fa-arrow-left mr-10"></i> Ignore
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
