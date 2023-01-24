<?php

namespace App\Controller;

use RedBeanPHP\R;

class HomeController extends Controller
{
    public function index() {
        $article = R::findAll('article');
        $this->render('home/home.html.twig', [
            'articles'=>$article,
        ]);
    }
}