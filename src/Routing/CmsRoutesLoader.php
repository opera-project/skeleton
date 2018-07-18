<?php

namespace App\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Repository\PageRepository;

class CmsRoutesLoader extends Loader
{
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function load($resource, $type = null)
    {        
        $routes = new RouteCollection();

        $routedPages = $this->pageRepository->findAllRoutes();
        
        foreach ($routedPages as $routedPage) {
            $path = sprintf('/%s', $routedPage->getSlug());
            $config = $routedPage->getConfiguration()['routing'];
            
            $route = new Route($path, $config['defaults'], $config['requirements'] ?? []);
            if (isset($config['methods'])) {
                $route->setMethods($config['methods']);
            }

            $routes->add($routedPage->getRoute(), $route);
        }

        return $routes;
    }

    public function supports($resource, $type = null)
    {
        return 'cms' === $type;
    }
}