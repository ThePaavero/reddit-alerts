
<h1>Reddit-Alerts v.0.0.1</h1>

<a href='{{ URL::action('RedditController@search', ['helsinki']) }}' class='btn'>Refresh</a>

<ol>
@foreach($data['items'] as $i)
	<li>
		<a href='{{ $i->url }}' target='_blank'><h2>{{ $i->title }}</h2></a>
	</li>
@endforeach
</ol>

@if (Auth::check())
<a href='<?php echo URL::to('logout'); ?>'>Logout</a>
@else
<a href='<?php echo URL::to('login'); ?>'>Login</a>
@endif
