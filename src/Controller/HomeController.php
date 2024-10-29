<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Translation\LocaleSwitcher;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, LocaleSwitcher $localeSwitcher): Response
    {
        if($request->getSession()->has('_locale')) {
            $lang = $request->getSession()->get('_locale');
        } else {
            $lang = "en";
        }
        $localeSwitcher->setLocale($lang);

        return $this->render('home.html.twig');
    }
}
