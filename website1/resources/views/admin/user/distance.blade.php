@extends('layouts.admin.app')

@section('title', 'Distance')

@section('css')

<style>

    .start{

    background: #fff ;

    box-shadow: 0 0 10PX 0 #000;

    border-radius: 50% ;

    padding: 100px 90px;

    font-size: 50px;

    font-weight: 800;

    color: #3f9ce8 !important;

    cursor: pointer;

    }

    .start:hover{

    background: #fff ;

    box-shadow: 0 0 10PX 0 rgb(112, 144, 180);

    border-radius: 50% ;

    padding: 105px 95px;

    font-size: 50px;

    font-weight: 800;

    }

</style>

@endsection

@section('content')

    <div class="content">

        <h2 class="content-heading">Distance Details{{$user->first_name}}</h2>

        <div class="block">

            <div class="block-content">

                <table class="table table-hover table-vcenter">

                    <thead>

                    <tr>

                        <th>Walking #</th>

                        <th>Start Date</th>

                        <th>Start Time</th>

                        <th>End Date</th>

                        <th>End Time</th>
                        <th>Reward Coin</th>
                        <th>Distance</th>

                        {{-- <th>Order Status</th> --}}

                        {{-- <th class="text-center" style="width: 100px;">Actions</th> --}}

                    </tr>

                    </thead>

                    <tbody>

                        @forelse($distancs as $key => $distance)

                    <tr>

                        <td>{{ $key+1 }}</td>

                        <td>{{ \Carbon\Carbon::parse($distance->start)->format('d-M-Y')}}</td>

                        <td>{{ \Carbon\Carbon::parse($distance->start)->format('H:i') }}</td>

                        <td>{{ \Carbon\Carbon::parse($distance->end)->format('d-M-Y')}}</td>

                        <td>{{ \Carbon\Carbon::parse($distance->end)->format('H:i') }}</td>
                        <td>{{ $distance->last_distance *50 }}</td>
                        <td>{{ $distance->last_distance }}</td>

                        {{-- <td class="text-center">

                            <i class="fa fa-eye"></i>

                        </td> --}}

                    </tr>
                    @empty
                     <tr>

                        <td colspan="7" class="text-center"><p class="text-uppercase m-20 font-weight-bold">{{$user->first_name}} not listed any Distance yet.</p></td>

                    </tr>
                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection

@section('js')

<script>

function logout(){

    document.getElementById('logout').submit();

}

</script>

@endsection

