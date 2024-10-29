<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Translation\LocaleSwitcher;

class LanguageController extends AbstractController
{
    #[Route('/set-language/{lang}', name: 'set_language')]
    public function setLanguage(Request $request, string $lang, LocaleSwitcher $localeSwitcher): Response
    {
        $request->getSession()->set('_locale', $lang);
        $localeSwitcher->setLocale($lang);

        return $this->redirect($request->headers->get('referer'));
    }
}
