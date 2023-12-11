<template>
    <div class="product-item">
        <a v-for="items in product.data" @click="$router.push(`/product/${items.id}`)" v-if="!isLoadingProduct">
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
    </div>
    <div v-if="!isLoadingProduct" class="mt-10 ml-auto mr-auto" style="max-width: 750px">
        <div class="pagination text-center">
            <a
                :class="{'active-a':link.label === this.page}"
                v-for="link in pageCount"
                v-html="link.label"
                @click="fetchProduct(link.label)"
            ></a>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            product: [],
            isLoadingProduct: false,
            page: 1,
            pageCount: [],
        }
    },
    mounted() {
        this.fetchProduct();
    },
    methods: {
        async fetchProduct(pages = 1) {
            try {
                this.isLoadingProduct = true;
                this.page = pages;

                const responce = await axios.get('http://localhost:8000/api/product?page=' + pages)
                    .then((data) => {
                            this.product = data.data;
                            this.pageCount = data.data.links;
                        }
                    );
            } catch (error) {
                console.log(error);
            } finally {
                this.isLoadingProduct = false;
            }
        }
    },
}
</script>

<style>
.product-item{
    display: grid;
    justify-content: center;
    grid-template-columns: repeat(3, 410px);
    grid-auto-rows: 400px;
}
.v-responsive .v-img__img {
    display: block !important;
}

a {
    text-decoration: none;
    cursor: pointer;
}

.isLoadingProduct {
    position: absolute;
    left: 49%;
    top: 200px;
}
.pagination{
    margin-bottom: 25px;
    margin-top: 70px;
}
.pagination a{
    padding: 15px 20px;
    color: #171717;
    border-radius: 5px;
    font-size: 15px;
    transition: .2s;
    font-weight: 600;
    margin-left: 15px;
}
.pagination a:hover{
    background: #B3E5FC!important;
}
.active-a{
    background: #d1e8f6!important;
}
.pagination a:first-child,.pagination a:last-child{
    display: none;
}
</style>
