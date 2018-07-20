<?php

namespace App\Controller;

use App\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Opera\CoreBundle\Controller\BaseController;

class ArticleController extends BaseController
{   
    /**
     * @Entity("article", expr="repository.findOneBySlug(slug)")
     */
    public function article(Article $article)
    {
        return $this->renderPage([
            'article' => $article,
        ]);
    }
}
