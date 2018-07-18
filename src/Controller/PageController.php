<?php

namespace App\Controller;

class PageController extends BaseController
{
    public function index()
    {
        return $this->renderPage();
    }
}
