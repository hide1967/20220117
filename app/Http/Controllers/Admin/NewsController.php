<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
    //
    public function add(){
      return view('admin.news.create');
    }
//14章で追記
    public function create(Request $request){

      //validationを追記
      $this->validate($request, News::$rules);

      $news = new News;
      $form = $request->all();

      //フォームから画像が送信されてきたら、保存して、$news->image_pathに画像のパスを保存する
      if(isset($form['image'])){
        $path =$request->file('image')->store('public/image');
        $news->image_path = basename($path);
      }else{
        $news->image_path = null;
      }
      //フォームから送品されてきた＿token、imageを削除する
      unset($form['_token']);
      unset($form['image']);
      //DBに保存する
      $news->fill($form);
      $news->save();

      return redirect('admin/news/create');

      //ルートからcreateアクションが発動するとnews/createにリダイレクトする。
    }
}
