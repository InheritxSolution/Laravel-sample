<a class="tbl_sort" href="{{ $base_link }}?page={{ $page }}&order={{ $order }}&dir={{ (Request::get('dir') && Request::get('dir') == 'desc') ? 'asc' : 'desc' }}{{ (!empty($tbl_search)) ? '&q=' . $tbl_search : '' }}">
	{{ $name }} <i class="fa {{ (Request::get('dir') && Request::get('dir') == 'desc' && $order == Request::get('order')) ? 'fa-sort-alpha-desc' : 'fa-sort-alpha-asc' }}"></i>
</a>