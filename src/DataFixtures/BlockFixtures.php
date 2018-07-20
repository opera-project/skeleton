<?php

namespace App\DataFixtures;

use Opera\CoreBundle\Entity\Block;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BlockFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $block = new Block();
        $block->setName('Header global');
        $block->setPage($this->getReference(PageFixtures::PAGE_GLOBAL));
        $block->setType('text');
        $block->setArea('header');
        $block->setConfiguration([
            'text' => 'Hello world',
        ]);
        $manager->persist($block);

        $block = new Block();
        $block->setName('Header 1');
        $block->setPage($this->getReference(PageFixtures::PAGE_BASE));
        $block->setType('text');
        $block->setArea('header');
        $block->setConfiguration([
            'text' => 'Hello world',
        ]);
        $manager->persist($block);

        $block = new Block();
        $block->setName('Header 2');
        $block->setPage($this->getReference(PageFixtures::PAGE_BASE));
        $block->setType('text');
        $block->setArea('header');
        $block->setConfiguration([
            'text' => 'Hello world 2',
        ]);
        $manager->persist($block);

        $block = new Block();
        $block->setName('Article content');
        $block->setPage($this->getReference(PageFixtures::PAGE_ARTICLE));
        $block->setType('article');
        $block->setArea('body');
        $block->setConfiguration([]);
        $manager->persist($block);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PageFixtures::class
        ];
    }
}