<li class="switcher">
	<div class="dropdown">
		<button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			{{ ucfirst(locale()->getCurrent()) }}
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			@foreach (locale()->getAvailableLocalesWithHosts() as $locale => $host)
				<li role="presentation">
					<a role="menuitem" tabindex="-1" href="{{ $host }}">{{ ucfirst($locale) }}</a>
				</li>
			@endforeach
		</ul>
	</div>
</li>
