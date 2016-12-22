<!doctype html>
<!--

 „_„
(O,O)
(`"')
-"-"---soa-

-->
<html>
<head>
	<meta charset="utf-8">
	<title>{{ isset($title) ? $title . ' - ' : null }} @lang('site.title.meta')</title>
	<meta name="author" content="butschster">
	<meta name="description" content="@lang('site.title.meta')">
	<meta name="keywords" content="laravel, php, framework, admin">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	@if (isset($canonical))
		<link rel="canonical" href="{{ url($canonical) }}" />
	@endif

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&amp;subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" href="{{ elixir('assets/css/app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
	<link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>

<body class="@yield('body-class', 'docs') language-php">
	<span class="overlay"></span>

	<header class="main">
		<a href="/" class="brand nav-block">
			{!! svg('logo') !!}
			<span>SleepingOwlAdmin</span>
		</a>

        <div class="search nav-block">
            {!! svg('search') !!}
            <input placeholder="@lang('site.search.placeholder')" type="text" v-model="search" id="search-input" v-on:blur="reset" />
        </div>

        <div class="responsive-sidebar-nav">
			<a href="#" class="toggle-slide menu-link btn">&#9776;</a>
		</div>
	</header>

	<div class="header-menu-container">
		<nav class="container header-menu">
			<ul class="main-nav">
				@include('partials.main-nav')
				@include('partials.switcher')
			</ul>
		</nav>
	</div>

	@yield('content')

	{{--
	<footer class="main">
		<ul>
			@include('partials.main-nav')
		</ul>
	</footer>
	--}}

	@include('partials.algolia_template')

	<script src="{{ elixir('assets/js/app.js') }}"></script>

	@include('partials.metrics')
</body>
</html>
