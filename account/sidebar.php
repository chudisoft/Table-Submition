
    <div class="left-side-bar">
        <div class=" text-center">
            <a href="../" >
                <img src="../asset/img/logo.png" alt="" class="light-logo" style="max-width:5em">
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li>
                        <a href="dashboard" class="dropdown-toggle no-arrow">
                            <span class="micon fa fa-home"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    </li>
                    <?php

                    if($_SESSION['Role'] == "Admin")
                    {
                    echo '
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <div class="sidebar-small-cap">Others</div>
                    </li>
                    <li>
                        <a href="table-records" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-note"></span>
                            <span class="mtext">Table-Records</span>
                        </a>
                    </li>
                    <li>
                        <a href="siteinfo" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-settings"></span>
                            <span class="mtext">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="email" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-mail"></span>
                            <span class="mtext">Email</span>
                        </a>
                    </li>
                    <li>
                        <a href="users" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-user"></span>
                            <span class="mtext">Users</span>
                        </a>
                    </li>';
                    }

                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>
