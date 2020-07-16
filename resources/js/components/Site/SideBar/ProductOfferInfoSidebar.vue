<template>
    <div class="product_view_sidebar shadow  ">
        <div class="pricing-left">
            <h6>Gennemsnitlig markedspris</h6>
            <h5>
                <del>{{product.market_price}} Kr-</del>
            </h5>
            <h6>Startpris </h6>
            <h6>
                <span v-if="product.current_price != product.offer_price"> <del>{{product.offer_price}} Kr-</del></span>
                <span v-else><h5>{{product.offer_price}} Kr</h5></span>
            </h6>
            <h6>Deltagere</h6>
            <h5>{{product.totalOrders}}</h5>
            <h6>Den nuværende pris</h6>
            <h5>{{product.current_price}} Kr</h5>
            <!--            total save-->
            <div class="product-variations mt-3 mb-3" v-if="product.product_variation.length > 0">
                <div v-for="(variation,variationIndex) in product.product_variation" class="pt-2 pb-2">
                    <div><strong>{{variation.name}}:</strong></div>
                    <div class="variations">
                        <div class="variation"
                             v-for="(option,optionIndex) in variation.options">
                            <input class="hidden radio-label" :id="`radio-btn-${option.id}`"
                                   type="radio"
                                   :value="option.id"
                                   :name="`variationOption[${variation.id}]`"
                            />
                            <label
                                @click="changeProductPriceOnVariationChange(variation.id,option.id,option.price)"
                                class="button-label" :for="`radio-btn-${option.id}`">
                                <span> {{option.name}} <span v-if="option.price >0">+{{option.price}}kr</span></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="love-section clearfix">
                <button v-if="product.isLikedByCurrentUser" class="btn btn-success"> {{product.totalLikes}} <i
                    class="fas fa-heart"
                    style="color:red"></i></button>
                <button v-else @click="addProductToLikeList(product.slug)" class="btn btn-success">
                    {{product.totalLikes}} <i class="far fa-heart"></i></button>
            </div>
            <button class="btn mt-1 btn-success">Du sparer {{product.saving_percentage}}%</button>
        </div>
        <div class="checkout mt-3 mb-3" v-if="isOfferTimeStarted">
            <router-link v-if="!isExpired" class="btn btn-theme btn-block" tag="div"
                         :to="{name: 'checkout', params:{slug:product.slug}}">
                Ordre nu
            </router-link>
            <div v-if="isExpired" @click="productRequestModal=true" class="btn btn-theme btn-block">
                Fremsætte en anmodning
            </div>
        </div>

        <div class="sidebar-action">
            <p @click="addProductToFavouriteList(product.slug)" v-if="!isUserFavourite"><img
                src="/images/icons/favorite.png" height="20" alt=""> Gem till favouriter</p>
            <br>
            <p @click="addProductToReminderList(product.slug)"><i class="fas fa-sync  mr-2"></i> Pamind mig</p>
            <br>
            <p @click="showModal=true">
                <img src="/images/icons/share.png" height="20" width="20" alt="">
                Del</p>
            <div class="sidebar-social mt-2 d-flex justify-content-around">
            </div>
        </div>

        <div v-if="product" class="modal fade bd-example-modal-sm show"
             tabindex="-1" role="dialog"
             aria-labelledby="mySmallModalLabel"
             :class="showModal?'active':''"
             style="padding-right: 17px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mySmallModalLabel">Del begivenhed</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span @click="showModal=false" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <social-sharing
                            :url="getProductUrl"
                            :title="product.name"
                            :description="product.short_des"
                            :quote="product.short_des"
                            inline-template>
                            <div id="social-share">
                                <network class="social" network="email">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Email.png" alt=""> Email
                                </network>
                                <network class="social" network="facebook">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Facebook.png" alt="">
                                    Facebook
                                </network>
                                <network class="social" network="googleplus">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Google+.png" alt=""> Google +
                                </network>
                                <network class="social" network="line">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Line.png" alt=""> Line
                                </network>
                                <network class="social" network="linkedin">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---LinkedIn.png" alt="">
                                    LinkedIn
                                </network>
                                <network class="social" network="pinterest">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Pinterest.png" alt="">
                                    Pinterest
                                </network>
                                <network class="social" network="reddit">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Reddit.png" alt=""> Reddit
                                </network>
                                <network class="social" network="skype">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Skype.png" alt=""> Skype
                                </network>
                                <network class="social" network="sms">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---SMS.png" alt=""> SMS
                                </network>
                                <network class="social" network="telegram">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Telegram.png" alt="">
                                    Telegram
                                </network>
                                <network class="social" network="twitter">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Twitter.png" alt=""> Twitter
                                </network>
                                <network class="social" network="vk">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Vkontakte.png" alt="">
                                    VKontakte
                                </network>
                                <network class="social" network="weibo">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Weibo.png" alt=""> Weibo
                                </network>
                                <network class="social" network="whatsapp">
                                    <img width="20" src="/images/icons/JoinOffers---Ikon---Whatsapp.png" alt="">
                                    Whatsapp
                                </network>
                            </div>
                        </social-sharing>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="productRequestModal" class="modal fade bd-example-modal-sm show"
             tabindex="-1" role="dialog"
             aria-labelledby="mySmallModalLabel"
             :class="productRequestModal?'active':''"
             style="padding-right: 17px;">
            <div class="modal-dialog" style="margin-top: 250px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productRequestModal">Indsend tilbudsanmodning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span @click="productRequestModal=false" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="submitProductRequest">
                            <div class="form-group">
                                <label for="product">E-mail:</label>
                                <input type="email" required v-model="productRequest.email" class="form-control"
                                       id="product">
                            </div>

                            <div class="form-group">
                                <label for="note">Bemærk:</label>
                                <textarea v-model="productRequest.note" class="form-control" id="note" cols="10"
                                          rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-theme btn-block">Submit Request</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ProductOfferInfoSidebar",
        props: ['product'],
        data() {
            return {
                selectedVariations: [],
                showModal: false,
                productRequestModal: false,
                isUserLiked: false,
                isUserFavourite: false,
                totalLikes: 0,
                isUserLogin: User.loggedIn(),
                productRequest: {
                    email: null,
                    note: null,
                    type: 'expired'
                },

            }
        },
        methods: {
            changeProductPriceOnVariationChange(variationID, optionID, price) {
                let selectedIndex = this.selectedVariations.findIndex(x => x.variationID === variationID);

                // already selected
                if (selectedIndex !== -1) {

                    if (this.selectedVariations[selectedIndex].optionID === optionID) return;

                    let optionVariationOptionId = this.selectedVariations[selectedIndex].optionID;

                    let productVariations = this.product.product_variation[selectedIndex];
                    let optionVariationOptionIndex = productVariations.options.findIndex(x => x.id === parseInt(optionVariationOptionId));

                    let optionVariationOption = productVariations.options[optionVariationOptionIndex];

                    //let newPrice = ((this.product.join_payment_percentage / 100) * price);

                    this.product.current_price -= optionVariationOption.price;


                    this.selectedVariations[selectedIndex].optionID = optionID;
                } else {
                    let newObject = {
                        variationID: variationID,
                        optionID: optionID
                    }
                    this.selectedVariations.push(newObject)
                }

                this.$cookies.set(`product-variation-${this.product.id}`, JSON.stringify(this.selectedVariations), 60 * 5)

                this.product.current_price += price;
            },
            submitProductRequest() {
                axios.post(`/api/product/${this.product.slug}/make/request`, this.productRequest)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.productRequestModal = false;
                            Alert.showSuccessAlert(res.data.message);
                            this.productRequest.email = null;
                            this.productRequest.note = null;
                        } else {
                            alert(res.data.message);
                        }
                    }).catch(err => console.log(err));
            },
            addProductToLikeList(slug) {
                axios.get(`/api/product/${slug}/like/add`)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.isUserLiked = res.data.product.isLikedByCurrentUser;
                            this.totalLikes++;

                        } else {
                            alert(res.data.message);
                        }
                    }).catch(err => console.log(err));
            },
            addProductToFavouriteList(slug) {
                if (!this.isUserLogin) {
                    this.$root.$emit('callProductRequestModal', this.product);
                    return;
                }
                axios.get(`/api/product/${slug}/favourite/add`)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.isUserFavourite = res.data.product.isFavouriteByCurrentUser;
                            Alert.showSuccessAlert('Event added to favourite list.');
                            this.$root.$emit('updateFavouriteProductList', true);
                        } else {
                            alert(res.data.message);
                        }
                    }).catch(err => console.log(err));
            },
            addProductToReminderList(slug) {
                axios.get(`/api/product/${slug}/reminder/add`)
                    .then(res => {
                        if (res.data.status === 200) {
                            Alert.showSuccessAlert('Event added to reminder list.');
                            this.$root.$emit('updateFavouriteProductList', true);
                            this.$root.$emit('updateFavouriteProductList', true);
                        } else {
                            alert(res.data.message);
                        }
                    }).catch(err => console.log(err));
            },
            removeProductToFavouriteList(slug) {
                axios.get(`/api/product/${slug}/favourite/remove`)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.isUserFavourite = res.data.product.isFavouriteByCurrentUser;
                            Alert.showSuccessAlert('Event removed from favourite list.')
                        }
                    }).catch(err => console.log(err));
            }
        },
        computed: {
            getProductUrl() {
                return `${APP_URL}/product/${this.product.slug}`;
            },

            isExpired() {
                let now = new Date();
                let expire = new Date(this.product.expire_date);
                return now > expire;
            },
            isLiked() {
                return this.product.isLikedByCurrentUser;
            },
            totalLiked() {
                return this.product.total_favourites;
            },
            isOfferTimeStarted() {
                let startDate = new Date(this.product.offer_start_date);
                let current_date = Date.now();
                return current_date > startDate;
            }
        },
        mounted() {
            this.isUserLiked = this.product.isLikedByCurrentUser;
            this.isUserFavourite = this.product.isFavouriteByCurrentUser;
            this.totalLikes = this.product.total_likes;
        },

    }
</script>

<style scoped>
    small {
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    h5 {
        font-weight: 700;
        font-size: 17px;
    }

    .sidebar-action {
        cursor: pointer;
    }

    .variations {
        display: flow-root;
    }

    .active {
        display: block;
    }

    .product_view_sidebar.shadow.position-fixed {
        min-width: 280px;
        max-width: 300px;
    }


    .button-wrap {
        position: relative;
        text-align: center;
        top: 50%;
        margin-top: -2.5em;
    }

    @media (max-width: 40em) {
        .button-wrap {
            margin-top: -1.5em;
        }
    }

    .variation {
        float: left;
    }

    .button-label {
        display: inline-block;
        padding: 5px 15px;
        margin-right: 0.5em;
        margin-top: 0.5em;
        cursor: pointer;
        color: #292929;
        border-radius: 0.25em;
        background: #ffffff;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2), inset 0 -3px 0 rgba(0, 0, 0, 0.22);
        transition: 0.3s;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-size: 15px;
    }

    .button-label h1 {
        font-size: 1em;
        font-family: "Lato", sans-serif;
    }

    .button-label:hover {
        background: #d6d6d6;
        color: #101010;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2), inset 0 -3px 0 rgba(0, 0, 0, 0.32);
    }

    .button-label:active {
        -webkit-transform: translateY(2px);
        transform: translateY(2px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2), inset 0px -1px 0 rgba(0, 0, 0, 0.22);
    }

    @media (max-width: 40em) {
        .button-label {
            padding: 0em 1em 3px;
            margin: 0.25em;
        }
    }

    .radio-label:checked + .button-label {
        background: #ff844e;
        color: #efefef;
    }

    .hidden {
        display: none;
    }

    .clearfix {
        clear: both;
    }
</style>
