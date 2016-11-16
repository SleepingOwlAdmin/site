@extends('app')

@section('body-class')
the-404
@endsection

@section('content')
	
	<div class="contain">
		<div class="media">
			<img src="/assets/img/lamp-post.jpg">
		</div>
		<div class="content">
			<h1>@lang('site.error.404')</h1>
		</div>
	</div>

@endsection