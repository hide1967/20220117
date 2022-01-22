@extends('layouts.profile')

@section('title', 'プロフィールの編集')

@section('content')
<!--課題１7-->
  <div class="container">
    <div clas="row">
      <div class="col-md-8 mx-auto">
        <h2>プロフィールの作成画面</h2>
        <form action ="{{ action('Admin\ProfileController@update') }}" method ="post" enctype="multipart/form-data"><!--送信ボタンを押すことで、フォームタグのアクションのURLに飛ぶことができる。フォームタグにはURLを入れることができる-->
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>
                  {{ $e}}
                </li>
              @endforeach
            </ul>
          @endif

            <div class="form-group row">
              <label class="col-md-2" for="name">名前</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="name" value="{{$profile_form->name}}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2" for="gender">性別</label>
              <div class="col-md-10">
                <input type="radio" name="gender" value="male" @if("$profile_form->gender" == "male") checked="checked" @endif>男
                <input type="radio" name="gender" value="female" @if("$profile_form->gender" == "female") checked="checked" @endif>女
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2" for="hobby">趣味</label>
              <div class="col-md-10">
                <input type="search" list="list" name="hobby" value="{{$profile_form->hobby}}">
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
                <textarea class="form-control" name="introduction" rows="20">{{$profile_form->introduction}}</textarea>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-10">
                <input type="hidden" name="id" value="{{ $profile_form->id}}">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="プロフィールを更新">
              </div>
            </div>

        </form>

        <div class="row mt-5">
          <div class="col-md-4 mx-auto">
            <h2>編集履歴</h2>
            <ul class="list-group">
              @if($profile_form->histories !=NULL)
                @foreach($profile_form->histories as $profilehistory)
                    <li class="list-group-item">{{ $profilehistory->edited_at }} </li>
                @endforeach
              @endif
            </ul>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

<!--このnewsレコードに対してhistoriesメソッドを使っています。

historiesは先ほど定義したhasManyを使ったメソッドでしたね。

つまり、このnewsレコードに関連しているhistoriesテーブルすべてを取得するメソッドになっています。

このメソッドを使うから、newsの変更履歴一覧を取得できているわけです。

アロー演算子プロパティやメソッドにアクセスする場合に用いられます-->
