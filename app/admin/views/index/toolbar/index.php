<?php

    // button cho phần New
    $linkNew        = URL::createLink('admin', 'group','add');  
    $buttonNew      = Helper::createButton('toolbar-popup-new',$linkNew, 'New', 'icon-32-new');
    // button cho phần Publish
    $linkPublish    = URL::createLink('admin', 'group', 'status', array('type'=>1));
    $buttonPublish  = Helper::createButton('toolbar-publish',$linkPublish, 'Publish', 'icon-32-publish','submit');
    // button cho phần UNpublish
    $linkUnpublish  = URL::createLink('admin', 'group', 'status',array('type'=>0));
    $buttonUnpublish      = Helper::createButton('toolbar-unpublish',$linkUnpublish, 'Unpublish', 'icon-32-unpublish','submit');
    // button cho phần Trash
    $linkTrash      = URL::createLink('admin', 'group', 'deteleitems');
    $buttonTrash    = Helper::createButton('toolbar-trash',$linkTrash, 'Trash', 'icon-32-trash','submit');
    // button cho phần apply save
    $linkApply     = URL::createLink('admin', 'group', 'add' , array('type'=>'apply'));
    $buttonApply    = Helper::createButton('toolbar-apply',$linkApply, 'Save', 'icon-32-apply','submit');
    // button cho phần save và lưu
    $linkSave      = URL::createLink('admin', 'group', 'add',array('type'=>'Save'));
    $buttonSave    = Helper::createButton('toolbar-save',$linkSave, 'Save&Close', 'icon-32-save','submit');
    // button cho phần save và lưu mới
    $linkSaveNew      = URL::createLink('admin', 'group', 'add',array('type'=>'savenew'));
    $buttonSaveNew   = Helper::createButton('toolbar-save-new',$linkSaveNew , 'Save&New', 'icon-32-save-new','submit');
    // button cho phần cancel
    $linkCancel      = URL::createLink('admin', 'group', 'index');
    $buttonCancel   = Helper::createButton('toolbar-cancel',$linkCancel, 'Cancel', 'icon-32-cancel');


?>
<div id="toolbar-box">
	<div class="m">
            	<!-- TOOLBAR -->
		<div class="toolbar-list" id="toolbar">
            <ul>
                <?php
                switch ($this->_arrGetPost['action']) {
                    case "index":
                        echo $buttonNew;
                        echo '<li class="divider"></li>';
                        echo $buttonPublish;
                        echo '<li class="divider"></li>';
                        echo $buttonUnpublish;
                        echo '<li class="divider"></li>';
                        echo $buttonTrash;
                        break;
                    case "add":
                        echo $buttonApply;
                        echo $buttonSave;
                        echo $buttonSaveNew;
                        echo $buttonCancel;
                        break;                   
                }
                ?>                
            </ul>
			<div class="clr"></div>
	    </div>
				<!-- TITLE -->
        <div class="pagetitle icon-48-groups"><h2><?php echo 'Admin Manager: User group' ?></h2></div>
	</div>
</div>