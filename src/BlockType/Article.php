<?php

namespace App\BlockType;

use Symfony\Component\HttpFoundation\RequestStack;

class Article extends BaseBlock implements BlockTypeInterface
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getType() : string
    {
        return 'article';
    }

    public function getVariables() : array
    {
        return [
            'article' => $this->requestStack->getCurrentRequest()->get('article'),
        ];
    }
}