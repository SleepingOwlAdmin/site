@extends('app')

@section('body-class', 'home')

@section('content')
    <nav id="slide-menu" class="slide-menu" role="navigation">

        <div class="brand">
            <a href="/">
                {!! svg('logo') !!}
            </a>
        </div>

        <ul class="slide-main-nav">
            @include('partials.main-nav')
        </ul>
    </nav>

    <section class="panel features hero">
        <div class="container">

            <div class="content">
                <h1>
                    <strong>SleepingOwlAdmin</strong> – is an administrative interface builder for Laravel...
                </h1>
                <p style="text-align: center">
                    for your application, so you can create awesomeness.
                </p>

                <div class="github-buttons" style="text-align: center; margin-top: 40px">
                    <iframe src="https://ghbtns.com/github-btn.html?user=LaravelRUS&repo=SleepingOwlAdmin&type=star&count=true&size=large" frameborder="0" scrolling="0" width="160px" height="30px"></iframe>
                    <iframe src="https://ghbtns.com/github-btn.html?user=LaravelRUS&repo=SleepingOwlAdmin&type=watch&count=true&size=large&v=2" frameborder="0" scrolling="0" width="160px" height="30px"></iframe>
                    <iframe src="https://ghbtns.com/github-btn.html?user=LaravelRUS&repo=SleepingOwlAdmin&type=fork&count=true&size=large" frameborder="0" scrolling="0" width="158px" height="30px"></iframe>
                </div>
           </div>
        </div>
    </section>
    {{--
    <section class="panel features">
        <div class="container">
            <div class="callout rule">
                <span class="text">Just a few of SleepingOwlAdmin features</span>
            </div>

            <div class="callouts">
                <a href="/docs/scout" class="callout minimal third">
                    <div class="callout-head">
                        <div class="callout-title">Laravel Scout</div>
                    </div>
                    <p>Driver based full-text search for Eloquent, complete with pagination and automatic indexing.</p>
                </a>
                <a href="/docs/broadcasting" class="callout minimal third">
                    <div class="callout-head">
                        <div class="callout-title">Laravel Echo</div>
                    </div>
                    <p>Event broadcasting, evolved. Bring the power of WebSockets to your application without the complexity.</p>
                </a>
                <a href="/docs/passport" class="callout minimal third">
                    <div class="callout-head">
                        <div class="callout-title">Laravel Passport</div>
                    </div>
                    <p>API authentication without the headache. Passport is an OAuth2 server that's ready in minutes.</p>
                </a>
            </div>
        </div>
    </section>
    --}}
@endsection
