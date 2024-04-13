<script setup>
    import { computed } from 'vue'
    import { Link, usePage  } from '@inertiajs/vue3'
    import { ZiggyVue } from 'ziggy-js'

    const page = usePage()
    const assetUrl = window.Laravel.assetUrl;
    const user = computed(() => page.props.auth.user)

    defineProps({ })
</script>

<template>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="#">
                        <img :src="`${assetUrl}/assets/images/logo.png`" alt="logo" style="object-fit: contain;" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="#">
                        <img :src="`${assetUrl}/assets/images/logo.jpg`" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Welcome, <span class="text-black fw-bold">{{ user.name }}</span></h1>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" :src="`${assetUrl}/assets/images/faces/user.jpg`" alt="Profile image"> 
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" height="35" width="35" :src="`${assetUrl}/assets/images/faces/user.jpg`" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">{{ user.name }}</p>
                                <p class="fw-light text-muted mb-0">{{ user.email }}</p>
                            </div>
                            <Link class="dropdown-item" :href="route('github.auth.logout')" method="post"  as="button">
                                <i clas s="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out
                            </Link>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">
                    
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item active">
                        <Link class="nav-link" :href="route('dashboard')">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </Link>
                    </li>
                    
                </ul>
            </nav>
            <!-- partial -->

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">

                                <slot />

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</template>