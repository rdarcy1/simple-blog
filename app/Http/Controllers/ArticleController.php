<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

/**
 * Class ArticleController
 *
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => 'create']);
    }

    /**
     * Display a paginated listing of articles.
     *
     * @param int $currentPage
     * @return \Illuminate\Http\Response
     */
    public function index($currentPage = 1)
    {
        $perPage = 5;
        $numberOfPages = ceil(count(Article::all()) / $perPage);

        $currentPage = clamp($currentPage, 1, $numberOfPages);

        $articles = Article::orderBy('published_on', 'desc')
            ->skip($perPage * ($currentPage - 1))
            ->take($perPage)
            ->get();

        return view('articles.index', compact('articles', 'currentPage', 'numberOfPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Redirect
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article($request->all());
        Auth::user()->articles()->save($article);

        Session::flash('flash_message', 'Article created.');

        return redirect('/articles/' . $article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest|Request $request
     * @param Article                $article
     * @return Redirect
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all())->save();

        Session::flash('flash_message', 'Article updated.');

        return redirect(route('articles.show', $article->id));
    }

    /**
     * Remove the specified resource from storage.
     * Only delete if confirmed parameter is sent.
     *
     * @param Request $request
     * @param Article $article
     * @return Redirect
     */
    public function destroy(Request $request, Article $article)
    {
        if ( ! $request->input('confirmed')) {
            return redirect(route('articles.confirmDelete', $article->id));
        }

        $article->delete();

        Session::flash('flash_message', 'Article deleted.');

        return redirect(route('articles.index'));
    }

    /**
     * Require confirmation before deleting an article.
     *
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmDelete(Article $article)
    {
        return view('articles.confirm_delete', compact('article'));
    }
}
