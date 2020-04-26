<template>
    <div class="prodcut-signle p-2">
        <div class="product_image">
            <img :src="product.featureImage" alt="" style="width:100%">
        </div>
        <div class="p_category_and_love d-flex justify-content-between">
            <div class="category">
                {{product.categoryData.name}}
            </div>
            <div class="love" v-if="isLiked" @click="removeProductToFavouriteList(product.slug)">
                <i class="fas fa-heart"
                   style="color:red;"></i>
                <span> {{totalLiked}}</span>
            </div>
            <div class="love" v-else @click="addProductToFavouriteList(product.slug)">
                <i class="far fa-heart"
                   style="color:red;"></i>
                <span> {{totalLiked}}</span>
            </div>

        </div>
        <hr class="m-0 p-0">
        <h5 class="product_title text-center pt-2 pb-2">
            <router-link :to="{name: 'product-details', params:{slug:product.slug}}">
                {{product.name}}
                <br>
            </router-link>
        </h5>
        <div class="short-description">
            <p class="text-center">{{product.short_des}} </p>
        </div>
        <div class="pricing-section d-flex justify-content-start">
            <div class="pricing-left">
                <h6><small>Gennemsnitlig markedsprice</small></h6>
                <h6>
                    <del>{{product.market_price}},-</del>
                </h6>
                <h6>Strtpris </h6>
                <h6>
                    <del>{{product.offer_price}},-</del>
                </h6>
                <h6>Du sprarer </h6>
                <button class="btn btn-success btn-sm">20%</button>
            </div>
            <div class="pricing-right">
                <h6><small>Deltagend</small></h6>
                <h6>{{product.total_offer_spots}}</h6>
                <h6><small>Din Pris</small></h6>
                <h6>{{product.last_price}}</h6>
            </div>
        </div>
        <router-link class="btn btn-success btn-block mt-3" tag="button"
                     :to="{name: 'product-details', params:{slug:product.slug}}">
            Laes mere
        </router-link>
    </div>
</template>

<script>
    export default {
        name: "SingleProduct",
        props: ['product'],
        methods: {
            addProductToFavouriteList(slug) {
                axios.get(`/api/product/${slug}/favourite/add`)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.product.isLikedByCurrentUser = true;
                            this.product.total_favourites++;
                        }
                    }).catch(err => console.log(err));
            },
            removeProductToFavouriteList(slug) {
                axios.get(`/api/product/${slug}/favourite/remove`)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.product.isLikedByCurrentUser = false;
                            this.product.total_favourites--;
                        }
                    }).catch(err => console.log(err));
            }
        },
        computed: {
            isLiked() {
                return this.product.isLikedByCurrentUser;
            },
            totalLiked() {
                return this.product.total_favourites;
            },
        }
    }
</script>

<style scoped>
    .love {
        cursor: pointer;
    }
</style>
