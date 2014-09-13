<div class="btn-group" style="width:100%; height: 100%;">
    <button class="btn btn-link" style="height: 100%"><strong>{{$column_name}}</strong></button>
    <button class="btn btn-small" data-toggle="dropdown" style="float:right; height: 100%;">
        {{(isset($sort) && $sort == $field_name) ? (($order == 'asc') ? '↓' : '↑') : '-' }}
    </button>
    <ul class="dropdown-menu">
        <li><a href="{{ URL::route('admin.user') }}?{{($page > 1) ? 'page='.$page : ''}}">-</a></li>
        <li><a href="{{ URL::route('admin.user') }}?{{($page > 1) ? 'page='.$page.'&' : ''}}sort={{$field_name}}&order=asc">Sort asc</a></li>
        <li><a href="{{ URL::route('admin.user') }}?{{($page > 1) ? 'page='.$page.'&' : ''}}sort={{$field_name}}&order=desc">Sort desc</a></li>
    </ul>
</div>