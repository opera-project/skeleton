<?php

namespace App\Maker;

use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Bundle\MakerBundle\Validator;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Validator\Validation;

class BlockMaker extends AbstractMaker
{
    public static function getCommandName(): string
    {
        return 'make:block';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig)
    {
        $command
            ->setDescription('Create a new cms block')
            ->addArgument('block-name', InputArgument::OPTIONAL, sprintf('The block name (e.g. <fg=yellow>%s</>)', Str::asClassName(Str::getRandomTerm())))
        ;
        $inputConfig->setArgumentAsNonInteractive('block-name');
    }

    public function interact(InputInterface $input, ConsoleStyle $io, Command $command)
    {
        if (null === $input->getArgument('block-name')) {
            $argument = $command->getDefinition()->getArgument('block-name');
            $question = new Question($argument->getDescription());
            $value = $io->askQuestion($question);
            $input->setArgument('block-name', $value);
        }
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {
        $classDetail = $generator->createClassNameDetails($input->getArgument('block-name'), 'BlockType');

        $generator->generateClass(
            $classDetail->getFullName(),
            __DIR__.'/../Resources/skeleton/block.tpl.php',
            [
                'block' => $input->getArgument('block-name'),
            ]
        );

        $generator->generateFile(
            'templates/blocks/'.$input->getArgument('block-name').'.html.twig',
            __DIR__.'/../Resources/skeleton/block_twig.tpl.php',
            [
                'block' => $input->getArgument('block-name'),
            ]
        );

        $generator->writeChanges();
        $this->writeSuccessMessage($io);

    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
        
    }
}