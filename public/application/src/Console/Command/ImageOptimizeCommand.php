<?php
namespace Application\Console\Command;

use Concrete\Core\Console\Command;
use Concrete\Core\File\Service\File;
use Concrete\Core\Support\Facade\Application;
use ImageOptimizer\OptimizerFactory;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImageOptimizeCommand extends Command
{
    protected static $filetypes = ['png', 'jpg', 'gif'];

    protected function configure()
    {
        $this
            ->setName('c5:image-optimize')
            ->addEnvOption()
            ->addArgument('path', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');

        $factory = new OptimizerFactory();
        $optimizer = $factory->get();

        $app = Application::getFacadeApplication();

        /** @var File $fh */
        $fh = $app->make('helper/file');

        $dir = $fh->getDirectoryContents($path, ['.gitignore'], true);

        foreach ($dir as $item) {
            if (!is_dir($item) && in_array($fh->getExtension($item), self::$filetypes)) {
                $optimizer->optimize($item);
                $output->writeln($item);
            }
        }
    }

}