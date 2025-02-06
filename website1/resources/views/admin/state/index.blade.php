@extends('layouts.admin.app')
@section('title', 'States')
@section('css')
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">States</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="block pb-15">
                    <div class="block-content">
                        @if(isset($state))
                            <form method="POST" action="{{route('admin.state.update', $state->id)}}"enctype="multipart/form-data">
                            @method('PUT')
                        @else
                            <form method="POST" action="{{route('admin.state.store')}}"enctype="multipart/form-data">
                        @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-material form-material-primary">
                                                <input type="text" class="form-control" id="title" value="{{(isset($state))? $state->name: ''}}" name="title" autocomplete="off">
                                                <label>State Name</label>
                                            </div>
                                        </div>
                                    </div>

                               
       
                                    <div class="form-group row">
                                        <label class="col-12 ">state Image</label>
                                        <img src="{{ isset($state) ? asset($state->primary_image) : '' }}" alt=""     style="{{ isset($state) ? 'height:150px;width:150px;margin-top:60px;margin-left:89px;' : 'display:none;' }}">

                                            <div class="col-md-12">
                                            <input type="file" class="custom-file-input" id="example-file-input-custom" name="primaryimage" data-toggle="custom-file-input">
                                            <label class="custom-file-label" for="example-file-input-custom">Choose state Image</label>
                                            @if($errors->has('primaryimage'))
                                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('primaryimage') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="css-control css-control-success css-switch">
                                                <input type="checkbox" name="is_active" class="css-control-input" {{(isset($state))?($state->is_active)? 'checked': '':'checked'}}>
                                                <span class="css-control-indicator"></span> Active
                                            </label>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <input type="submit" class="btn btn-primary" value="{{(isset($state))? 'Update state': 'Add state'}}">
                                        </div>
                                    </div>
                                    @csrf
                                </div>
                            </div>
                            @if($errors->any())
                                <div class="text-danger">*{{$errors->first()}}</div>
                            @endif
                        </form>
                    </div>
                </div>
           
            <div class="col-md-8">
                <div class="block">
                <div class="block-content">
                    <table class="table table-hover table-vcenter">
                        <thead>
                        <tr>
                            <th style="width: 20%;">state ID</th>
                            <th class="d-none d-sm-table-cell">state Name</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($states as $key => $state)
                        <tr>
                            <td>#{{str_pad($state->id, 5, '0', STR_PAD_LEFT)}}</td>
                            <td>{{$state->name}}</td>
                            <td class="d-none d-sm-table-cell">
                                @if($state->is_active)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Hidden</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('admin.state.edit', $state->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit state">
                                        <i class="fa fa-pencil text-primary"></i>
                                    </a>

                               
                                    <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this state?') == true) document.getElementById('delete-'+{{$state->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete state">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <form id="delete-{{$state->id}}" action="{{ route('admin.state.destroy',  $state->id) }}" style="display:none" method="POST">
                             {{ method_field('DELETE') }}
                             {{ csrf_field() }}
                        </form>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
 
        $('#title').keyup(function() {
        let text = $(this).val().toLowerCase();
        text = text.replace(/[^a-z0-9]+/g, '-');
        $('#slug').val(text);
    });
    </script>
@endsection
