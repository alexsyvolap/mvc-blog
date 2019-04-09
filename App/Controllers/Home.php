<?php

namespace App\Controllers;

use Core\Controller;
use Core\Redirect;

class Home extends Controller
{

    /**
     * Просто редиректим с / на /news
     */
    public function redirectAction()
    {
        Redirect::to('/news');
    }

}