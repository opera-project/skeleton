<?php

namespace App\BlockType;

use Symfony\Component\HttpFoundation\RequestStack;
use Opera\CoreBundle\BlockType\BlockTypeInterface;
use Opera\CoreBundle\BlockType\BaseBlock;
use Opera\CoreBundle\Entity\Block;

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

    public function execute(Block $block) : array
    {
        return [
            'article' => $this->requestStack->getCurrentRequest()->get('article'),
        ];
    }
}
