<?php

    $database = new Model();
    $ImgUrl = TEMPLATE_URL.'default/main/';
    $linkHome = URL::createLink('default', 'index', 'index',null, 'index.html');
    $linkLogin = URL::createLink('default', 'user', 'login', null, 'login.html');
    $linkAdminControl = URL::createLink('admin', 'index', 'index');
    $linkRegister = URL::createLink('default', 'user', 'register', null, 'register.html');
    $linkProfile = URL::createLink('default', 'user', 'index',null, 'my-account.html');
    $linkCategory = URL::createLink('default', 'category', 'index',null, 'category.html');


    $userInfo   = Session::get('user');
    @$logged    = ($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time());
    $xhtml = "";
    if($logged == true){
        $xhtml .= '<li class="categoryindex"><a href="'.$linkCategory.'">Category</a></li>';
        $xhtml .= '<li class="indexprofile"><a href="'.$linkProfile.'">My accout</a></li>';
        if($userInfo['group_acp'] == 1){
            $xhtml .= '<li class="indexlogout"><a href="'.$linkAdminControl.'">Admin Manager</a></li>';
        }
    }else{
        $xhtml .= '<li class="categoryindex"><a href="'.$linkCategory.'">Category</a></li>';
        $xhtml .= '<li class="userlogin"><a href="'.$linkLogin.'">Login</a></li>';
        $xhtml .= '<li class="userregister"><a href="'.$linkRegister.'">Register</a></li>';
    }
?>

<div class="header">
    <div class="logo"><a href="<?php echo $linkHome; ?>"><img src="<?php echo $ImgUrl;?>images/logo.gif" alt="" title="" border="0" /></a></div>            
    <div id="menu">
        <ul>                                                                       
        <li class="userindex"><a href="<?php echo $linkHome; ?>">Home</a></li>
        <?php
            echo $xhtml;
        ?>
        </ul>
    </div>
</div> 