

        <div class="collapse navbar-collapse" id="header-navbar-collapse">
            <ul class="nav navbar-nav navbar-right navbar-toolbar hidden-sm hidden-xs">
                <li class="dropdown dropdown-profile">
                    <a href="javascript:void(0)" data-toggle="dropdown">
                        <span class="m-r-sm"><strong>Welcome</strong>
                        <?php
                          print $resultRecord[0]['info_fname']." ".$resultRecord[0]['info_lname'];
                        ?>
                        <span class="caret"></span></span>
                        <?php
                        if(($resultRecord[0]['info_picture']!='') && ($resultRecord[0]['info_picture']!='-')) {
                          ?>
                          <img class="img-avatar img-avatar-48" src="../images/profile/<?php print $resultRecord[0]['info_picture']; ?>" alt="" />
                          <?php
                        }else{
                          ?>
                          <img class="img-avatar img-avatar-48" src="../assets/img/avatars/avatar3.jpg" alt="" />
                          <?php
                        }
                        ?>

                        <!-- <img class="img-avatar img-avatar-48" src="../assets/img/avatars/avatar3.jpg" alt="User profile pic" /> -->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- <li class="dropdown-header">
                            Pages
                        </li> -->
                        <!-- <li>
                            <a href="base_pages_profile.html"><span class="badge badge-success pull-right">3</span> Blog</a>
                        </li> -->
                        <li>
                            <a href="changepassword.php">Change password</a>
                        </li>
                        <li>
                            <a href="../signout.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- .navbar-right -->
        </div>
