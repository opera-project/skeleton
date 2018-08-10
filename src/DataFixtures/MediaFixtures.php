<?php

namespace App\DataFixtures;

use Opera\MediaBundle\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MediaFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $media = new Media();
        $media->setName('photo 1');
        $media->setSlug('photo-1');
        $media->setMime('image/png');
        $media->setSource('images');
        $media->setPath('path/to/image.png');
        $media->setFolder($this->getReference(FolderFixtures::FOLDER_INSTRUMENTS));
        $manager->persist($media);

        $media = new Media();
        $media->setName('photo no folder');
        $media->setSlug('photo-no-folder');
        $media->setMime('image/png');
        $media->setSource('images');
        $media->setPath('path/to/image2.png');
        $manager->persist($media);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            FolderFixtures::class
        ];
    }
}