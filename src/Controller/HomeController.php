<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    public function indexAction(Request $request): Response
    {
        return $this->render('index.html.twig');
    }
}
