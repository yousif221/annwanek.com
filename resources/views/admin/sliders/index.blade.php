@extends('layouts.admin.app')
@section('title', 'Property Slider Index')
@section('css')
@endsection
@section('content')
<div class="content">
    <h2 class="content-heading">Manage Sliders <a href="{{ route('admin.sliders.create_heading') }}" class="btn btn-alt-primary pull-right">Add New Heading</a></h2>
    <div class="block">
        <div class="block-content">
            <table class="table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th>Headings</th>
                       
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                
                    @forelse($headings as $heading)
                    
                       
                            <tr>
                                <td>{{ $heading->title }}</td>
                              
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.sliders.edit_heading', $heading->id) }}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit Heading">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.sliders.show_slide', $heading->id) }}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Slide">
                                        <i class="fa fa-eye text-primary"></i>
                                        </a>
                                        <a href="javascript:;" onclick="if(confirm('Are you sure about deleting this Heading?') == true) document.getElementById('delete-'+{{$heading->id}}).submit();" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete Heading">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                        <form id="delete-{{$heading->id}}" action="{{ route('admin.sliders.delete_heading', $heading->id) }}" style="display:none" method="POST">
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