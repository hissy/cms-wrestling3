<?php
namespace Application\Asset;

use Concrete\Core\Asset\CssAsset;
use Concrete\Core\Config\Repository\Repository;
use Concrete\Core\Support\Facade\Application;

class CustomCssAsset extends CssAsset
{
    public function getAssetType()
    {
        return 'css-custom';
    }

    /**
     * @param Asset[] $assets
     *
     * @return Asset[]
     */
    public static function process($assets)
    {
        if ($directory = self::getOutputDirectory()) {
            $app = Application::getFacadeApplication();
            /** @var Repository $config */
            $config = $app->make('config');
            $filters = $config->get('concrete.assets.minify.filters', []);
            $plugins = $config->get('concrete.assets.minify.plugins', []);
            $relativeDirectory = self::getRelativeOutputDirectory();
            $filename = '';
            $sourceFiles = array();
            for ($i = 0; $i < count($assets); ++$i) {
                $asset = $assets[$i];
                $filename .= $asset->getAssetHashKey();
                $sourceFiles[] = $asset->getAssetURL();
            }
            $filename = sha1($filename);
            $cacheFile = $directory.'/'.$filename.'.css';
            if (!file_exists($cacheFile)) {
                $css = '';
                foreach ($assets as $asset) {
                    $contents = $asset->getAssetContents();
                    if (isset($contents)) {
                        $contents = self::changePaths($contents, $asset->getAssetURLPath(), $relativeDirectory);
                        if ($asset->assetSupportsMinification()) {
                            $contents = \CssMin::minify($contents, $filters, $plugins);
                        }
                        $css .= $contents."\n\n";
                    }
                }
                @file_put_contents($cacheFile, $css);
            }

            $asset = new self();
            $asset->setAssetURL($relativeDirectory.'/'.$filename.'.css');
            $asset->setAssetPath($directory.'/'.$filename.'.css');
            $asset->setCombinedAssetSourceFiles($sourceFiles);

            return array($asset);
        }

        return $assets;
    }
}