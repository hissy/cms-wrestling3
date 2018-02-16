<?php
namespace Application\Theme\CmsWrestling3;

use Application\Asset\CssMediaQueriedAsset;
use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;
use Concrete\Core\Asset\Asset;
use Concrete\Core\Asset\AssetList;
use Concrete\Core\Html\Object\HeadLink;
use Concrete\Core\Http\ResponseAssetGroup;
use Concrete\Core\Page\Theme\Theme;

class PageTheme extends Theme implements ThemeProviderInterface
{
    public function getThemeName()
    {
        return t('CMS Wrestling 3');
    }

    public function getThemeDescription()
    {
        return t('CMS Wrestling The Fastest King Championship ( cms sunday vol.9 )');
    }

    public function registerAssets()
    {
        $al = AssetList::getInstance();

        $asset = new CssMediaQueriedAsset('cms_wrestling3/vtngq900000002qh');
        $asset->register(
            'themes/cms_wrestling3/assets/css/vtngq900000002qh.css',
            [
                'position' => Asset::ASSET_POSITION_HEADER,
                'local' => true,
                'version' => false,
                'combine' => false,
                'minify' => true,
                'media' => 'all and (min-width: 641px)'
            ]
        );
        $al->registerAsset($asset);

        $asset = new CssMediaQueriedAsset('cms_wrestling3/vtngq900000002qc');
        $asset->register(
            'themes/cms_wrestling3/assets/css/vtngq900000002qc.css',
            [
                'position' => Asset::ASSET_POSITION_HEADER,
                'local' => true,
                'version' => false,
                'combine' => false,
                'minify' => true,
                'media' => 'screen and (min-width: 0px) and (max-width: 640px)'
            ]
        );
        $al->registerAsset($asset);

        $asset = new CssMediaQueriedAsset('cms_wrestling3/vtngq900000002q7');
        $asset->register(
            'themes/cms_wrestling3/assets/css/vtngq900000002q7.css',
            [
                'position' => Asset::ASSET_POSITION_HEADER,
                'local' => true,
                'version' => false,
                'combine' => false,
                'minify' => true,
                'media' => 'print'
            ]
        );
        $al->registerAsset($asset);

        $al->register(
            'css',
            'cms_wrestling3/prospect',
            'themes/cms_wrestling3/assets/css/prospect.css'
        );

        $al->register(
            'javascript',
            'cms_wrestling3/vtngq900000002r1',
            'themes/cms_wrestling3/assets/js/vtngq900000002r1.js'
        );

        $al->register(
            'javascript',
            'cms_wrestling3/vtngq900000002qw',
            'themes/cms_wrestling3/assets/js/vtngq900000002qw.js'
        );

        $al->register(
            'javascript',
            'cms_wrestling3/vtngq900000002qr',
            'themes/cms_wrestling3/assets/js/vtngq900000002qr.js'
        );

        $al->register(
            'javascript',
            'cms_wrestling3/vtngq900000002qm',
            'themes/cms_wrestling3/assets/js/vtngq900000002qm.js'
        );

        $al->register(
            'javascript-conditional',
            'cms_wrestling3/vtngq900000002rb',
            'themes/cms_wrestling3/assets/js/vtngq900000002rb.js',
            ['conditional' => 'lt IE 9']
        );

        $al->register(
            'javascript',
            'cms_wrestling3/vtngq900000002r6',
            'themes/cms_wrestling3/assets/js/vtngq900000002r6.js'
        );

        $al->register(
            'javascript',
            'cms_wrestling3/vtngq900000002qw',
            'themes/cms_wrestling3/assets/js/vtngq900000002qw.js'
        );

//        $al->register(
//            'javascript-inline',
//            'cms_wrestling3/no-conflict',
//            'var $1_12_4 = $.noConflict();' // WTF is this?
//        );

        $al->register(
            'javascript',
            'cms_wrestling3/prospect',
            'themes/cms_wrestling3/assets/js/prospect.js'
        );

        $al->registerGroup('cms_wrestling3', [
            ['javascript', 'jquery'],
            ['css-media-queried', 'cms_wrestling3/vtngq900000002qh'],
            ['css-media-queried', 'cms_wrestling3/vtngq900000002qc'],
            ['css-media-queried', 'cms_wrestling3/vtngq900000002q7'],
            ['css', 'cms_wrestling3/prospect'],
//            ['javascript', 'cms_wrestling3/vtngq900000002r1'], // jquery
            ['javascript', 'cms_wrestling3/vtngq900000002qw'],
            ['javascript', 'cms_wrestling3/vtngq900000002qr'],
            ['javascript', 'cms_wrestling3/vtngq900000002r6'],
            ['javascript', 'cms_wrestling3/vtngq900000002qm'],
            ['javascript-conditional', 'cms_wrestling3/vtngq900000002rb'],
            ['javascript', 'cms_wrestling3/vtngq900000002qw'],
            ['javascript', 'cms_wrestling3/prospect'],
        ]);

        $this->requireAsset('cms_wrestling3');

        $this->providesAsset('javascript-conditional', 'respond');

        $r = ResponseAssetGroup::get();
        $r->addHeaderAsset(new HeadLink($this->getThemeURL() . '/assets/images/favicon.ico', 'shortcut icon'));
    }

    public function getThemeAreaLayoutPresets()
    {
        return [];
    }
}
