@extends('layouts.admin.app')
@section('title', 'Categories')
@section('css')
@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Categories</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="block pb-15">
                    <div class="block-content">
                        @if(isset($category))
                            <form method="POST" action="{{route('admin.category.update', $category->id)}}"enctype="multipart/form-data">
                            @method('PUT')
                        @else
                            <form method="POST" action="{{route('admin.category.store')}}"enctype="multipart/form-data">
                        @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-material form-material-primary">
                                                <input type="text" class="form-control" id="title" value="{{(isset($category))? $category->name: ''}}" name="title" autocomplete="off">
                                                <label>Category Name</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-material form-material-primary">
                                                <input type="text" class="form-control" id="available_count" value="{{(isset($category))? $category->available_count: ''}}" name="available_count" autocomplete="off">
                                                <label>Available Count</label>
                                                @if($errors->has('available_count'))
                                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('available_count') }}</div>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-material form-material-primary">
                                                <input type="text" class="form-control" id="slug" value="{{(isset($category))? $category->slug: ''}}" name="slug" autocomplete="off">
                                                <label>Slug</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-material form-material-primary">
                                                <textarea class="form-control" name="short_description" rows="8"><?= html_entity_decode((isset($category))? $category->short_description: '') ?></textarea>
                                                <label>Short Description</label>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="mt-20">Small  Image</label>
                                        <img class="text-center" src="{{ isset($category) ? asset($category->small_image) : '' }}" alt=""     style="{{ isset($category) ? 'height:50px;width:50px;margin-top:60px;margin-left:39px;' : 'display:none;' }}">

                                            <div class="col-md-12">
                                            <input type="file" class="custom-file-input" id="example-file-input-custom" name="small_image" data-toggle="custom-file-input">
                                            <label class="custom-file-label" for="example-file-input-custom">Choose small Category Image</label>
                                            @if($errors->has('small_image'))
                                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('small_image') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 ">Category Image</label>
                                        <img src="{{ isset($category) ? asset($category->primary_image) : '' }}" alt=""     style="{{ isset($category) ? 'height:150px;width:150px;margin-top:60px;margin-left:89px;' : 'display:none;' }}">

                                            <div class="col-md-12">
                                            <input type="file" class="custom-file-input" id="example-file-input-custom" name="primaryimage" data-toggle="custom-file-input">
                                            <label class="custom-file-label" for="example-file-input-custom">Choose Category Image</label>
                                            @if($errors->has('primaryimage'))
                                            <div class="text-danger ml-5 font-weight-bold">{{ $errors->first('primaryimage') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="css-control css-control-success css-switch">
                                                <input type="checkbox" name="is_active" class="css-control-input" {{(isset($category))?($category->is_active)? 'checked': '':'checked'}}>
                                                <span class="css-control-indicator"></span> Active
                                            </label>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <input type="submit" class="btn btn-primary" value="{{(isset($category))? 'Update Category': 'Add Category'}}">
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
                            <th style="width: 20%;">Category ID</th>
                            <th class="d-none d-sm-table-cell">Category Name</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $key => $category)
                        <tr>
                            <td>#{{str_pad($category->id, 5, '0', STR_PAD_LEFT)}}</td>
                            <td>{{$category->name}}</td>
                            <td class="d-none d-sm-table-cell">
                                @if($category->is_active)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Hidden</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit Category">
                                        <i class="fa fa-pencil text-primary"></i>
                                    </a>
                                    <a href="{{route('admin.category.feature', $category->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="{{($category->is_featured)? 'Unmark as Featured': 'Mark as Featured'}}">
                                    @if($category->is_featured)
                                    <i class="fa fa-star text-warning font-weight-bolder"></i>
                                    @else
                                    <i class="fa fa-star-o text-warning font-weight-bolder"></i>
                                    @endif
                                </a>
                               
                                    <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this Category?') == true) document.getElementById('delete-'+{{$category->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete Category">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <form id="delete-{{$category->id}}" action="{{ route('admin.category.destroy',  $category->id) }}" style="display:none" method="POST">
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
