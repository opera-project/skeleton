<?php

namespace App\DataFixtures;

use Opera\CoreBundle\Entity\Page;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PageFixtures extends Fixture implements DependentFixtureInterface
{
    const PAGE_BASE = 'PAGE_BASE';
    const PAGE_GLOBAL = 'PAGE_GLOBAL';
    const PAGE_ARTICLE = 'PAGE_ARTICLE';

    public function load(ObjectManager $manager)
    {
        $page = new Page();
        $page->setTitle('exemple de post');
        $page->setSlug('example/de-post');
        $page->setStatus('published');
        $page->setLayout($this->getReference(LayoutFixtures::LAYOUT_DEFAULT));
        $this->addReference(self::PAGE_BASE, $page);
        $manager->persist($page);

        $page = new Page();
        $page->setSlug('_global');
        $page->setStatus('published');
        $page->setTitle('_global');
        $page->setLayout($this->getReference(LayoutFixtures::LAYOUT_DEFAULT));
        $this->addReference(self::PAGE_GLOBAL, $page);
        $manager->persist($page);

        $page = new Page();
        $page->setRoute('page_article');
        $page->setStatus('published');
        $page->setTitle('{{ article.title }}');
        $page->setSlug('articles/{slug}');
        $page->setConfiguration([
            'routing' => [
                'defaults' => [
                    '_controller' => 'App\Controller\ArticleController::article'
                ],
                'methods' => [ 'GET' ],
                'requirements' => [
                    'slug' => '.+',
                ],
            ],
        ]);
        $page->setLayout($this->getReference(LayoutFixtures::LAYOUT_DEFAULT));
        $this->addReference(self::PAGE_ARTICLE, $page);
        $manager->persist($page);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LayoutFixtures::class
        ];
    }
}