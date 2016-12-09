@extends('app')

@section('body-class')
the-404
@endsection

@section('content')
	
	<div class="contain">
		<div class="media">
			<img src="/assets/img/404.jpg" style="max-width:200px !important;">
		</div>
		<div class="content">
			<h1>@lang('site.error.404.fact'.rand(1,10))</h1>
		</div>
	</div>

@endsection