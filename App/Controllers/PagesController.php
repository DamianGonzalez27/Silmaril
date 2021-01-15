<?php namespace App\Controllers;

use App\Core\Controller;

class PagesController extends Controller
{

    public function index()
    {
        return $this->getView('home');
    }

    public function agenda()
    {
        return $this->getView('agenda');
    }
}