<?php

/**
 * Description of CategorieCommand
 *
 * @author Kevin FERRANDON
 */

namespace AppBundle\Command;

use \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
//use Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategorieAddCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('app:create:category')
                ->setDescription('You can build default categories')
                ->setHelp('This command will build business defaults categories for you')
                ->addArgument('category', InputArgument::REQUIRED, 'Category of your business ex: Lawyer, General, Restaurant...');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $io = new SymfonyStyle($input, $output);
        $io->title('We will configure defaults categories for you');
        switch ($input->getArgument('category')) {
            case 'restaurant':
                $this->addRestaurants($io);

                break;
            case 'general':
                $io->write('General default categories in progress');
                break;
            case 'lawyer':
                $this->addLawyer($io);
                $io->write('Law default categories in progress');
                break;
            default:
                $io->error('Missmatch category please choose restaurant, general, or lawyer');
                break;
        }
        
    }

    private function addRestaurants(SymfonyStyle $io) {
        $io->write('Restaurant default categories in progress');
        $restaurants = ['Cuisine traditionnelle', 'Restaurant gastronomique',
            'Crêperie', 'Pizzeria', 'FastFood', 'Traiteur', 'Brasserie',
            'Food truck', 'Auberge', 'Cuisine du monde', 'Cours de cuisine',
            'Autour de la cuisine', 'Végétarien', 'Bio', 'Végan'];
        $io->writeln(' ');
        $io->progressStart(count($restaurants));

        foreach ($restaurants as $restaurant) {
            $io->progressAdvance();
            $io->write(' ' . $restaurant);
            $cat = new \AppBundle\Entity\Category();
            $cat->setName($restaurant);
            $cat->setRoot(0);
            $cat->setUsable(true);
            $this->getContainer()->get(\AppBundle\Manager\CategoryManager::class)->addCategory($cat);
            //   sleep(1);
        }
        $io->progressFinish();
        $io->success('Categories created');
    }

    private function addLawyer(SymfonyStyle $io) {
        $io->write('Restaurant default categories in progress');
        $lawyers = ['Famille', 'Travail',
            'Santé', 'Routier', 'Immobilier', 'Consommation', 'Travail',
            'Public', 'Pénal', 'Etrangers', 'Environnement',
            'Divorce', 'Assurances', 'Affaires', 'Banques', 'Fiscal', 'Internationnal'];
        $io->writeln(' ');
        $io->progressStart(count($lawyers));
        foreach ($lawyers as $lawyer) {
            $io->progressAdvance();
            $io->write(' ' . $lawyer);
            $cat = new \AppBundle\Entity\Category();
            $cat->setName($lawyer);
            $cat->setRoot(0);
            $cat->setUsable(true);
            $this->getContainer()->get(\AppBundle\Manager\CategoryManager::class)->addCategory($cat);
            //   sleep(1);
        }
        $io->progressFinish();
        $io->success('Categories created');
    }

}
