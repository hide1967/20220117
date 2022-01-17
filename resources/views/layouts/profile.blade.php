<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name ="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRFTOKEN-->
    <meta name="csrf-token" content="{{ csrf_token() }}" >

    <title>@yield('title')</title>

    <!--scripts(Laravel搭載のジャバスクリプトを読み込む)-->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--fonts-->

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!--stylesLaravel標準搭載のCSSを読み込み、のちに作成するCSSを読み込む-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet" >
  </head>
  <body>
    <div id="app">
      <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}"> <!--URLを入力できる-->
            {{ config('app.name', 'Laravel') }}<!--コンフィグ関数でconfigapp.phpの値を読み込んでいる。appnameでは、.envに書かれたコードを引っ張ってこれる -->
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" date-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span><!--ブーツトラップのなびばー。これを定型文にして、他に追加したい要素があったらググる -->
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!--Leftsidenavbar-->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!--right sidenavbar-->
            <ul class="navbar-nav ml-auto">
              @guest
                <li>
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
              <!--ログインしていなかったらユーザー名とログアウトボタンを表示する-->
              @else
                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}<!--ユーザーテーブルから名前を取り出す--><span class="caret"></span><!--ブーツトラップのドロップダウンのやつ-->
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                                          document.getElementById('logout-form').submit();">
                          {{ __('logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </div>
                </li>
                @endguest
            </ul>
          </div>
        </div>
      </nav>

      <main class="py-4">
        @yield('content')
      </main>
    </div>
  </body>
</html>
