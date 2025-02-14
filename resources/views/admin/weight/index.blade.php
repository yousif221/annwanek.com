@extends('layouts.admin.app')
@section('title', 'weight')
@section('css')
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">weights</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="block pb-15">
                    <div class="block-content">
                        @if(isset($weight))
                            <form method="POST" action="{{route('admin.weight.update', $weight->id)}}">
                            @method('PUT')
                        @else
                            <form method="POST" action="{{route('admin.weight.store')}}">
                        @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-material form-material-primary">
                                                <input type="text" class="form-control" id="title" value="{{(isset($weight))? $weight->name: ''}}" name="title" autocomplete="off">
                                                <label>weight</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="css-control css-control-success css-switch">
                                                <input type="checkbox" name="is_active" class="css-control-input" {{(isset($weight))?($weight->is_active)? 'checked': '':'checked'}}>
                                                <span class="css-control-indicator"></span> Active
                                            </label>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <input type="submit" class="btn btn-primary" value="{{(isset($weight))? 'Update weight': 'Add weight'}}">
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
            </div>
            <div class="col-md-8">
                <div class="block">
                <div class="block-content">
                    <table class="table table-hover table-vcenter">
                        <thead>
                        <tr>
                            <th style="width: 20%;">weight ID</th>
                            <th class="d-none d-sm-table-cell"> weight</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($weights as $key => $weight)
                        <tr>
                            <td>#{{str_pad($weight->id, 5, '0', STR_PAD_LEFT)}}</td>
                            <td>{{$weight->name}}</td>
                            <td class="d-none d-sm-table-cell">
                                @if($weight->is_active)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Hidden</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('admin.weight.edit', $weight->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit weight">
                                        <i class="fa fa-pencil text-primary"></i>
                                    </a>
                                    <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this weight?') == true) document.getElementById('delete-'+{{$weight->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete weight">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <form id="delete-{{$weight->id}}" action="{{ route('admin.weight.destroy',  $weight->id) }}" style="display:none" method="POST">
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
