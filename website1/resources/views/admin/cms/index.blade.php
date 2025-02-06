@extends('layouts.admin.app')
@section('title', 'Content Management')
@section('css')

@endsection
@section('content')
    <div class="content">
        <h2 class="content-heading">Content Management</h2>
        <div class="block">
            <div class="block-content">
                <table class="js-table-sections table table-hover">
                    <thead>
                    <tr>
                        <th style="width: 10%;"></th>
                        <th>Page</th>
                        <th style="width: 15%;">Sections</th>
                        <th class="d-none d-sm-table-cell" style="width: 25%;">Last Updated</th>
                    </tr>
                    </thead>
                    @foreach($contents->groupBy('page') as $page => $content)
                    <tbody class="js-table-sections-header {{ ($page == 'Home Page')? 'show table-active': ''}}">
                        <tr>
                            <td class="text-center">
                                <i class="fa fa-angle-right"></i>
                            </td>
                            <td class="font-w600">{{$page}}</td>
                            <td>
                                <span class="badge badge-success">{{sizeof($content->groupBy('section'))}}</span>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{date("F j, Y, g:i", strtotime($content->sortByDesc('updated_at')->first()->updated_at))}}</em>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                        @php($uniqueSection = array())
                        @foreach($content as $section)
                        @if(!in_array($section->section, $uniqueSection))
                        <tr>
                            <td class="text-center"></td>
                            <td class="font-w600 text-success"><a href="{{route('admin.content.edit', $section->id)}}">{{$section->section}}</a></td>
                            <td class="text-center"></td>
                            <td class="d-none d-sm-table-cell">
                                <span class="font-size-sm text-muted">{{date("F j, Y, g:i", strtotime($section->updated_at))}}</span>
                            </td>
                        </tr>
                        @php(array_push($uniqueSection, $section->section))
                        @endif
                        @endforeach
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        jQuery('.js-table-sections:not(.js-table-sections-enabled)').each((index, element) => {
            let table = jQuery(element);
            table.addClass('js-table-sections-enabled');
            jQuery('.js-table-sections-header > tr', table).on('click.cb.helpers', e => {
                if (e.target.type !== 'checkbox'
                    && e.target.type !== 'button'
                    && e.target.tagName.toLowerCase() !== 'a'
                    && !jQuery(e.target).parent('a').length
                    && !jQuery(e.target).parent('button').length
                    && !jQuery(e.target).parent('.custom-control').length
                    && !jQuery(e.target).parent('label').length) {
                    let row    = jQuery(e.currentTarget);
                    let tbody  = row.parent('tbody');

                    if (!tbody.hasClass('show')) {
                        jQuery('tbody', table).removeClass('show table-active');
                    }

                    tbody.toggleClass('show table-active');
                }
            });
        });
    </script>
@endsection
