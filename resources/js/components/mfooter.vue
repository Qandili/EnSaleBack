<template>
    <div>
        <v-footer
            dark
            height="auto">
            <v-card
            class="flex"
            flat
            tile
            >
            <v-card-title class="light-blue darken-1">
                <strong class="subheading">EnSale</strong>
                <v-spacer></v-spacer>
                <v-btn
                v-for="icon in icons"
                :key="icon"
                class="mx-3"
                dark
                icon
                >
                <v-icon size="24px">{{ icon }}</v-icon>
                </v-btn>
            </v-card-title>

            <v-card-actions class="grey darken-3 justify-center">
                &copy;2019 — <strong>EnEale</strong>
            </v-card-actions>
            </v-card>
        </v-footer>
    </div>
</template>

<script>
export default {
    name:"mfooter",
    data: () => ({
        icons: [
            'fab fa-facebook',
            'fab fa-twitter',
            'fab fa-google-plus',
            'fab fa-linkedin',
            'fab fa-instagram'
        ]
    })
}
</script>

<style>

</style>
