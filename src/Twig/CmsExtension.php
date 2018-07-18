<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use App\Repository\BlockRepository;
use App\Entity\Page;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use App\Cms\BlockManager;
use App\Cms\Context;

class CmsExtension extends AbstractExtension
{
    private $blockRepository;

    private $blockManager;

    private $cmsContext;

    public function __construct(BlockRepository $blockRepository, BlockManager $blockManager, Context $cmsContext)
    {
        $this->blockRepository = $blockRepository;
        $this->blockManager = $blockManager;
        $this->cmsContext = $cmsContext;
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
        $tplName = uniqid('cms_render_', true);

        $twig = new \Twig_Environment(new \Twig_Loader_Array());        
        $template = $twig->createTemplate($twigTemplate);
        
        return $template->render(
            $this->cmsContext->toArray()
        );
    }
}