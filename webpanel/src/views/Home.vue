<template>
    <div class="home">
        <div class="container-scroller">
            <top-nav></top-nav>
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar.html -->
                <side-bar></side-bar>
                <!-- partial -->
                <dashboard></dashboard>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
    </div>
</template>

<script>
    // @ is an alias to /src
    import TopNav from '@/components/TopNav.vue'
    import SideBar from '@/components/SideBar.vue'
    import Dashboard from '@/components/Dashboard.vue'

    export default {
        name: 'home',
        components: {
            TopNav,
            SideBar,
            Dashboard
        }
    }
</script>
