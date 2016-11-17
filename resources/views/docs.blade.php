@extends('app')

@section('content')
<nav id="slide-menu" class="slide-menu" role="navigation">

	<div class="brand">
		<a href="/">
            {!! svg('logo') !!}
		</a>
	</div>

	<ul class="slide-main-nav">
		<li><a href="/">@lang('site.menu.home')</a></li>
		@include('partials.main-nav')
	</ul>

	<div class="slide-docs-nav">
		<h2>@lang('site.menu.docs')</h2>
		{!! $index !!}
	</div>
</nav>

<div class="docs-wrapper container">
	<section class="sidebar">
		<h3>@lang('site.menu.docs')</h3>
		{!! $index !!}
	</section>

	<article>
		{!! $content !!}
	</article>
</div>
@endsection
