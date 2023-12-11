<template>
    <a v-for="items in product" @click="$router.push(`/product/${items.id}`)" v-if="!isLoadingProduct">
        <v-card
            class="mx-auto my-12"
            max-width="374"
        >
            <v-img
                cover
                height="250"
                :src="items.image"
            ></v-img>

            <v-card-item>
                <v-card-title>{{ items.title }}</v-card-title>

                <v-card-subtitle>
                    <span class="me-1">{{ items.availability }}</span>
                </v-card-subtitle>
            </v-card-item>
            <v-card-text class="text-h5">
                {{ items.price - 300 }} ₴
            </v-card-text>
        </v-card>
    </a>
    <v-progress-circular
        v-else
        indeterminate
        :size="40"
        color="primary"
        class="isLoadingProduct"
    ></v-progress-circular>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            product: Array,
            isLoadingProduct: false
        }
    },
    methods: {
        async fetchProduct(){
            try {
                this.isLoadingProduct = true;
                const response = await axios.get('http://localhost:8000/api/product');
                this.product = response.data;
            } catch (error) {
                console.log(error);
            } finally {
                this.isLoadingProduct = false;
            }
        }
    },
    mounted() {
        this.fetchProduct();
        this.$emit('loadingProduct', this.isLoadingProduct);
    }
}
</script>

<style >
.v-responsive .v-img__img{
    display:block!important;
}
a{
    text-decoration: none;
    cursor: pointer;
}
.isLoadingProduct{
    position: absolute;
    left: 49%;
    top: 200px;
}
</style>
