<div class="list">
	@foreach($lists as $list)
	<a href="/lists/{{ $list->id }}"><img class="common-list-icon" src="/img/list_icon/{{ $list->id }}.png"></a>
	@endforeach
</div>