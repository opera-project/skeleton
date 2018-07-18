<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use App\Repository\BlockRepository;
use App\Entity\Page;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use App\Cms\BlockManager;

class CmsExtension extends AbstractExtension
{
    private $blockRepository;

    private $blockManager;

    private $twig;

    public function __construct(\Twig_Environment $twig, BlockRepository $blockRepository, BlockManager $blockManager)
    {
        $this->twig = $twig;
        $this->blockRepository = $blockRepository;
        $this->blockManager = $blockManager;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('cms_area', [$this, 'cmsArea'], [ 'is_safe' => ['html'] ]),
            new TwigFunction('cms_render', [$this, 'render'], [ 'is_safe' => ['html'] ]),
        ];
    }

    /**
     * cms_area('area_name', page)
     * cms_area('area_name') for global page
     */
    public function cmsArea(string $areaName, ?Page $page = null) : string
    {
        $blocks = $this->blockRepository->findForAreaAndPage($areaName, $page);
        
        $out = '';

        foreach ($blocks as $block) {
            $out .= sprintf('<div id="block_%s">', $block->getId());

            $out .= $this->blockManager->render($block);

            $out .= '</div>';
        }

        return $out;
    }

    /**
     * cms_render('twig {{ code }}')
     * @todo
     */
    public function render(string $twigTemplate) : string
    {   
        return $twigTemplate;
    }
}