<?php switch($item_type) {
// ----------------------------------------------------------
    case 'folder': ?>
        <div class="fs-item fs-itemtype-folder">
        	<a href="#" onclick="app.FSItemClick('folder', '<?=$item_path .($item_path!='/' ? '/' : '') . $item_name?>'); return false;" class="fs-item-name"><?='/'.$item_name?></a>
        </div> 
        <?php
    break;
// ----------------------------------------------------------
    case 'file':?>
        <div class="fs-item fs-itemtype-file">
        	<a href="#" onclick="app.FSItemClick('file', '<?=$item_path.'/'.$item_name?>'); return false;" class="fs-item-name"><?=$item_name?></a>
        </div> 
        <?php
    break;
// ----------------------------------------------------------
    case 'up':?>
        <div class="fs-item fs-itemtype-folder">
        	<a href="#" onclick="app.FSItemClick('up', '<?=$path?>'); return false;" class="fs-item-name">..</a>
        </div> 
        <?php
    break;
}     
