<?php
namespace Application\Asset;

use Concrete\Core\Asset\CssAsset;
use Concrete\Core\Html\Object\HeadLink;

class CssMediaQueriedAsset extends CssAsset
{
    protected $assetSupportsCombination = false;
    protected $media = 'all';

    public function getAssetType()
    {
        return 'css-media-queried';
    }

    public function register($filename, $args, $pkg = false)
    {
        parent::register($filename, $args, $pkg);
        $this->media = $args['media'];
    }

    public function __toString()
    {
        $e = new HeadLink($this->getAssetURL(), 'stylesheet', 'text/css', $this->media);
        if (count($this->combinedAssetSourceFiles)) {
            $source = '';
            foreach ($this->combinedAssetSourceFiles as $file) {
                $source .= $file.' ';
            }
            $source = trim($source);
            $e->setAttribute('data-source', $source);
        }

        return (string) $e;
    }
}