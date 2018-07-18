<?php

namespace App\DataFixtures;

use App\Entity\Layout;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LayoutFixtures extends Fixture
{
    const LAYOUT_DEFAULT = 'LAYOUT_DEFAULT';

    public function load(ObjectManager $manager)
    {
        $layout = new Layout();
        $layout->setName('default');
        $manager->persist($layout);
        $this->addReference(self::LAYOUT_DEFAULT, $layout);

        $manager->flush();
    }
}