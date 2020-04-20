<template>
        <div class="prodcut-signle p-2">
            <div class="product_image">
                <img :src="product.featureImage" alt="" style="width:100%">
            </div>
            <div class="p_category_and_love d-flex justify-content-between">
                <div class="category">
                    {{product.categoryData.name}}
                </div>
                <div class="love">
                    <a href="#"><i class="far fa-heart"
                                   style="color:red;"></i></a><span> {{product.total_favourites}}</span>
                </div>
            </div>
            <hr class="m-0 p-0">
            <h5 class="product_title text-center pt-2 pb-2">
                <router-link :to="{name: 'product-details', params:{slug:product.slug}}">
                    {{product.name}}
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
            <router-link class="btn btn-success btn-block mt-3" tag="button" :to="{name: 'product-details', params:{slug:product.slug}}">
                Laes mere
            </router-link>
        </div>
</template>

<script>
    export default {
        name: "SingleProduct",
        props: ['product']
    }
</script>

<style scoped>

</style>
