<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg"
                alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{{ url('assets/images/faces/face15.jpg') }}"
                            alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
                        <span>Gold Member</span>
                    </div>
                </div>
                <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i
                        class="mdi mdi-dots-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                    aria-labelledby="profile-dropdown">
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-onepassword  text-info"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-calendar-today text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                        </div>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ URL::to('/home') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#loan-manage" aria-expanded="false"
                aria-controls="loan-manage">
                <span class="menu-icon">
                    <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Loan Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="loan-manage">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('loan.customer') }}">Customers</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('loan.create') }}">Add New Loan</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('loan.customize') }}">Transactions</a>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('loan.customize') }}">Borrowing History</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('task.show') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Tasks</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('marketing.show') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Marketing </span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#system-user" aria-expanded="false"
                aria-controls="system-user">
                <span class="menu-icon">
                    <i class="mdi mdi-account-multiple-outline "></i>
                </span>
                <span class="menu-title"> System Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="system-user">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::to('user/systemuser') }}"> Staffs
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ URL::to('/user/add_user') }}"> Add New </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="#app-setting" data-bs-toggle="collapse" aria-expanded="false"
                aria-controls="app-setting">
                <span class="menu-icon">
                    <i class="mdi mdi-apps"></i>
                </span>
                <span class="menu-title">App Setting</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="app-setting">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('app.policy') }}">Privacy Policy</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('app.disclosure') }}">Disclosure
                            Statement</a>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('app.whychooseus') }}">Why choose
                            us</a>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('app.faq') }}">FAQ</a>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('app.aboutus') }}">About us</a>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('app.support') }}">Support</a>
                    </li>

                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#system-setting" aria-expanded="false"
                aria-controls="system-setting">
                <span class="menu-icon">
                    <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">System Setting</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="system-setting">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('setting.general') }}">General</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('setting.profile') }}">Profile</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('setting.rolepermission') }}">Role
                            Permission</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#report" aria-expanded="false"
                aria-controls="report">
                <span class="menu-icon">
                    <i class="mdi mdi-file-document-box"></i>
                </span>
                <span class="menu-title">Report</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="report">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('report.sysytem') }}">System Report</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('report.app') }}">App Report</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
