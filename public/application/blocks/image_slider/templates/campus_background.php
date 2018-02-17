<?php defined('C5_EXECUTE') or die("Access Denied.");
$navigationTypeText = ($navigationType == 0) ? 'arrows' : 'pages';
$c = Page::getCurrentPage();
if ($c->isEditMode()) {
    $loc = Localization::getInstance();
    $loc->pushActiveContext(Localization::CONTEXT_UI);
    ?>
    <div class="ccm-edit-mode-disabled-item" style="<?php echo isset($width) ? "width: $width;" : '' ?><?php echo isset($height) ? "height: $height;" : '' ?>">
        <i style="font-size:40px; margin-bottom:20px; display:block;" class="fa fa-picture-o" aria-hidden="true"></i>
        <div style="padding: 40px 0px 40px 0px"><?php echo t('Image Slider disabled in edit mode.')?>
            <div style="margin-top: 15px; font-size:9px;">
                <i class="fa fa-circle" aria-hidden="true"></i>
                <?php if (count($rows) > 0) { ?>
                    <?php foreach (array_slice($rows, 1) as $row) { ?>
                        <i class="fa fa-circle-thin" aria-hidden="true"></i>
                    <?php }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    $loc->popActiveContext();
} else {
    if (count($rows) > 0) {
        echo '<ul class="bg_list" id="js-bg_list">';
        foreach ($rows as $row) {
            $f = File::getByID($row['fID']);
            if (is_object($f)) {
                $image = $f->getThumbnailURL('campus');
                if ($image) {
                    echo sprintf('<li style="background-image: url(%s);"></li>', $image);
                }
            }
        }
        echo '</ul>';
    }
}
