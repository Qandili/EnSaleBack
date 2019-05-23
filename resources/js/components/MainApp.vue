<template>
    <div id="main">
        <div class="content">
            <router-view/>
        </div>
    </div>
</template>

<script>
    import Navbar from './navbars/Navbar.vue';
    export default {
        name: 'mainapp',
        components: {Navbar}
    }
</script>
