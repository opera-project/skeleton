<?php

namespace App\DataFixtures;

use Opera\CoreBundle\Entity\Layout;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LayoutFixtures extends Fixture
{
    const LAYOUT_DEFAULT = 'LAYOUT_DEFAULT';
    const LAYOUT_TWO_COL = 'LAYOUT_TWO_COL';

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

        $layout = new Layout();
        $layout->setName('two-columns'); // name of the .html.twig
        $layout->setConfiguration([
            'areas' => [ // names of the differents area of this template layout
                'H' => 'header',
                'B' => 'body',
                'S' => 'sidebar',
            ],
            'layout' => [ // visual representation of the layout
                'H H H S',
                'B B B S',
                'B B B S',
            ]
        ]);
        $manager->persist($layout);
        $this->addReference(self::LAYOUT_TWO_COL, $layout);

        $manager->flush();
    }
}