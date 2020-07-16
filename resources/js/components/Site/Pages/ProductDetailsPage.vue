<template>
    <div class="page-wrapper" style="background: #ffffff; margin-top:20px;">
        <div class="container">
            <loading :active.sync="isLoading"
                     :is-full-page="fullPage"></loading>
            <div class="row" v-if="!isLoading">

                <div class="col-md-8 col-lg-8 wow bounceInUp mt-50">
                    <SingleProductDetailsLayout :product="product"></SingleProductDetailsLayout>
                </div>
                <div class="col-md-4 col-lg-4 wow bounceInLeft mt-50">
                    <ProductOfferInfoSidebar :product="product"></ProductOfferInfoSidebar>
                </div>
                <!-- <div class="col-md-4 col-lg-3 wow bounceInRight">
                    <RelatedProductsSidebar :products="relatedProducts"></RelatedProductsSidebar>
                </div> -->
            </div>

            <div class="row " v-if="!isLoading">
                <div class="col-md-12 mt-30">
                    <h3 class="bg-secondary align-center p-3">You might find your relavent products here.</h3>
                </div>

                 <div class="col-md-12 col-lg-12 wow bounceInRight">
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
                        document.title = this.product.name;
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
            document.body.scrollTop = document.documentElement.scrollTop = 0;

        },
    }
</script>

<style scoped>
    .bg-secondary {
        background-color: #eaeaea!important;
        font-weight: bold;
        font-size: 20px;
    }
</style>
