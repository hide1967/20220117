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
        $path =$request->file('image')->store('public/image');//リクエストで送られてきた情報のうち、imageという名前のものをファイルとして、public/image配下に保存して、その結果保存したファイルのパスを$pathに代入するという処理になります。
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

    public function index(Request $request){
      $cond_title =$request->cond_title;
      if($cond_title != ''){
        //検索されたら検索結果を取得する
        $posts = News::where('title', $cond_title)->get();
      }else{
        //それ以外はすべてのニュースを取得する
        $posts = News::all();
      }
      return view('admin.news.index', ['posts'=>$posts, 'cond_title'=>$cond_title]);
    }
    //では、このcond_titleはいったいどこから現れたのでしょうか？
    //それは、最後のreturn view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);がRequestにcond_titleを送っているのです。
    //最初に開いた段階では、cond_titleは存在しないのです。これは投稿したニュースを検索するための機能として活用します。
    //cond_titleはユーザの入力した文字、検索ボックスの文字
    //whereメソッドでnewsテーブルの中を取り出せる

    public function edit(Request $request){
      $news= News::find($request->id);
      if(empty($news)){
        abort(404);
      }
      return view('admin.news.edit', ['news_form'=>$news]);
    }

    public function update(Request $request){
      $this->validate($request, News::$rules);
      $news=News::find($request->id);// News Modelからデータを取得する
      $news_form=$request->all();// 送信されてきたフォームデータを格納する

      if($request->remove=='true'){
        $news_form['image_path']=null;//removeならnullでOK
      }elseif($request->file('image')){
        $path=$request->file('image')->store('public/image');//画像があったら再保存する
        $news_form['image_path']=basename($path);
      }else{
        $news_form['image_path']=$news->image_path;//画像がそのままならそのまま
      }

      unset($news_form['image']);
      unset($news_form['remove']);

      unset($news_form['_token']);//トークンの削除
      $news->fill($news_form)->save();// 該当するデータを上書きして保存する$news->fill($form);$news->save();を省略したもの

      return redirect('admin/news');
    }

    public function delete(Request $request){
      $news= News::find($request->id);
      $news->delete();
      return redirect('admin/news/');
    }
}
