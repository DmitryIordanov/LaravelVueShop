<template>
    <div class="Product__Block" v-if="!isLoadingProduct">
        <v-img
            width="150"
            height="550"
            :src="product.image"
        ></v-img>

        <div class="Product__Block_Desc">
            <v-card-title class="text-h3">
                {{ product.title }}
            </v-card-title>

            <v-card-title class="mt-4 text-h4">
                {{ product.price - 300 }} ₴ <s class="text-h5" style="color: red; opacity: .5;">{{ product.price }} ₴</s>
            </v-card-title>

            <v-card-item class="mt-4">
                <div style="display: flex; flex-direction: column">
                    <span class="me-1" style="font-size: 20px">{{ product.availability }}</span>
                    <div class="mt-3">
                        <h2>Доставка:</h2>
                        <span class="me-1" style="font-size: 20px">{{ product.delivery }}</span>
                    </div>
                </div>
            </v-card-item>

            <div class="mt-5" style="font-size: 16px; padding: 0.5rem 1rem">
                <h2>Описание товара:</h2>
                <p class="text-h6" v-html="product.content">
                </p>
            </div>

            <v-card-item>
                <v-btn class="mr-3" color="light-blue-darken-1">
                    <v-icon
                        start
                        icon="mdi-pencil"
                    >
                    </v-icon>
                    Update
                </v-btn>
                <v-btn color="red">
                    <v-icon
                        start
                        icon="mdi-minus-circle"
                    >
                    </v-icon>
                    Delete
                </v-btn>
            </v-card-item>
        </div>
    </div>
    <v-progress-circular
        v-else
        indeterminate
        :size="40"
        color="primary"
        class="isLoadingProduct"
    ></v-progress-circular>
</template>

<script>
import ApiStore from "@/Api/index.vue";

export default {
    data() {
        return {
            product: Object,
            isLoadingProduct: false
        }
    },
    methods: {
        async idFindProduct() {
            try {
                this.isLoadingProduct = true
                this.product = await ApiStore.methods.findProduct(this.$route.params.id);
            } catch (error){
                console.log(error)
            } finally {
                this.isLoadingProduct = false;
            }
        }
    },
    mounted() {
        this.idFindProduct();
    }
}
</script>

<style>
.Product__Block {
    display: flex;
    align-items: center;
}

.Product__Block_Desc {
    display: flex;
    flex-direction: column;
    width: 600px;
    margin-left: 50px;
}
</style>
