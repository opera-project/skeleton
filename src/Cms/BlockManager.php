<?php

namespace App\Cms;

use App\Entity\Block;
use App\BlockType\BlockTypeInterface;

class BlockManager
{
    private $blockTypes = [];

    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(Block $block) : string
    {
        if (!isset($this->blockTypes[$block->getType()])) {
            throw new \LogicException('Cms cant manage this kind of blocks '.$block->getType());
        }

        $blockType = $this->blockTypes[$block->getType()];

        $variables = array_merge($blockType->getVariables(), [
            'block' => $block,
        ]);

        return $this->twig->render(
            sprintf('blocks/%s.html.twig', $blockType->getTemplate()),
            $variables
        );
    }

    public function registerBlockType(BlockTypeInterface $blockType)
    {
        $this->blockTypes[$blockType->getType()] = $blockType;
    }
}