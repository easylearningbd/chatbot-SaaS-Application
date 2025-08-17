<div class="sidenav-menu">

                <!-- Brand Logo -->
<a href="index.html" class="logo">
    <span class="logo-light">
        <span class="logo-lg"><img src="{{ asset('backend/assets/images/logo.png') }}" alt="logo"></span>
        <span class="logo-sm"><img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="small logo"></span>
    </span>

    <span class="logo-dark">
        <span class="logo-lg"><img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="dark logo"></span>
        <span class="logo-sm"><img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="small logo"></span>
    </span>
</a>

                <!-- Sidebar Hover Menu Toggle Button -->
                <button class="button-sm-hover">
                    <i class="ri-circle-line align-middle"></i>
                </button>

                <!-- Full Sidebar Menu Close Button -->
                <button class="button-close-fullsidebar">
                    <i class="ti ti-x align-middle"></i>
                </button>

                <div data-simplebar>

                    <!--- Sidenav Menu -->
<ul class="side-nav">
    <li class="side-nav-title">
        Menu
    </li>

    <li class="side-nav-item">
        <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
            <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
            <span class="menu-text"> Dashboard </span>
            <span class="badge bg-danger rounded-pill">9+</span>
        </a>
    </li>

    <li class="side-nav-item">
        <a href="{{ route('all.plans') }}" class="side-nav-link">
            <span class="menu-icon"><i class="ti ti-message"></i></span>
            <span class="menu-text"> Plans </span>
        </a>
    </li>

    <li class="side-nav-item">
        <a href="{{ route('knowledge.page') }}" class="side-nav-link">
            <span class="menu-icon"><i class="ti ti-calendar"></i></span>
            <span class="menu-text"> Knowledge Base </span>
        </a>
    </li>

    <li class="side-nav-item">
        <a href="{{ route('chatbot.page') }}" class="side-nav-link">
            <span class="menu-icon"><i class="ti ti-mailbox"></i></span>
            <span class="menu-text"> Chatbot </span>
        </a>
    </li>

    <li class="side-nav-item">
        <a href="{{ route('all.orders') }}" class="side-nav-link">
            <span class="menu-icon"><i class="ti ti-mailbox"></i></span>
            <span class="menu-text"> All Orders </span>
        </a>
    </li>

    <li class="side-nav-item">
        <a href="{{ route('blog.list') }}" class="side-nav-link">
            <span class="menu-icon"><i class="ti ti-mailbox"></i></span>
            <span class="menu-text"> Blog List</span>
        </a>
    </li>

    

    <li class="side-nav-title mt-2">
        Custom
    </li>

    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
            <span class="menu-icon"><i class="ti ti-package"></i></span>
            <span class="menu-text"> Pages </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarPages">
            <ul class="sub-menu">
                <li class="side-nav-item">
                    <a href="pages-starter.html" class="side-nav-link">
                        <span class="menu-text">Starter Page</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="pages-pricing.html" class="side-nav-link">
                        <span class="menu-text">Pricing</span>
                    </a>
                </li>
                 
            </ul>
        </div>
    </li>

    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarPagesAuth" aria-expanded="false" aria-controls="sidebarPagesAuth" class="side-nav-link">
            <span class="menu-icon"><i class="ti ti-user-shield"></i></span>
            <span class="menu-text"> Authentication </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarPagesAuth">
            <ul class="sub-menu">
                <li class="side-nav-item">
                    <a href="auth-login.html" class="side-nav-link">
                        <span class="menu-text">Login</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="auth-register.html" class="side-nav-link">
                        <span class="menu-text">Register</span>
                    </a>
                </li>
                 
            </ul>
        </div>
    </li>

  
</ul>

                    <!-- Help Box -->
                    <div class="help-box text-center">
                        <h5 class="fw-semibold fs-16">Unlimited Access</h5>
                        <p class="mb-3 text-muted">Upgrade to plan to get access to unlimited reports</p>
                        <a href="javascript: void(0);" class="btn btn-danger btn-sm">Upgrade</a>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>