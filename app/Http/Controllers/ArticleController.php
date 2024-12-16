<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function article()
    {
        $articles = [
            [
                "name" => "Aritcle 1",
                "Title" => "Sata is coming to town!"
            ],
            [
                "name" => "Aritcle 2",
                "Title" => "Welcome New Year 2025"
            ],
            [
                "name" => "Aritcle 3",
                "Title" => "Snow is slowly falling down!"
            ],
            [
                "name" => "Aritcle 4",
                "Title" => "New Year Eve is full of fun!"
            ],
            [
                "name" => "Aritcle 5",
                "Title" => "Merry Christmas!"
            ],
        ];


        return view('article.index', compact('articles'));
    }
}
