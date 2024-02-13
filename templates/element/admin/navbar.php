<!-- Main Navbar -->
<nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
    <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
        <div class="input-group input-group-seamless ml-3">
        
        </div>
    </form>
    <ul class="navbar-nav border-left flex-row ">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="user-avatar rounded-circle mr-2" src="<?php if(!empty($user['media'])):?><?= $this->request->getAttribute('webroot')?><?= $user['media']['directory'].$user['media']['value'] ?><?php else:?><?= $this->request->getAttribute('webroot')?>img/user.jpeg<?php endif;?>" style="height: 43px;width:43px;" alt="<?php if(!empty($user['name'])):?><?= $user['name'] ?><?php else:?>John Doe<?php endif;?>">
                <span class="d-none d-md-inline-block"><?php if(!empty($user['name'])):?><?= $user['name'] ?><?php else:?>John Doe<?php endif;?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-small">
                <a class="dropdown-item" href="<?= $this->Url->build(["controller" => "Admins", "action" => "change_password"]);?>">
                    <i class="material-icons">&#xE7FD;</i> Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="material-icons text-danger">&#xE879;</i> Logout </a>
            </div>
        </li>
    </ul>
    <nav class="nav">
        <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
            <i class="material-icons">&#xE5D2;</i>
        </a>
    </nav>
</nav>
</div>
<!-- / .main-navbar -->