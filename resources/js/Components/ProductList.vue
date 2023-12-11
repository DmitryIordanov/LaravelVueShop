<template>
    <div class="product-item">
        <product-item/>
    </div>
</template>

<script>
import ProductItem from "@/Components/ProductItem.vue";

export default {
    components: {ProductItem}
}
</script>

<style>
.product-item{
    display: grid;
    justify-content: center;
    grid-template-columns: repeat(3, 410px);
    grid-auto-rows: 400px;
}
</style>
