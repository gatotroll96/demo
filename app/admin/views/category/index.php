<?php
	include_once 'toolbar/index.php';
	include_once 'submenu/index.php';     
    echo Helper::cmsMessage(@$_SESSION['message']);
    Session::delete('message');
?>
<div id="system-message-container">
</div>
<div id="element-box">
	<div class="m">
		<form action="#" method="post" name="adminForm" id="adminForm">
        	<!-- FILTER -->
            <?php
                $filter_search = (isset($this->_arrGetPost['filter_search'])) ? $this->_arrGetPost['filter_search'] : "";
                $arrCrSelectbox = array('default' => 'Select Status', '1' => '-publish-', '0' => '-unpublish-');
                $select = Helper::craeteSelectbox('filter_state', 'inputbox', $arrCrSelectbox , @$this->_arrGetPost['filter_state']);
            ?>
            <fieldset id="filter-bar">
                <div class="filter-search fltlft">
                    <label class="filter-search-lbl" for="filter_search">Filter:</label>
                    <input type="text" name="filter_search" id="filter_search" value="<?php echo $filter_search; ?>" title="Search in module title.">
                    <button type="submit" name="submit-keyword" >Search</button>
                    <button type="button" name="clear-keyword"  >Clear</button>
                </div>                
                <div class="filter-select fltrt">
                    <?php echo $select;?> 
                </div>
            </fieldset>
			<div class="clr"> </div>

            <table class="adminlist" id="modules-mgr">
            	<!-- HEADER TABLE -->
                <?php
                   echo '<pre>';
                    print_r($this->_arrGetPost);
                echo '</pre>';
                @$columPost = $this->_arrGetPost['colum'];
                @$orderPost = $this->_arrGetPost['columdir'];
                $sortName = Helper::linkSort('Name', 'name', $columPost, $orderPost);
                ?>
                <thead>
                    <tr>
                        <th width="1%">
                            <input type="checkbox" id="select_all" name="checkall-toggle">
                        </th>
                        <th class="title" width="15%"><?php echo $sortName; ?></th>
                        <th width="10%">Picture</a></th>
                        <th width="5%">Status</a></th>
                        <th width="5%">Ordering</a></th>
                        <th width="10%">Created</a></th>
                        <th width="15%">Created By</a></th>
                        <th width="1%" class="nowrap">ID</a></th>
                    </tr>
                </thead>
                <!-- FOOTER TABLE -->
                <tfoot>
                    <tr>
                        <td colspan="10">
                            <!-- PAGINATION -->
                            <div class="container">
                                <?php echo $this->page->showPagination('index.php?module=admin&controller=group&action=index'); ?>
                            </div>				
                        </td>
                    </tr>
                </tfoot>
                <!-- BODY TABLE -->
                <?php
                    if(!empty($this->items)){
                        $i = 0;
                        $xhtml = '';
                        foreach ($this->items as $key => $value) {
                            $id = $value['id'];
                            $name = $value['name'];
                            $linkPicture = UPLOAD_URL .'category'.DS.'60x90_'.$value['picture'];
                            $picture  = '<img src="'.$linkPicture.'"/>';            
                            @$created = Helper::dateFormat('d-m-Y',$value['created']);
                            $created_by = $value['created_by'];                                                        
                            //index.php?module=admin&controller=group&action=ajaxStatus&id=2&status=0
                            $status = ($value['status'] == 1) ? 'state publish' : 'state unpublish';
                            $ordering = $value['ordering'];
                            $row    = ($i % 2 == 0) ? 'row1' : 'row2';
                            $linkStatus = URL::createLink('admin', 'group', 'ajaxStatus', array('id'=>$id, 'status'=>$value['status']));
                            $linkEdit = URL::createLink('admin', 'category', 'add', array('id'=>$id));
                            $xhtml .=   '<tr class="'.$row.'">
                                            <td class="center">
                                                <input type="checkbox" class="checkbox" name="cid[]" value="'.$id.'">
                                            </td>
                                            <td><a href="'.$linkEdit.'">'.$name.'</td>
                                            <td class="center">'.$picture.'</td>
                                            <td class="center">
                                                <a class="jgrid hasTip" id="status-'.$id.'" href="javascript:changeStatus(\''.$linkStatus.'\')" onclick="\'#\'" >
                                                    <span class="'.$status.'">
                                                        <span class="text">Module enabled and published</span>
                                                    </span>
                                                </a>        
                                            </td>
                                            <td class="order">
                                                <input type="text" name="order[]" size="5" value="'.$ordering.'" disabled="disabled" class="text-area-order">
                                            </td>
                                            <td class="center">'.$created.'</td>
                                            <td class="center">'.$created_by.'</td>
                                            <td class="center">'.$id.'</td>
                                        </tr>';
                            $i++;
                        }                        
                    }
                ?>
				<tbody>
                    <?php 
                        echo @$xhtml;
                    ?>	
				</tbody>
			</table>

            <div>
                <input type="hidden" name="colum" value="name">
                <input type="hidden" name="columdir" value="asc">
                <input type="hidden" name="filter_page" value="1">
        </form>

		<div class="clr"></div>
	</div>
</div>