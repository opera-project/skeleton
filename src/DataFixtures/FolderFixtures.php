<?php

namespace App\DataFixtures;

use Opera\MediaBundle\Entity\Folder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class FolderFixtures extends Fixture
{
    const FOLDER_INSTRUMENTS = 'FOLDER_INSTRUMENTS';

    public function __construct()
    {
    }

    public function load(ObjectManager $manager)
    {
        $parentFolder1 = new Folder();
        $parentFolder1->setName('instruments');
        $parentFolder1->setSlug('instruments');
        $parentFolder1->setSource('images');
        $this->addReference(self::FOLDER_INSTRUMENTS, $parentFolder1);
        $manager->persist($parentFolder1);
        

        $parentFolder2 = new Folder();
        $parentFolder2->setName('musiciens');
        $parentFolder2->setSlug('musiciens');
        $parentFolder2->setSource('images');
        $manager->persist($parentFolder2);

        $folder1 = new Folder();
        $folder1->setName('corde');
        $folder1->setSlug('corde');
        $folder1->setSource('images');
        $manager->persist($folder1);

        $folder2 = new Folder();
        $folder2->setName('vent');
        $folder2->setSlug('vent');
        $folder2->setSource('images');
        $manager->persist($folder2);

        $folder3 = new Folder();
        $folder3->setName('percussion');
        $folder3->setSlug('percussion');
        $folder3->setSource('images');
        $manager->persist($folder3);

        $parentFolder1->addChild($folder1);
        $parentFolder1->addChild($folder2);
        $parentFolder1->addChild($folder3);

        $manager->flush();
    }
}