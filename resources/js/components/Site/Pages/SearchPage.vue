<template>
    <div class="page-wrapper wow">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-10 m-auto">
                    <div class="main-content">
                        <div class="product-area" v-if="hasProducts">
                            <div class="row">
                                <loading :active.sync="isLoading"
                                         :is-full-page="false"></loading>

                                <div v-for="product in products" :key="product.id"
                                     class="col-md-4 bounceInUp wow col-lg-4 col-sm-6 shadow-sm ml-0 pl-0 mr-0 pr-0">
                                    <!-- product single  -->
                                    <SingleProduct :product="product"></SingleProduct>
                                    <!-- end of product single  -->
                                </div>

                            </div>
                        </div>
                        <div v-else>
                            <div class="text-center m-100 mt-5">
                                <h3 class="mt-6 big-error-font">
                                    <strong>
                                        {{errorText}}
                                    </strong>
                                    <br>
                                    <router-link class="back-to-home" tag="a" to="/">
                                        Tilbage til forsiden
                                    </router-link>

                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    // import ProductFilter from "../SideBar/ProductFilter";
    import SubCategoryMenuBar from "../Layout/SubCategoryMenuBar";
    import SingleProduct from "../Layout/Product/Loop/SingleProduct";

    export default {
        name: "SearchPage",
        components: {
            //   ProductFilter,
            SubCategoryMenuBar,
            SingleProduct
        },
        data() {
            return {
                errorText: 'Loading...',
                isLoading: false,
                page: 1,
                products: [],
                lastPage: 2,
                query: null,
            }
        },
        methods: {
            loadMore() {
                this.isLoading = true;
                let vm = this;
                setTimeout(e => {
                    axios.get(`${APP_URL}/api/products?page=${this.page}&query=${this.query}`)
                        .then(response => {
                            vm.isLoading = false;
                            vm.lastPage = response.data.lastPage;

                            if (response.data.products !== '') {
                                $.each(response.data.products, function (key, value) {
                                    let found = false;
                                    for (let i = 0; i < vm.products.length; i++) {
                                        if (vm.products[i].id === value.id) {
                                            found = true;
                                            break;
                                        }
                                    }

                                    if (!found) {
                                        vm.products.push(value);
                                    }
                                });
                            } else {
                                this.errorText = 'No Product Found';
                            }


                            vm.page += 1;
                        });

                    this.isLoading = false;
                }, 500);
                /**************************************/

            },

        },
        created() {
            this.isLoading = true;
            if (this.$route.params.search) {
                this.query = this.$route.params.search.replace('-', ' ');
            }

        },
        computed: {
            hasMorePages() {
                return this.lastPage >= this.page;
            },
            hasProducts() {
                return this.products.length > 0;
            }
        },
        mounted() {
            // Detect when scrolled to bottom.
            const listElm = document.querySelector('body');
            listElm.addEventListener('scroll', e => {
                if (listElm.scrollTop + listElm.clientHeight >= listElm.scrollHeight) {
                    this.loadMore();
                }
            });
            // Initially load some items.
            this.loadMore();
        },
    }
</script>

<style scoped>
    .padding-top-30 {
        padding-top: 30px;
    }

    .product-area {
        background: #fafafa;
        padding: 5px;
        min-height: 50vh;
    }

    .big-error-font {
        font-size: 48px;
        color: #3939396b;
        margin-top: 150px !important;
    }

    .page-wrapper.wow {
        overflow: hidden;
    }

    .back-to-home {
        font-size: 19px;
        font-weight: bold;
        text-decoration: underline;
        color: #3939396b;
        transition: 0.3s;
        font-family: 'Dosis', sans-serif;
    }

    .back-to-home:hover {
        color: #ea782a;
    }
</style>
