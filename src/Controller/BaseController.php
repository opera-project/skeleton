<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends Controller
{   
    protected function renderPage(array $variables = array())
    {
        $page = $this->getRequest()->get('page');

        $variables = array_merge($variables, [
            'page' => $page,
        ]);
        $this->get(\App\Cms\Context::class)->setVariables($variables);

        return $this->render(
            sprintf('layouts/%s.html.twig', $page->getLayout()),
            $variables
        );
    }

    protected function getRequest()
    {
        return $this->get('request_stack')->getCurrentRequest();
    }
}
