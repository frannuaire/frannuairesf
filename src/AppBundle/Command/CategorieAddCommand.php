<?php


namespace AppBundle\Command;

use \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
//use Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
/**
 * Description of CategorieCommand
 *
 * @author Kevin FERRANDON
 */
class CategorieAddCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('app:create:category')
             ->setDescription('You can build default categories')
             ->setHelp('This command will build business defaults categories for you')
             ->addArgument('categorie', InputArgument::REQUIRED, 'Categorie of your business ex: Law, Directory, Restaurant...');
                
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $io = new SymfonyStyle($input, $output);
        $io->title('We will configure defaults categories for you');

        // ...
    }

}
