<template>
    <div>
        <form-update-product :idProduct="this.$route.params.id"/>
    </div>
</template>

<script>
import FormUpdateProduct from "@/Components/FormUpdateProduct.vue";

export default {
    components: {FormUpdateProduct},

}
</script>

<style>

</style>
