@extends('app')

@section('body-class', 'donate')

@section('content')
    <article class="container">
        <h1>@lang('site.title.donate')</h1>

        <h3 style="margin-top: 40px;">На что идут деньги от поддержки проекта:</h3>

        <ul>
            <li>Оплата хостинга (400р. в месяц)</li>
            <li>Оплата доменов (1200р. за 1 год)</li>
            <li>Развитие сайта</li>
            <li>Время потраченное на разработку, написание документации и поддержку.</li>
        </ul>
    </article>


    <div class="panel dark" style="margin: 50px 0">
        <div class="container">
            <form method="POST" class="yandex-donate" action="https://money.yandex.ru/quickpay/confirm.xml">
                <svg width="140" height="100" style="margin-left: -10px" viewBox="0 0 140 100" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" fill-rule="evenodd">
                        <path d="M72.964 64.533h-2.16l-.01-23.496H58.167v2.3c0 7.171-.26 15.47-2.742 21.196H53.75v8.468h3.777v-5.043h11.658V73h3.778v-8.468zM89.74 63.01c-1.08.75-2.969 1.82-5.343 1.82-3.346 0-5.073-3.211-5.073-9.311h11.333v-2.301c0-9.15-2.968-12.522-7.502-12.522-5.774 0-8.203 6.314-8.203 14.983 0 8.294 3.454 12.735 9.067 12.735 2.698 0 4.965-.856 6.692-2.193l-.971-3.211zM46.636 41.003v11.511h-6.26v-11.51h-4.21v26.969h4.21V55.807h6.26v12.166h4.156v-26.97h-4.156zm59.629 26.96h4.587l-7.717-14.288 6.746-12.682h-4.264l-6.53 12.468V40.993h-4.21v26.97h4.21V54.53l7.178 13.431zm20.48-1.688l-.972-3.104c-.972.856-2.537 1.659-4.587 1.659-3.4 0-5.02-3.853-5.02-10.595 0-6.796 2.16-10.167 5.181-10.167 1.727 0 3.346.91 4.48 1.873l.594-3.96c-1.188-.749-2.591-1.391-5.02-1.391-6.368 0-9.66 5.404-9.66 13.859 0 9.204 3.508 13.86 9.337 13.86 2.482 0 4.21-.803 5.666-2.034zm-60.048-1.647h-7.232C61.73 58.903 62 50.608 62 44.936v-.481h4.696v20.173zm19.605-12.484H79.34c.27-4.816 1.187-7.973 3.777-7.973 2.429 0 3.185 3.371 3.185 7.973z" fill="#000"/>
                        <path d="M26.841 53.707v14.288h4.156V30.004H24.79c-6.098 0-11.225 4.119-11.225 12.145 0 5.726 2.267 8.83 5.667 10.542L12 67.995h4.803l6.584-14.288h3.454zm-.013-3.333h-2.212c-3.616 0-6.585-1.98-6.585-8.134 0-6.367 3.238-8.64 6.585-8.64h2.212v16.774z" fill="#F00"/>
                    </g>
                </svg>

                <input type="hidden" name="receiver" value="4100192392522">
                <input type="hidden" name="formcomment" value="SleepingOwl Admin">
                <input type="hidden" name="short-dest" value="Поддержка проекта SleepingOwl Admin">
                <input type="hidden" name="quickpay-form" value="donate">
                <input type="hidden" name="successURL" value="{{ route('donate') }}?message=thankyou">
                <input type="hidden" name="targets" value="Поддержка проекта SleepingOwl Admin">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <h3>Сумма</h3>
                            <input type="text"
                                   name="sum"
                                   value="500"
                                   size="15"
                                   maxlength="5"
                                   placeholder="Сумма"
                                   data-type="number"
                                   class="form-control input-sum"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3>Способ перевода средств</h3>
                            <div class="radio">
                                <label> <input type="radio" name="paymentType" value="PC"> Яндекс.Деньгами </label>
                            </div>
                            <div class="radio">
                                <label> <input type="radio" name="paymentType" value="AC"> Банковской картой </label>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary btn-lg" value="Перевести">
            </form>

            <p>Вы также можете осуществить перевод через сайт <a href="https://money.yandex.ru/to/4100192392522/500" target="_blank">Яндекса</a></p>
        </div>
    </div>
    <div class="panel" style="margin: 50px 0">
        <div class="container">
            <img src="https://www.paypalobjects.com/webstatic/paypalme/images/pp_logo_small.png" />
            <br /><br />
            <p>Вы можете осуществить перевод через сайт <a href="https://www.paypal.me/butschster" target="_blank">Paypal</a></p>
        </div>
    </div>
@endsection