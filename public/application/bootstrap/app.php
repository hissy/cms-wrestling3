<?php
/** @var \Concrete\Core\Application\Application $app */
$app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();
if ($app->isInstalled() && $app->isRunThroughCommandLineInterface()) {
    /** @var \Concrete\Core\Console\Application $console */
    $console = $app->make('console');
    $console->add(new \Application\Console\Command\ImageOptimizeCommand());
}

/** @var \Symfony\Component\EventDispatcher\EventDispatcherInterface $director */
$director = $app['director'];

if ($app->isInstalled() && \Concrete\Core\User\User::isLoggedIn() != true) {
    $director->addListener('on_page_output', function ($event) {
        /** @var \Symfony\Component\EventDispatcher\GenericEvent $event */
        $contents = $event->getArgument('contents');
        $minifier = new \zz\Html\HTMLMinify($contents, [
            'doctype' => \zz\Html\HTMLMinify::DOCTYPE_XHTML1,
            'optimizationLevel' => \zz\Html\HTMLMinify::OPTIMIZATION_ADVANCED,
            'emptyElementAddSlash' => false,
            'emptyElementAddWhitespaceBeforeSlash' => false,
            'removeComment' => true,
            'removeDuplicateAttribute' => true,
        ]);
        $event->setArgument('contents', $minifier->process());
    });
}

if ($app->isInstalled() && \Concrete\Core\User\User::isLoggedIn() == true) {
    $director->addListener('on_file_version_add', function ($event) use ($app) {
        $nh = $app->make('helper/number');

        /** @var \Concrete\Core\Entity\File\Version $fv */
        $fv = $event->getFileVersionObject();

        /** @var Concrete\Core\Entity\File\StorageLocation\StorageLocation $fsl */
        $fsl = $fv->getFile()->getFileStorageLocationObject();
        $fsc = $fsl->getConfigurationObject();
        if ($fsc instanceof \Concrete\Core\File\StorageLocation\Configuration\LocalConfiguration) {
            $path = $fv->getFileResource()->getPath();
            $item = $fsc->getRootPath() . '/' . $path;
//dd($item);
            $factory = new \ImageOptimizer\OptimizerFactory($app['config']->get('concrete.assets.optimize'));
            $optimizer = $factory->get();

            $before = filesize($item);
            $optimizer->optimize($item);
            clearstatcache();
            $after = filesize($item);
            \Log::info(sprintf(
                '%s reduced %s -> %s (%d %%)',
                $path,
                $nh->formatSize($before, 'KB'),
                $nh->formatSize($after, 'KB'),
                100 - $nh->flexround($after / $before * 100)
            ));
        }
    });
}

/*
 * ----------------------------------------------------------------------------
 * # Custom Application Handler
 *
 * You can do a lot of things in this file.
 *
 * ## Set a theme by route:
 *
 * Route::setThemeByRoute('/login', 'greek_yogurt');
 *
 *
 * ## Register a class override.
 *
 * Core::bind('helper/feed', function() {
 * 	 return new \Application\Core\CustomFeedHelper();
 * });
 *
 * Core::bind('\Concrete\Attribute\Boolean\Controller', function($app, $params) {
 * 	return new \Application\Attribute\Boolean\Controller($params[0]);
 * });
 *
 * ## Register Events.
 *
 * Events::addListener('on_page_view', function($event) {
 * 	$page = $event->getPageObject();
 * });
 *
 *
 * ## Register some custom MVC Routes
 *
 * Route::register('/test', function() {
 * 	print 'This is a contrived example.';
 * });
 *
 * Route::register('/custom/view', '\My\Custom\Controller::view');
 * Route::register('/custom/add', '\My\Custom\Controller::add');
 *
 * ## Pass some route parameters
 *
 * Route::register('/test/{foo}/{bar}', function($foo, $bar) {
 *  print 'Here is foo: ' . $foo . ' and bar: ' . $bar;
 * });
 *
 *
 * ## Override an Asset
 *
 * use \Concrete\Core\Asset\AssetList;
 * AssetList::getInstance()
 *     ->getAsset('javascript', 'jquery')
 *     ->setAssetURL('/path/to/new/jquery.js');
 *
 * or, override an asset by providing a newer version.
 *
 * use \Concrete\Core\Asset\AssetList;
 * use \Concrete\Core\Asset\Asset;
 * $al = AssetList::getInstance();
 * $al->register(
 *   'javascript', 'jquery', 'path/to/new/jquery.js',
 *   array('version' => '2.0', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => false, 'combine' => false)
 *   );
 *
 * ----------------------------------------------------------------------------
 */
