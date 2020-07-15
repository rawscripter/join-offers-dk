<template>
    <div class="product_view_right_widget ">
        <div class="related-prodcut-widget">
            <div class="row">
                <!-- product single  -->
                <div v-for="product in products" class="col-md-4 col-lg-3 p-0 m-0 shadow" :key="product.id">
                    <SingleProduct :product="product"></SingleProduct>
                </div>
                <!-- end of product single  -->
                <!-- product single  -->
            </div>
        </div>
    </div>
</template>

<script>
    import SingleProduct from "../Layout/Product/Loop/SingleProduct";

    export default {
        name: "RelatedProductsSidebar",
        components: {
            SingleProduct
        },
        props: ['products'],
        data() {
            return {}
        },
    }
</script>

<style scoped>

</style>
