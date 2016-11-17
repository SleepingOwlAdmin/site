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
                    <strong>SleepingOwlAdmin</strong> – административный интерфейс для Laravel...
                </h1>

                <div class="github-buttons">
                    <iframe src="https://ghbtns.com/github-btn.html?user=LaravelRUS&repo=SleepingOwlAdmin&type=star&count=true" frameborder="0" scrolling="0" width="120px" height="20px"></iframe>
                    <iframe src="https://ghbtns.com/github-btn.html?user=LaravelRUS&repo=SleepingOwlAdmin&type=fork&count=true" frameborder="0" scrolling="0" width="120px" height="20px"></iframe>
                </div>
           </div>
        </div>
    </section>
@endsection
