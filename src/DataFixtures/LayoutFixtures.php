<?php

namespace App\DataFixtures;

use Opera\CoreBundle\Entity\Layout;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LayoutFixtures extends Fixture
{
    const LAYOUT_DEFAULT = 'LAYOUT_DEFAULT';

    public function load(ObjectManager $manager)
    {
        $layout = new Layout();
        $layout->setName('default');
        $layout->setConfiguration([
            'areas' => [
                'H' => 'header',
                'B' => 'body'
            ],
            'layout' => [
                'H H H H',
                'B B B B',
                'B B B B',
            ]
        ]);

        $manager->persist($layout);
        $this->addReference(self::LAYOUT_DEFAULT, $layout);

        $manager->flush();
    }
}