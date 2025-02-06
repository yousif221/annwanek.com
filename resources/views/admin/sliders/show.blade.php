@extends('layouts.admin.app')
@section('title', 'Property Slider Index')
@section('css')
@endsection
@section('content')
<div class="content">
    <h2 class="content-heading">Manage Slids <a href="{{ route('admin.sliders.index') }}" class="btn btn-alt-primary pull-right">Back</a> <a href="{{ route('admin.sliders.create_slide', $heading->id) }}"style="margin-right:10px;" class="btn btn-alt-primary pull-right">Add New Slide</a></h2>
    <div class="block">
        <div class="block-content">
            <table class="table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th>title</th>
                       
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                
                    @forelse($slide as $heading)
                    
                       
                            <tr>
                                <td>{{ $heading->title }}</td>
                              
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.sliders.edit_slide', $heading->id) }}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Add Slide">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                       
                                        <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this Slid?') == true) document.getElementById('delete-'+{{$heading->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete Slider">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                                <form id="delete-{{$heading->id}}" action="{{ route('admin.sliders.delete_slide', $heading->id) }}" style="display:none" method="POST">
                         {{ method_field('DELETE') }}
                         {{ csrf_field() }}
                    </form>
                                </td>
                            </tr>
                 
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <p class="text-uppercase m-20 font-weight-bold">No sliders available.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
    
@section('js')
@endsection