@extends('layouts.profile')

@section('title', 'プロフィールの作成画面')

@section('content')
<!--課題１４－４-->
  <div class="container">
    <div clas="row">
      <div class="col-md-8 mx-auto">
        <h2>プロフィールの作成画面</h2>
        <form action ="{{ action('Admin\ProfileController@create') }}" method ="post" enctype="multipart/form-data"><!--送信ボタンを押すことで、フォームタグのアクションのURLに飛ぶことができる。フォームタグにはURLを入れることができる-->
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)<<!--エラーのすべてを取り出して、配列＄eにしている-->
                <li>
                  {{ $e}}
                </li>
              @endforeach
            </ul>
          @endif

            <div class="form-group row">
              <label class="col-md-2" for="name">名前</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2" for="gender">性別</label>
              <div class="col-md-10">
                <input type="radio" name="gender" value="male" checked="checked">男
                <input type="radio" name="gender" value="female">女
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2" for="hobby">趣味</label>
              <div class="col-md-10">
                <input type="search" list="list" name="hobby">
                <datalist id="list">
                  <option value="サッカー">
                  <option value="野球">
                  <option value="ソフトボール">
                </datalist>
                <input type="submit" value="検索">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2" for="introduction">自己紹介</label>
              <div class="col-md-10">
                <textarea class="form-control" name="introduction" rows="20"　placeholder="私の名前は田中太郎です。">{{ old('body') }}</textarea>
              </div>
            </div>
            {{ csrf_field() }}
            <input type="submit" class="btn btn-primary" value="プロフィールを作成">
        </form>
      </div>
    </div>
  </div>
@endsection
