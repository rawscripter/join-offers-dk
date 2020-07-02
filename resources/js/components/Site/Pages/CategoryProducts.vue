<template>
    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-3">
                    <ProductFilter @filterFromResetCompleted="filterFromResetCompleted"
                                   :callResetFilterFunction="resetFilter" @filterProduct="eventHandler"></ProductFilter>
                </div>
                <div class="col-md-10 col-lg-9" style="background:#fff">
                    <div class="main-content">
                        <SubCategoryMenuBar :categorySlug="categorySlug"
                                            :subCategories="subCategories"
                                            @selectedSubCategory="selectedSubCategory"
                        ></SubCategoryMenuBar>
                        <loading :active.sync="isLoading"
                                 :is-full-page="false"></loading>
                        <div class="product-area" v-if="totalProducts">
                            <div class="row">
                                <div v-for="product in products" :key="product.id"
                                     class="col-md-4 wow bounceIn col-lg-4 col-sm-6 shadow-sm ml-0 pl-0 mr-0 pr-0">
                                    <!-- product single  -->
                                    <SingleProduct :product="product"></SingleProduct>
                                    <!-- end of product single  -->
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="text-center mt-5">
                                <h3 class="big-error-font">
                                    <strong>
                                        {{errorText}}
                                    </strong>
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

    import ProductFilter from "../SideBar/ProductFilter";
    import SubCategoryMenuBar from "../Layout/SubCategoryMenuBar";
    import SingleProduct from "../Layout/Product/Loop/SingleProduct";

    export default {
        name: "CategoryProducts",
        components: {
            ProductFilter,
            SubCategoryMenuBar,
            SingleProduct,
        },
        data() {
            return {
                errorText: 'Loading...',
                isLoading: false,
                products: [],
                subCategories: [],
                categorySlug: null,
                page: 1,
                lastPage: 2,
                infiniteId: +new Date(),
                resetFilter: false,
                query: {
                    gender: 'All',
                    short: 'New',
                    minPrice: 0,
                    maxPrice: 99999,
                    subCategoryId: null,
                }
            }
        },
        methods: {
            filterFromResetCompleted() {
                this.resetFilter = false;
            },
            selectedSubCategory(selectedSubIndex) {
                this.resetFilter = true;
                this.query.subCategoryId = this.subCategories[selectedSubIndex].id;
            },
            eventHandler(data) {
                this.query.gender = data.gender;
                this.query.short = data.short;
                this.query.minPrice = data.priceRange[0];
                this.query.maxPrice = data.priceRange[1];
                this.resetState();
            },
            resetState() {
                this.page = 1;
                this.lastPage = 2;
                this.products = [];
                this.loadMore();
            },
            loadMore() {
                this.isLoading = true;
                let vm = this;
                let categorySlug = this.categorySlug;
                setTimeout(e => {
                    //send axios request
                    axios.get(`${APP_URL}/api/category/${categorySlug}/products?page=` + this.page, {
                        params: {
                            gender: vm.query.gender,
                            short: vm.query.short,
                            minPrice: vm.query.minPrice,
                            maxPrice: vm.query.maxPrice,
                            subCategory: vm.query.subCategoryId,
                        }
                    })
                        .then(response => {
                            this.isLoading = false;
                            this.lastPage = response.data.lastPage;
                            if (response.data.products != '') {
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

            getSubCategories(categorySlug) {
                axios.get(`${APP_URL}/api/category/${categorySlug}/sub-categories`)
                    .then(res => {
                        this.subCategories = res.data.subCategories;
                    }).catch(error => {
                    console.error(error)
                })
            },
        },
        computed: {
            totalProducts() {
                return this.products.length > 0;
            },
            hasMorePages() {
                return this.lastPage >= this.page;
            },
        },
        created() {
            this.categorySlug = this.$route.params.category;
            this.getSubCategories(this.$route.params.category);
            this.isLoading = true;
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
    .product-area {
        min-height: 50vh;
        overflow: hidden;
    }


    .big-error-font {
        font-size: 48px;
        color: #3939396b;
        margin-top: 150px !important;
    }
</style>
