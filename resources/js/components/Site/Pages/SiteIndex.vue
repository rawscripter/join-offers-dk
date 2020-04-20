<template>
    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-3">
                    <ProductFilter></ProductFilter>
                </div>
                <div class="col-md-10 col-lg-9">
                    <div class="main-content">
                        <div class="product-area">
                            <div class="row">
                                <div v-for="product in products" :key="product.id"
                                     class="col-md-4 col-lg-4 col-sm-6 shadow-sm ml-0 pl-0 mr-0 pr-0">
                                    <!-- product single  -->
                                    <SingleProduct :product="product"></SingleProduct>
                                    <!-- end of product single  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    import ProductFilter from "../SideBar/ProductFilter";
    import SubCategoryMenuBar from "../Layout/SubCategoryMenuBar";
    import SingleProduct from "../Layout/Product/Loop/SingleProduct";

    export default {
        name: "SiteIndex",
        components: {
            ProductFilter,
            SubCategoryMenuBar,
            SingleProduct
        },
        data() {
            return {
                products: []
            }
        },
        methods: {
            getProducts() {
                axios.get(`${APP_URL}/api/products`)
                    .then(res => {
                        this.products = res.data.products;
                    }).catch(error => {
                    console.error(error)
                })
            },
        },
        created() {
            this.getProducts();
        }
    }
</script>

<style scoped>
    .padding-top-30 {
        padding-top: 30px;
    }
</style>
