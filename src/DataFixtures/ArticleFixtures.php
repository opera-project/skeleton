<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setSlug('exemple');
        $article->setTitle('Exemple d\'article');
        $article->setBody('Lorem ipsum');
        $manager->persist($article);

        $manager->flush();
    }
}