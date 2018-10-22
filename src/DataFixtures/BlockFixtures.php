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
        $block->setName('Navigation');
        $block->setPage($this->getReference(PageFixtures::PAGE_GLOBAL));
        $block->setType('twig');
        $block->setArea('header');
        $block->setConfiguration([
            'code' => '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>',
        ]);
        $manager->persist($block);

        $block = new Block();
        $block->setName('Copyright');
        $block->setPage($this->getReference(PageFixtures::PAGE_GLOBAL));
        $block->setType('twig');
        $block->setArea('footer');
        $block->setConfiguration([
            'code' => '
          <footer class="py-5 bg-dark">
            <div class="container">
              <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
            </div>
          </footer>',
        ]);
        $manager->persist($block);

        $block = new Block();
        $block->setName('Header 1');
        $block->setPage($this->getReference(PageFixtures::PAGE_HOME));
        $block->setType('twig');
        $block->setArea('header');
        $block->setConfiguration([
            'code' => '<header class="business-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="display-3 text-center text-white mt-4">Business Name or Tagline</h1>
          </div>
        </div>
      </div>
    </header>',
        ]);
        $manager->persist($block);

        $block = new Block();
        $block->setName('What we do and contact');
        $block->setPage($this->getReference(PageFixtures::PAGE_HOME));
        $block->setType('twig');
        $block->setArea('body');
        $block->setConfiguration([
            'code' => '<div class="row">
            <div class="col-sm-8">
              <h2 class="mt-4">What We Do</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deserunt neque tempore recusandae animi soluta quasi? Asperiores rem dolore eaque vel, porro, soluta unde debitis aliquam laboriosam. Repellat explicabo, maiores!</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis optio neque consectetur consequatur magni in nisi, natus beatae quidem quam odit commodi ducimus totam eum, alias, adipisci nesciunt voluptate. Voluptatum.</p>
              <p>
                <a class="btn btn-primary btn-lg" href="#">Call to Action &raquo;</a>
              </p>
            </div>
            <div class="col-sm-4">
              <h2 class="mt-4">Contact Us</h2>
              <address>
                <strong>Start Bootstrap</strong>
                <br>3481 Melrose Place
                <br>Beverly Hills, CA 90210
                <br>
              </address>
              <address>
                <abbr title="Phone">P:</abbr>
                (123) 456-7890
                <br>
                <abbr title="Email">E:</abbr>
                <a href="mailto:#">name@example.com</a>
              </address>
            </div>
          </div>',
        ]);
        $manager->persist($block);

        $block = new Block();
        $block->setName('Cards');
        $block->setPage($this->getReference(PageFixtures::PAGE_HOME));
        $block->setType('twig');
        $block->setArea('body');
        $block->setConfiguration([
            'code' => '<div class="row">
            <div class="col-sm-4 my-4">
              <div class="card">
                <img class="card-img-top" src="http://placehold.it/300x200" alt="">
                <div class="card-body">
                  <h4 class="card-title">Card title</h4>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus.</p>
                </div>
                <div class="card-footer">
                  <a href="#" class="btn btn-primary">Find Out More!</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4 my-4">
              <div class="card">
                <img class="card-img-top" src="http://placehold.it/300x200" alt="">
                <div class="card-body">
                  <h4 class="card-title">Card title</h4>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus totam ut praesentium aut.</p>
                </div>
                <div class="card-footer">
                  <a href="#" class="btn btn-primary">Find Out More!</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4 my-4">
              <div class="card">
                <img class="card-img-top" src="http://placehold.it/300x200" alt="">
                <div class="card-body">
                  <h4 class="card-title">Card title</h4>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
                </div>
                <div class="card-footer">
                  <a href="#" class="btn btn-primary">Find Out More!</a>
                </div>
              </div>
            </div>
          </div>',
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