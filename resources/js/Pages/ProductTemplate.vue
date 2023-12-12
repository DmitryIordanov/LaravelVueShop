<template>
    <div class="Product__Block" v-if="!isLoadingProduct">
        <v-img
            width="150"
            height="550"
            :src="product.image"
        ></v-img>

        <div class="Product__Block_Desc">

            <h1 style="padding: 0.5rem 1rem;">{{ product.title }}</h1>

            <v-card-title class="mt-4 text-h4">
                {{ product.price - 100 }} ₴ <s class="text-h5" style="color: red; opacity: .5;">{{ product.price }} ₴</s>
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
                <v-btn class="mr-3" color="light-blue-darken-1" :to="'/update/' + product.id">
                    <v-icon
                        start
                        icon="mdi-pencil"
                    >
                    </v-icon>
                    Update
                </v-btn>
                <v-btn color="red" @click="deleteProduct" to="/">
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
            // The selected post is sent to the court for further output to the template
            product: Object,
            // Loading icon for productTemplate
            isLoadingProduct: false
        }
    },
    methods: {
        // Axios to get the desired post by id
        async idFindProduct() {
            try {
                // Loading set to true
                this.isLoadingProduct = true
                // Send the identifier to the Axios request to send it to the server and receive the desired post
                this.product = await ApiStore.methods.findProduct(this.$route.params.id);
            } catch (error){
                console.log(error)
            } finally {
                // Loading set to false
                this.isLoadingProduct = false;
            }
        },
        // The delete Product function sends a request to delete a product
        async deleteProduct() {
            try {
                // Send the id to an Axios request to delete the desired post by id
                await ApiStore.methods.deleteProduct(this.product.id);
            } catch (error) {
                console.log(error)
            }
        }
    },
    mounted() {
        // Call the function when the page loads
        this.idFindProduct();
    }
}
</script>

<style>
.Product__Block {
    display: flex;
    align-items: start;
}

.Product__Block_Desc {
    display: flex;
    flex-direction: column;
    width: 600px;
    margin-left: 50px;
}
.Product__Block_Desc li {
    list-style-type: none;
}
</style>
