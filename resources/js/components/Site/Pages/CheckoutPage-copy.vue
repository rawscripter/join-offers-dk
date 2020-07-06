<template>
    <div class="page-wrapper">
        <div class="container">
            <loading :active.sync="isLoading"
                     :is-full-page="true"></loading>
            <!-- start checkout product info area  -->
            <div v-if="!isLoading">
                <div class="product-info-area mt-4 shadow-sm p-4">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th>si</th>
                                <th>photo</th>
                                <th>Begivenheds</th>
                                <th>Deltagelsespris <br>
                                    (del 1 of two betalinger)
                                </th>
                                <th>Antal</th>
                                <th>Note</th>
                                <th>| alt</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <img :src="product.thumbImage" :alt="product.name" style="width:50px">
                                </td>
                                <td>
                                    <router-link class="text-default"
                                                 :to="{name: 'product-details', params:{slug:product.slug}}">
                                        {{product.name}}
                                    </router-link>
                                </td>
                                <td>
                                    {{ product.join_price}} <br>
                                    {{ product.join_payment_percentage }} % of
                                    {{product.offer_price}}
                                </td>
                                <td>
                                    <button type="button" @click="decreaseOrderQuantity"
                                            class="btn btn-success btn-sm rounded mr-0"><i
                                        class="fas fa-arrows-alt-h"></i></button>
                                    <input type="number" id="oqty" min="1" v-model="orderDetails.quantity"
                                           style="width:70px;text-align:center">
                                    <button type="button" @click="increaseOrderQuantity" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                                <td style="width:25%">
                                    <p class="m-0 p-0">1. Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                                </td>
                                <td>
                                    {{orderDetails.totalPrice}} <br>
                                    Heraf moms : xxs
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end checkout product info area  -->
                <!-- start checkout billing area  -->
                <div class="checkout-billing-area mt-4">
                    <div class="row">
                        <div class="ml-auto col-md-4 col-lg-4">
                            <div class="checkout-customer-info">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>1.Address</h6>
                                        <div v-if="!isUserLoggedIn" class="fom-group text-center">
                                            <div @click="goToLogin" class="btn btn-success">Log Ind ?</div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="#" id="checkoutInforForm">
                                            <div class="form-group">
                                                <label>Name *</label>
                                                <input type="text" class="form-control form-control-sm rounded-0"
                                                       name="name">
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name *</label>
                                                <input type="text" class="form-control form-control-sm rounded-0"
                                                       name="last_name">
                                            </div>
                                            <div class="form-group">
                                                <label>Company Name (Only for companies)</label>
                                                <input type="text" class="form-control form-control-sm rounded-0"
                                                       name="company_name">
                                            </div>
                                            <div class="form-group">
                                                <label>CVR number (Only for companies)</label>
                                                <input type="text" class="form-control form-control-sm rounded-0"
                                                       name="cbr_number">
                                            </div>
                                            <div class="form-group">
                                                <label>EAN number (Only for institutions)</label>
                                                <input type="text" class="form-control form-control-sm rounded-0"
                                                       name="ean_number">
                                            </div>
                                            <div class="form-group">
                                                <label>Address *</label>
                                                <input type="text" class="form-control form-control-sm rounded-0"
                                                       name="address">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 ml-0 pl-0">
                                                    <div class="form-group">
                                                        <label>City *</label>
                                                        <input type="text"
                                                               class="form-control form-control-sm rounded-0"
                                                               name="city">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 mr-0 pr-0">
                                                    <div class="form-group">
                                                        <label>Postal code *</label>
                                                        <input type="text"
                                                               class="form-control form-control-sm rounded-0"
                                                               name="post_code">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email *</label>
                                                <input type="email" class="form-control form-control-sm rounded-0"
                                                       name="email">
                                            </div>
                                            <div class="form-group">
                                                <label>phone number *</label>
                                                <input type="text" class="form-control form-control-sm rounded-0"
                                                       name="email">
                                            </div>
                                            <div class="form-group">
                                                <label>Note to joinoffers *</label>
                                                <textarea class="form-control form-control-sm" name="note"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- start checkout billing area  -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CheckoutPage",
        data() {
            return {
                isLoading: false,
                product: null,
                productSlug: null,
                isUserLoggedIn: User.loggedIn(),
                orderDetails: {
                    productId: null,
                    quantity: 1,
                    totalPrice: 0,
                    unitPrice: 0,
                }
            }
        },
        watch: {
            'orderDetails.quantity'(val) {
                this.orderDetails.totalPrice = this.orderDetails.unitPrice * val
            }
        },
        methods: {
            increaseOrderQuantity() {
                this.orderDetails.quantity++;
            },
            decreaseOrderQuantity() {
                if (this.orderDetails.quantity > 1) {
                    this.orderDetails.quantity--;
                } else {
                    alert('Minimum order Quantity is 1');
                }
            },
            goToLogin() {
                this.$router.push({name: 'login', query: {redirect: `/checkout/${this.productSlug}`}});
            },
            getProduct(slug) {
                axios.get(`${APP_URL}/api/product/${slug}`)
                    .then(res => {
                        this.isLoading = false;
                        this.product = res.data.product;
                        this.orderDetails.totalPrice = res.data.product.join_price;
                        this.orderDetails.unitPrice = res.data.product.join_price;
                    }).catch(error => {
                    console.error(error)
                })
            },
        },
        created() {
            this.isLoading = true;
            this.productSlug = this.$route.params.slug;
            this.getProduct(this.productSlug);
        },
    }
</script>

<style scoped>
    .form-group {
        margin-bottom: 0rem;
    }

    .form-group {
        margin-bottom: 0rem;
    }

    /* .form-control {
        height: calc(1.5em + .75rem + 15px);
    } */
    .paymethode-area {
        margin-top: 10px;
    }

    .paymethode-area p {
        color: #989191;
        font-size: 14px;
        margin-top: 4px;
        text-transform: uppercase;
    }

    .paymethode-area img {
        width: 30px;
        height: 22px;
        margin: 2px;
    }

    .terms-condition-single input {
        margin-right: 10px;
        margin-top: 5px;
    }

    input.form-control.form-control-sm.rounded-0 {
        margin-bottom: 8px;
        height: 40px;
        border-radius: 5px !important;
        border-color: #e8e8e8;
    }

    #oqty {
        width: 100px;
        text-align: center;
        /* border-color: #aaaaaa; */
        border: 1px solid #eaeaea;
        padding: 5px 10px;
        font-size: 16px;
        color: #858585;
        border-radius: 4px;
    }

    .text-default {
        color: #000 !important;
    }
</style>
