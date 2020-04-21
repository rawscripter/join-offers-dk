<template>
    <div class="page-wrapper" style="background: #ffffff;margin-top:20px;">
        <div class="container">
            <loading :active.sync="isLoading"
                     :is-full-page="fullPage"></loading>
            <div class="row" v-if="!isLoading">
                <div class="col-md-3 col-lg-3">
                    <ProductOfferInfoSidebar :product="product"></ProductOfferInfoSidebar>
                </div>
                <div class="col-md-5 col-lg-6">
                    <SingleProductDetailsLayout :product="product"></SingleProductDetailsLayout>
                </div>
                <div class="col-md-4 col-lg-3">

                    <RelatedProductsSidebar :products="relatedProducts"></RelatedProductsSidebar>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductOfferInfoSidebar from "../SideBar/ProductOfferInfoSidebar";
    import RelatedProductsSidebar from "../SideBar/RelatedProductsSidebar";
    import SingleProductDetailsLayout from "../Layout/Product/SingleProductDetailsLayout";


    export default {

        name: "ProductDetailsPage",
        components: {
            ProductOfferInfoSidebar,
            RelatedProductsSidebar,
            SingleProductDetailsLayout,
        },
        data() {
            return {
                isLoading: false,
                fullPage: true,
                productSlug: null,
                product: null,
                relatedProducts: []
            }
        },

        methods: {
            getProduct(slug) {
                axios.get(`${APP_URL}/api/product/${slug}`)
                    .then(res => {
                        this.isLoading = false;
                        this.product = res.data.product;
                    }).catch(error => {
                    console.error(error)
                })
            },
            getRelatedProducts(slug) {
                axios.get(`${APP_URL}/api/product/${slug}/related-products`)
                    .then(res => {
                        this.relatedProducts = res.data.relatedProducts;
                    }).catch(error => {
                    console.error(error)
                })
            },
        },
        created() {
            this.isLoading = true;
            this.getProduct(this.$route.params.slug);
            this.getRelatedProducts(this.$route.params.slug);
        },
    }
</script>

<style scoped>

</style>
