<template>
    <div>
        <div class="text-center mb-3">
            <v-btn variant="outlined" @click="showForm">Add Product</v-btn>
        </div>
        <form-add-product v-model:show="show"/>
        <product-list/>
    </div>
</template>

<script>
import FormAddProduct from "@/Components/FormAddProduct.vue";
import ProductList from "@/Components/ProductList.vue";
export default {
    components:{
        ProductList,
        FormAddProduct
    },
    data(){
        return{
            show: false
        }
    },
    methods: {
        showForm(){
            if (this.show === false){
                this.show = true;
            } else {
                this.show = false;
            }
        }
    }
}
</script>

<style>
</style>
