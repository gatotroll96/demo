<?php	
	
	class Helper{
		public static function createButton($id, $link, $name, $icon, $type = 'new'){
			$xhtml   =   '<li class="button" id="'.$id.'">';
            if($type == 'new'){
                $xhtml  .=   '<a class="modal" href="'.$link.'"><span class="'.$icon.'"></span>'.$name.'</a>';
            }else if($type == 'submit'){
                $xhtml  .=   '<a class="modal" href="#" onclick="javascipt:submitForm(\''.$link.'\')"><span class="'.$icon.'"></span>'.$name.'</a>';
            }
            
            $xhtml  .=   '</li>';
            return $xhtml;
        }

        // set format cho time
        public static function dateFormat($format, $value){
        	if(!empty($value)){
        		$result = date($format, strtotime($value));
        	}
        	return $result;
        }
        // create link sort
        public function linkSort($name, $colum, $columpost, $orderpost){
            $img = '';
            $order = ($orderpost == 'desc') ? 'asc' :  'desc';
            //if($colum == $columpost){
               // $img = '<img src="E:\xampp\htdocs\demo/public/template/admin/main/images/admin/sort_'.$orderpost.'.png" alt="">';
            //}
            $xhtml = '<a href="#" onclick="javascript:sortList(\''.$colum.'\',\''.$order.'\')"> '.$name.$img.' </a>';
            return  $xhtml;     
        }

        // Create Selectbox
        public static function craeteSelectbox($name, $class, $arrValue, $keySelect = 'default', $style = null){
            $xhtml = '<select style="'.$style.'" name="'.$name.'" class="'.$class.'" >';
            foreach($arrValue as $key => $value){
                if($key == $keySelect && is_numeric($keySelect)){
                    $xhtml .= '<option selected="selected" value = "'.$key.'">'.$value.'</option>';
                }else{
                    $xhtml .= '<option value = "'.$key.'">'.$value.'</option>';
                }
            }
            $xhtml .= '</select>';
            return $xhtml;
        }

        // Create Message
        public static function cmsMessage($message){
            $xhtml = '';
            if(!empty($message)){
                $xhtml = '<div class="test03"><dl id="system-message">
                                <dt class="'.$message['class'].'" >'.ucfirst($message['class']).'</dt>
                                <dd class="'.$message['class'].' message">
                                    <ul>
                                        <li>'.$message['content'].'</li>
                                    </ul>
                                </dd>
                            </dl></div>';
            }
            return @$xhtml;
        }

        public static function cmsInput($type, $name, $id, $value, $class = null, $size = null){
            $strSize    =   ($size==null) ? '' : "size='$size'";
            $strClass   =   ($class==null) ? '' : "class='$class'"; 
            
            $xhtml = "<input type='$type' name='$name' id='$id' value='$value' $strClass $strSize>";
            
            return $xhtml;
        }

        // Create Row cho phần admin
        public static function cmsRowForm($lblName, $input, $require = false){
            $strRequired = '';
            if($require == true ) $strRequired = '<span class="star">&nbsp;*</span>';
            $xhtml = '<li><label>'.$lblName.$strRequired.'</label>'.$input.'</li>';
        
            return $xhtml;
        }
        /*<div class="form_row">
                    <label class="contact"><strong>Phone:</strong></label>
                    <input type="text" class="contact_input" />
                    </div>*/
        // Create Row cho phần public
        public static function cmsRow($lblName, $input, $submit = false){
            $xhtml = '<div class="form_row">';
            if($submit == false ){
                $xhtml .= '<label class="contact"><strong>'.$lblName.':</strong></label>'.$input.'';
            }else{
                $xhtml .= $input;
            }
            $xhtml .= '</div>';
            
            return $xhtml;
        }

        // cắt chuỗi sao cho chữ cuối cùng vẫn đủ
        public function createDescription($str , $condition, $pos){
             $lengthStr     = strlen($str);
            if($lengthStr > $condition){
                $posStr     = strpos($str, " ", $pos);
                $result = substr($str, 0 , $posStr).'...';            
            }else{
                $result = $str;
            }            
            return $result;
        }

        private function removeSpace($value){
        $value = trim($value);
        $value = preg_replace('#(\s)+#', ' ', $value);
        return $value;
        }
        
        private function replaceSpace($value){
            $value = trim($value);
            $value = str_replace(' ', '-', $value);
            $value = preg_replace('#(-)+#', '-', $value);
            return $value;
        }
        
        private function removeCircumflex($value){
            /*a à ả ã á ạ ă ằ ẳ ẵ ắ ặ â ầ ẩ ẫ ấ ậ b c d đ e è ẻ ẽ é ẹ ê ề ể ễ ế ệ
             f g h i ì ỉ ĩ í ị j k l m n o ò ỏ õ ó ọ ô ồ ổ ỗ ố ộ ơ ờ ở ỡ ớ ợ
            p q r s t u ù ủ ũ ú ụ ư ừ ử ữ ứ ự v w x y ỳ ỷ ỹ ý ỵ z*/
            $value      = strtolower($value);
            
            $characterA = '#(a|à|ả|ã|á|ạ|ă|ằ|ẳ|ẵ|ắ|ặ|â|ầ|ẩ|ẫ|ấ|ậ)#imsU';
            $replaceA   = 'a';
            $value = preg_replace($characterA, $replaceA, $value);
            
            $characterD = '#(đ|Đ)#imsU';
            $replaceD   = 'd';
            $value = preg_replace($characterD, $replaceD, $value);
            
            $characterE = '#(è|ẻ|ẽ|é|ẹ|ê|ề|ể|ễ|ế|ệ)#imsU';
            $replaceE   = 'e';
            $value = preg_replace($characterE, $replaceE, $value);
            
            $characterI = '#(ì|ỉ|ĩ|í|ị)#imsU';
            $replaceI   = 'i';
            $value = preg_replace($characterI, $replaceI, $value);
            
            $charaterO = '#(ò|ỏ|õ|ó|ọ|ô|ồ|ổ|ỗ|ố|ộ|ơ|ờ|ở|ỡ|ớ|ợ)#imsU';
            $replaceCharaterO = 'o';
            $value = preg_replace($charaterO,$replaceCharaterO,$value);
            
            $charaterU = '#(ù|ủ|ũ|ú|ụ|ư|ừ|ử|ữ|ứ|ự)#imsU';
            $replaceCharaterU = 'u';
            $value = preg_replace($charaterU,$replaceCharaterU,$value);
            
            $charaterY = '#(ỳ|ỷ|ỹ|ý)#imsU';
            $replaceCharaterY = 'y';
            $value = preg_replace($charaterY,$replaceCharaterY,$value);
            
            $charaterSpecial = '#(,|$)#imsU';
            $replaceSpecial = '';
            $value = preg_replace($charaterSpecial,$replaceSpecial,$value);
            
            
            return $value;
            
        }
        
        
        public static function filterURL($value){
            //$value = URL::removeSpace($value);
            $value = URL::replaceSpace($value);
            $value = URL::removeCircumflex($value);
            
            
            return $value;
        }
    


	}
