<?php
namespace Application\Console\Command;

use Concrete\Core\Console\Command;
use Concrete\Core\File\Service\File;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Utility\Service\Number;
use ImageOptimizer\OptimizerFactory;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImageOptimizeCommand extends Command
{
    protected static $filetypes = ['png', 'jpg', 'jpeg', 'gif'];

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

        $app = Application::getFacadeApplication();

        $factory = new OptimizerFactory($app['config']->get('concrete.assets.optimize'));
        $optimizer = $factory->get();

        /** @var File $fh */
        $fh = $app->make('helper/file');

        /** @var Number $nh */
        $nh = $app->make('helper/number');

        $dir = $fh->getDirectoryContents($path, ['.gitignore'], true);

        foreach ($dir as $item) {
            if (!is_dir($item) && in_array($fh->getExtension($item), self::$filetypes)) {
                $before = filesize($item);
                $optimizer->optimize($item);
                clearstatcache();
                $after = filesize($item);
                $output->writeln(sprintf(
                    '%s reduced %s -> %s (%d %%)',
                    $item,
                    $nh->formatSize($before, 'KB'),
                    $nh->formatSize($after, 'KB'),
                    100 - $nh->flexround($after / $before * 100)
                ));
            }
        }
    }

}