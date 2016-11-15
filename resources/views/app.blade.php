<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>{{ isset($title) ? $title . ' - ' : null }}SleepingOwl - Админ панель для Laravel</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="author" content="Taylor Otwell">
	<meta name="description" content="Laravel - The PHP framework for web artisans.">
	<meta name="keywords" content="laravel, php, framework, web, artisans, taylor otwell">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@if (isset($canonical))
		<link rel="canonical" href="{{ url($canonical) }}" />
	@endif

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&amp;subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" href="{{ elixir('assets/css/laravel.css') }}">
	<link rel="apple-touch-icon" href="/favicon.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
</head>
<body class="@yield('body-class', 'docs') language-php">

	<span class="overlay"></span>

	<nav class="main">
		<a href="/" class="brand nav-block">
			{!! svg('logo') !!}
			<span>SleepingOwlAdmin</span>
		</a>

        <div class="search nav-block">
            {!! svg('search') !!}
            <input placeholder="Поиск по документации" type="text" v-model="search" id="search-input" v-on:blur="reset" />
        </div>

		<ul class="main-nav" v-if="! search">
			@include('partials.main-nav')
		</ul>

        <div class="responsive-sidebar-nav">
			<a href="#" class="toggle-slide menu-link btn">&#9776;</a>
		</div>
	</nav>

	@yield('content')

	<footer class="main">
		<ul>
			@include('partials.main-nav')
		</ul>
	</footer>

	<script>
		var algolia_app_id      = '<?php echo Config::get('algolia.connections.main.id', false); ?>';
		var algolia_search_key  = '<?php echo Config::get('algolia.connections.main.search_key', false); ?>';
	</script>

	@include('partials.algolia_template')

	<script src="{{ elixir('assets/js/laravel.js') }}"></script>

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
		(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
				try {
					w.yaCounter40925319 = new Ya.Metrika({
						id:40925319,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true,
						webvisor:true
					});
				} catch(e) { }
			});

			var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
			s.type = "text/javascript";
			s.async = true;
			s.src = "https://mc.yandex.ru/metrika/watch.js";

			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/40925319" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
</body>
</html>
