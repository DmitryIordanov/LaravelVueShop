<template>
    <v-app>
        <v-app-bar color="grey-darken-3" :elevation="2" scroll-behavior="collapse">
            <v-app-bar-title>© Dmitry Iordanov</v-app-bar-title>
            <v-spacer></v-spacer>
            <v-btn @click="$router.push(`/`)">Product</v-btn>
        </v-app-bar>
        <v-container>
            <div class="App">
                <router-view></router-view>
            </div>
        </v-container>
    </v-app>
</template>

<script>
export default {

}
</script>

<style>
.App{
    display: flex;
    flex-direction: column;
    margin-left: auto;
    margin-right: auto;
    max-width: 1500px;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
}
.v-container{
    margin-top: 75px!important;
}
</style>
