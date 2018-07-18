<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends Controller
{   
    protected function renderPage(array $variables)
    {
        $page = $this->getRequest()->get('page');

        return $this->render(
            sprintf('layouts/%s.html.twig', $page->getLayout()),
            array_merge($variables, [
                'page' => $page,
            ])
        );
    }

    protected function getRequest()
    {
        return $this->get('request_stack')->getCurrentRequest();
    }
}
