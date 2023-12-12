<template>
    <div>
        <div class="block__btn_select">
            <div></div>
            <v-btn style="margin-right: 120px; margin-left: 120px;" variant="outlined" @click="showForm">Add Product
            </v-btn>
            <v-select
                style="margin-right: 18px; margin-left: 130px; height: 50px"
                label="Filters"
                variant="solo"
                v-model="itemsValue"
                :items="itemSelect"
            ></v-select>
        </div>
        <form-add-product v-model:show="show"/>
        <product-item :filters="itemsValue"/>
    </div>
</template>

<script>
import FormAddProduct from "@/Components/FormAddProduct.vue";
import ProductItem from "@/Components/ProductItem.vue";

export default {
    components: {
        ProductItem,
        FormAddProduct
    },
    data() {
        return {
            show: false,
            itemSelect: ['Default', 'Cheap', 'Expensive', 'Newest', 'Alphabetically'],
            itemsValue: null
        }
    },
    methods: {
        showForm() {
            if (this.show === false) {
                this.show = true;
            } else {
                this.show = false;
            }
        }
    }
}
</script>

<style>
.block__btn_select {
    display: grid;
    grid-template-columns: repeat(3, 410px);
    grid-auto-rows: 100px;
    justify-content: center;
}
</style>
