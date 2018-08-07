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

        $article = new Article();
        $article->setSlug('deuxieme-article');
        $article->setTitle('Exemple de deuxieme article');
        $article->setBody('Lorem ipsum dolor sit amet');
        $manager->persist($article);

        $article = new Article();
        $article->setSlug('article-3');
        $article->setTitle('Exemple de 3 article');
        $article->setBody('Lorem ipsum dolor sit amet');
        $manager->persist($article);

        $manager->flush();
    }
}