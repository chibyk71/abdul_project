<script>
    import { page, Link, inertia } from "@inertiajs/svelte";
    import {
        IconMenu,
        IconSearch,
        IconChevronRight,
        IconLayoutDashboard,
        IconSchool,
        IconBuilding,
        IconBook,
        IconClipboardList,
        IconNews,
        IconSettings,
    } from "@tabler/icons-svelte";
    import {
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle,
    } from "@sveltestrap/sveltestrap";
    import Submenu from "../Components/submenu.svelte";
    import { isSideBarMini, user } from "../../store";
    const body = document.body;

    const SideBarToggle = () => {
        const added = body.classList.toggle("mini-sidebar");

        $isSideBarMini = added;
    };
    let overlay,wrapper;

    function mobile_btn() {
		wrapper.classList.toggle('slide-nav');
		overlay.classList.toggle('opened');
		document.querySelector('html').classList.add('menu-opened');
		return false;
	}

    const closeOverlay = ()=>{ 
		wrapper.classList.remove('slide-nav');
		overlay.classList.toggle('opened');
		document.querySelector('html').classList.remove('menu-opened');
    }

    let currentUrl = $page.url
    
    const isAdmin = $user.isAdmin;
</script>

<div class="main-wrapper" bind:this={wrapper} >
    <div class="header">
        <div class="header-left">
            <Link href="/" class="logo">
                <img src="assets/img/logo1.png" alt="Logo" />
            </Link>
            <Link href="/" class="logo logo-small">
                <img
                    src="assets/img/logo_small.png"
                    alt="Logo"
                    width="30"
                    height="30"
                />
            </Link>
        </div>

        <div class="menu-toggle">
            <a href={void 0} id="toggle_btn" on:click={SideBarToggle}>
                <IconMenu />
            </a>
        </div>

        <div class="top-nav-search">
            <form>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Search here"
                />
                <button class="btn" type="submit"><IconSearch /></button>
            </form>
        </div>

        <a class="mobile_btn" href={void(0)} on:click={mobile_btn}>
            <IconMenu class='inline-block' />
        </a>

        <ul class="nav user-menu h-[60px]">
            <Dropdown class="nav-item noti-dropdown language-drop mr-2">
                <DropdownToggle class="nav-link header-nav-list">
                    <img src="assets/img/icons/header-icon-01.svg" alt />
                </DropdownToggle>
                <DropdownMenu>
                    <div class="noti-content">
                        <div>
                            <a class="dropdown-item" href={void 0}>English</a>
                            <a class="dropdown-item" href={void 0}>Francais</a>
                            <a class="dropdown-item" href={void 0}>Turkce</a>
                        </div>
                    </div>
                </DropdownMenu>
            </Dropdown>

            <Dropdown class="nav-item noti-dropdown mr-2">
                <DropdownToggle class="nav-link header-nav-list">
                    <img src="assets/img/icons/header-icon-05.svg" alt />
                </DropdownToggle>
                <DropdownMenu class="notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href={void 0} class="clear-noti"> Clear All </a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <a href={void 0}>
                                    <div class="media d-flex">
                                        <span
                                            class="avatar avatar-sm flex-shrink-0"
                                        >
                                            <img
                                                class="avatar-img rounded-circle"
                                                alt="User Image"
                                                src="assets/img/profiles/avatar-02.jpg"
                                            />
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">
                                                <span class="noti-title"
                                                    >Carlson Tech</span
                                                >
                                                has approved
                                                <span class="noti-title"
                                                    >your estimate</span
                                                >
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time"
                                                    >4 mins ago</span
                                                >
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href={void 0}>
                                    <div class="media d-flex">
                                        <span
                                            class="avatar avatar-sm flex-shrink-0"
                                        >
                                            <img
                                                class="avatar-img rounded-circle"
                                                alt="User Image"
                                                src="assets/img/profiles/avatar-11.jpg"
                                            />
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">
                                                <span class="noti-title"
                                                    >International Software Inc</span
                                                >
                                                has sent you a invoice in the amount
                                                of
                                                <span class="noti-title"
                                                    >$218</span
                                                >
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time"
                                                    >6 mins ago</span
                                                >
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href={void 0}>
                                    <div class="media d-flex">
                                        <span
                                            class="avatar avatar-sm flex-shrink-0"
                                        >
                                            <img
                                                class="avatar-img rounded-circle"
                                                alt="User Image"
                                                src="assets/img/profiles/avatar-17.jpg"
                                            />
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">
                                                <span class="noti-title"
                                                    >John Hendry</span
                                                >
                                                sent a cancellation request
                                                <span class="noti-title"
                                                    >Apple iPhone XR</span
                                                >
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time"
                                                    >8 mins ago</span
                                                >
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href={void 0}>
                                    <div class="media d-flex">
                                        <span
                                            class="avatar avatar-sm flex-shrink-0"
                                        >
                                            <img
                                                class="avatar-img rounded-circle"
                                                alt="User Image"
                                                src="assets/img/profiles/avatar-13.jpg"
                                            />
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">
                                                <span class="noti-title"
                                                    >Mercury Software Inc</span
                                                >
                                                added a new product
                                                <span class="noti-title"
                                                    >Apple MacBook Pro</span
                                                >
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time"
                                                    >12 mins ago</span
                                                >
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href={void 0}>View all Notifications</a>
                    </div>
                </DropdownMenu>
            </Dropdown>

            <li class="nav-item zoom-screen me-2">
                <a href={void 0} class="nav-link header-nav-list win-maximize">
                    <img src="assets/img/icons/header-icon-04.svg" alt />
                </a>
            </li>

            <Dropdown class="nav-item dropdown has-arrow new-user-menus">
                <DropdownToggle caret class="nav-link header-nav-list w-auto h-auto mx-3.5">
                    <div class="user-img">
                        <img
                            class="rounded-circle"
                            src="assets/img/profiles/avatar-01.jpg"
                            width="31"
                            alt="Ryan Taylor"
                        />
                        <div class="user-text">
                            <h6 class="capitalize">{ $user.name}</h6>
                            <p class="text-muted mb-0 capitalize">{$user.isAdmin? 'Administrator': 'Student'}</p>
                        </div>
                    </div>
                </DropdownToggle>
                <DropdownMenu>
                    <div class="user-header">
                        <div class="avatar avatar-sm">
                            <img
                                src="assets/img/profiles/avatar-01.jpg"
                                alt="User Image"
                                class="avatar-img rounded-circle"
                            />
                        </div>
                        <div class="user-text">
                            <h6 class="capitalize">{$user.name}</h6>
                            <p class="text-muted mb-0">Administrator</p>
                        </div>
                    </div>
                    <a class="dropdown-item" href>My Profile</a>
                    <a class="dropdown-item" href>Inbox</a>
                    <Link method='post' class="dropdown-item" href="/logout" as='button'>Logout</Link>
                </DropdownMenu>
            </Dropdown>
        </ul>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">
                        <span>Main Menu</span>
                    </li>
                    <Submenu active={currentUrl == '/'} href='/' icon={IconLayoutDashboard}  title='Dashboard'/>
                    {#if isAdmin}
                        <Submenu active={currentUrl.includes('/student')} title="Students" icon={IconSchool}>
                            <li><a href={route('student.index')} class:active={route().current('student.index')}>Student List</a></li>
                            <li><a href={route('student.create')} class:active={route().current('student.create')}>Student Add</a></li>
                        </Submenu>
                    {/if}

                    <Submenu active={currentUrl.includes('/department')} title="Departments" icon={IconBuilding}>
                        <li><a href={route('course.index')} class:active={route().current('course.index')}>Course List</a></li>
                        <li>
                            <a href={route('course.create')} class:active={route().current('course.create')}>Course Add</a>
                        </li>
                    </Submenu>

                    <Submenu href={!isAdmin? route('course.index'): null} active={currentUrl.includes('/course')} title="Courses" icon={IconBook}>
                        {#if isAdmin}
                            <li><a class:active={route().current('course.index')} href={route('course.index')}>Course List</a></li>
                            <li>
                                <a class:active={route().current('course.create')} href={route('course.create')}>Course Add</a>
                            </li>
                        {/if}
                    </Submenu>

                    <Submenu href={route('exam.index')} active={currentUrl.includes('/exam')} title="Exam List" icon={IconClipboardList}></Submenu>

                    <Submenu title="Blogs" icon={IconNews}>
                        <li><a href>All Blogs</a></li>
                        <li><a href>Add Blog</a></li>
                        <li><a href>Edit Blog</a></li>
                    </Submenu>
                    
                    <Submenu icon={IconSettings}  title='Settings'/>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-wrapper !min-h-screen">
        <slot></slot>

        <footer class="absolute bottom-1 right-0 w-full">
            <p>COPYRIGHT © 2023 {$page.props.appName}.</p>
        </footer>
    </div>
</div>

<div bind:this={overlay} on:click={closeOverlay} class="sidebar-overlay"></div>
