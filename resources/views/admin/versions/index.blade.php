@extends('layouts.app')

    @section('title', trans('string.version_update'))

    @section('content')
    <div class="row">
        <!-- DOM dataTable -->
        <div class="col-md-12">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">{{ trans('string.version_update') }}</h4>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                    <a href="{{route('version.create')}}"><input type="button" class="btn btn-primary" value="Add New"></a>
                                </div>
                                <div class="col-sm-3 col-xs-12 pull-right">
                                </div>
                                @include('layouts.indextable_hidden', ['table' => 'product-category-table'])
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="version-table">
                            @include('admin.versions.indextable')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
