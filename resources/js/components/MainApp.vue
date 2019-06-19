<template>
    <div id="main">
        <div class="content">
            <router-view/>
        </div>
    </div>
</template>

<script>
    import Navbar from './navbars/Navbar.vue';
    import mfooter from './mfooter.vue';
    export default {
        name: 'mainapp',
        components: {
            Navbar,
            mfooter
        }
    }
</script>
