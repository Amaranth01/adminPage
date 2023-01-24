<?php

namespace App\Controller;

use RedBeanPHP\R;

class ArticleController extends Controller
{
    public function index() {
        $article = R::findAll('article');
        $this->render('home/home.html.twig', [
            'articles'=>$article,
        ]);
    }
    public function addArticlePage () {
        $this->render('article/addArticle.html.twig');
    }

    public function addArticle () {
        $article = R::dispense('article');
        $article->articleTitle = $this->clean($this->getFormField('title'));
        $article->articleContent = $this->clean($this->getFormField('content'));
        R::store($article);

        self::index();
    }
}