$(document).ready(function() {
	var queryString = getUrlQueryString();
	
	//disable submit button after submit.
	$('form').submit(function() {
		//$(this).block({ message: null });
		$(this).find("input[type='submit'], button[type='submit']").prop('disabled', true);
	});
	
	//auto hide flash message
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 5000);
	
	//delete button click
	$(document).on('click', '.btn-delete-submit', function() {
		var con = confirm($(".table_delete_data").data('delete_data'));
		if(con)
		{
			$("#" + $(this).data('id')).submit();
		}
	});
	
	//ajax pagination button click
	$('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        pagination(url);
    });
	
	//ajax row select
	$('body').on('change', '.pagination-rows-select, .pagination-filter-select', function(e) {
		e.preventDefault();
        var url = $("#pagination_action").data('action');
		var queryString = getUrlQueryString();
		if($.isEmptyObject(queryString) === false)
		{
			if(queryString.page && queryString.page !== '1')
			{
				pagination(url + "&page=1");
			}
			else
			{
				pagination(url);
			}
		}
		else
		{
			pagination(url + "?page=1");
		}
    });
	
	//ajax sorting
	$('body').on('click', '.tbl_sort', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        pagination(url);
    });
	
	//ajax search
	$("#pagination_search").keyup(function() {
		var queryString = getUrlQueryString();
		if($.isEmptyObject(queryString) === false && queryString.page && queryString.page !== '1')
		{
			var url = $("#pagination_action").data('action') + '&page=1';
		}
		else
		{
			var url = '';
		}
		
		pagination(url);
	});
	
	//set full URL
	$('#pagination_action').data('action', window.location.href);
	
	//onrefresh preserve search val if present
	if($.isEmptyObject(queryString) === false && queryString.q)
	{
		$("#pagination_search").val(queryString.q);
	}
});

//ajax pagination
function pagination(url)
{
	var search = $('#pagination_search').val();
	if(url === '' && !search && !sessionStorage.getItem('prev_search'))
	{
		return false;
	}
	
	sessionStorage.setItem('prev_search', search);
	
	var row = $('#pagination_row').val();
	var filter = ($('#pagination_filter').val()) ? $('#pagination_filter').val() : '';
	
	if(url !== '')
	{
		var action = url;
	}
	else
	{
		var action = $("#pagination_action").data('action');
	}
	
	$.ajax({
		url: action,
		data: { q: search, row: row, filter: filter },
		success: function(result){
			$('.' + $("#pagination_action").data('bind-to')).empty().html(result);
		},
		error: function() {
			$('.' + $("#pagination_action").data('bind-to')).empty().html('<p class="panel-body" style="text-align: center">' + $('.table_no_data_found').data('no-data-found') + '</p>');
		}
	});
	
	window.history.pushState("", "", url);
	$("#pagination_action").data('action', url);
}

function getUrlQueryString()
{
    var vars = {};
    window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
	
    return vars;
}

$('#main-back-arrow').click(function(){

	current = window.location.href;
	current_path = current.split('/');

	haveDraftOption = $('#have_draft_option').val();
	user_role = $('#currentrole').val();

	window.location = $(this).attr('data-href');
	

});

