@if(!$version->isEmpty())
    <table class="table table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>{{ trans('string.version') }}</th>
                <th>{{ trans('string.device_type') }}</th>
                <th>{{ trans('string.force_update') }}</th>
                <th>{{ trans('string.created_at') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($version as $cm)
            <tr>
                <td><?= (!empty($cm->version_name)) ? ucfirst(str_replace('_', ' ', $cm->version_name)) : '-' ?></td>
                <td><?= (!empty($cm->device_type)) ? ((($cm->device_type)=='ios') ? trans('string.ios') : trans('string.android')) : '-' ?></td>
                <td><?= ($cm->force_update==0) ? 'No' : 'Yes' ?></td>
                <td>
                @php
                    if(!empty($cm->updated_at))
                    {
                        $get_date = $cm->updated_at;
                        $date_replace = str_replace('-', '/', $get_date);
                        $updated_date = date('m-d-Y', strtotime($date_replace));
                        
                    }
                    else
                    {
                        $updated_date = '-';
                    }
                @endphp
                {{ $updated_date }}
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p style="text-align: center">{{ trans('string.no_data_found') }}</p>
    @endif

    @if(!$version->isEmpty())
    {{-- <div class="panel-footer">
        <div class="row">

            <div class="col-md-3 col-sm-3 col-xs-12 pull-left">
                <div class="row">
                    <div class="col-md-2">
                        <span>Show</span></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select id="pagination_row" class="form-control pagination-rows-select" title="Change number of data per page">
                                @foreach(config('params.pagination.rows') as $row)
                                <option value="{{$row}}" {{(Request::get('row') == $row) ? 'selected' : ''}}>{{$row}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-offset-2 col-md-2 col-sm-4 col-xs-12 ">
                <div class="pull-left pagination-page-info">
                    {{ trans('string.page') . ' ' . $version->currentPage() . ' ' . trans('string.of') . ' ' .  $version->lastPage() }}
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 pull-right">
                <div class="pull-right pagination-button">
                    {{ $version->links() }}
                </div>
            </div>
        </div>
    </div> --}}
    @endif