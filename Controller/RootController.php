<?php

namespace App\Controller;

class RootController extends AbstractController
{
    /**
     * Render la home page.
     * @return void
     */
    public function index()
    {
        $this->display('home/index');
    }
    public function pageAcceuil()
    {
        $this->display('test/home');
    }


}
