<template>
    <div class="page-wrapper">
        <div class="container">
            <loading :active.sync="isLoading"
                     :is-full-page="true"></loading>
            <!-- start checkout product info area  -->
            <div v-if="!isLoading">
                <div class="product-info-area mt-4 shadow-sm p-4" v-if="!hideOrderDetailsForm">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Produkt image</th>
                                <th>Begivenheds</th>
                                <th>Nuværende pris</th>
                                <th>Antal</th>
                                <th>Første betalte beløb</th>
                                <th>Anden betaling Beløb</th>
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
                                    {{product.current_price}} Kr
                                </td>
                                <td>
                                    {{order.quantity}}
                                </td>
                                <td>
                                    {{order.first_payment.amount}} Kr
                                </td>
                                <td>
                                    {{(order.product.current_price * order.quantity) -
                                    order.first_payment.amount}} Kr
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end checkout product info area  -->
                <UserLoginRegisterButton v-if="!isUserLoggedIn" :productSlug="productSlug"></UserLoginRegisterButton>

                <!-- start checkout billing area  -->
                <div class="checkout-billing-area mt-4" v-if="isUserLoggedIn">
                    <div class="row">
                        <div class="col-12  col-lg-12">
                            <div id="dibs-complete-checkout"></div>
                        </div>
                           
                        <div class="ml-auto col-12 col-lg-4" v-if="!hideOrderDetailsForm">
                            <loading :active.sync="isPaymentLoading"
                                     :is-full-page="false"></loading>
                            <div class="checkout-customer-info">
                                <div class="cards shadow">
                                    <div class="card-header-title">
                                        <h5 class="text-center"><strong>Ordre detaljer</strong></h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="checkout-table table table-hover" style="width:100%">
                                            <tr>
                                                <td><strong>Produkt titel:</strong></td>
                                                <td>{{product.name}}</td>
                                            </tr>

                                            <tr>
                                                <td><strong>Produkt pris:</strong></td>
                                                <td>{{product.offer_price}} Kr</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Din betaling:</strong></td>
                                                <td> {{ product.join_price}} Kr ({{ product.join_payment_percentage }}
                                                    % of
                                                    {{product.offer_price}} Kr)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Antal</strong>:</td>
                                                <td>{{orderDetails.quantity}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total</strong>:</td>
                                                <td>{{orderDetails.totalPrice}} Kr</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div>
                                                        {{order.quantity}}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" colspan="2">
                                                    <button @click="createOrder"
                                                            class="btn btn-block mt-3 btn-success">Ordre Nu
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
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
    import UserLoginRegisterButton from "../Layout/UserLoginRegisterButton";

    export default {
        name: "CheckoutPage",
        components: {
            UserLoginRegisterButton
        },
        data() {
            return {
                hideOrderDetailsForm: false,
                isLoading: false,
                isPaymentLoading: false,
                product: null,
                order: null,
                productSlug: null,
                isUserLoggedIn: User.loggedIn(),
                orderDetails: {
                    newsletter: 0,
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
                if (this.product.max_unit_per_user > this.orderDetails.quantity) {
                    this.orderDetails.quantity++;
                } else {
                    alert('Minimum order Quantity is ' + this.product.max_unit_per_user);
                }

            },
            decreaseOrderQuantity() {
                if (this.orderDetails.quantity > 1) {
                    this.orderDetails.quantity--;
                } else {
                    alert('Minimum order Quantity is 1');
                }
            },
            getProduct(slug) {
                axios.get(`${APP_URL}/api/product/${slug}`)
                    .then(res => {
                        this.isLoading = false;
                        this.product = res.data.product;
                        this.orderDetails.productId = res.data.product.id;
                        this.orderDetails.totalPrice = res.data.product.join_price;
                        this.orderDetails.unitPrice = res.data.product.join_price;
                    }).catch(error => {
                    console.error(error)
                })
            },
            getOrderDetails(orderId) {
                axios.get(`${APP_URL}/api/order/${orderId}/details`)
                    .then(res => {
                        this.isLoading = false;
                        this.product = res.data.order.product;
                        this.order = res.data.order;

                    }).catch(error => {
                    console.error(error)
                })
            },

            createOrder() {
                this.isPaymentLoading = true;
                axios.post(`${APP_URL}/api/order/create`, this.orderDetails)
                    .then(res => {
                        this.initCheckout(res.data.paymentId)
                        this.hideOrderDetailsForm = true;
                    }).catch(error => {
                    console.error(error)
                })
            },
            initCheckout(paymentID) {
                this.isPaymentLoading = false;
                var checkoutOptions = {
                    checkoutKey: "test-checkout-key-500b92cc5d264cf88f5653ddc7a362d0", // for live [Required] Test or Live GUID with dashes
                    paymentId: paymentID, //[required] GUID without dashes
                    partnerMerchantNumber: "123456789", //[optional] Number
                    containerId: "dibs-complete-checkout", //[optional] defaultValue: dibs-checkout-content
                    language: "da-DK", //[optional] defaultValue: en-GB
                    theme: { // [optional] - will change defaults in the checkout
                        textColor: "blue", // any valid css color
                        linkColor: "#bada55", // any valid css color
                        panelTextColor: "rgb(125, 125, 125)", // any valid css color
                        panelLinkColor: "#0094cf", // any valid css color
                        primaryColor: "#0094cf", // any valid css color
                        buttonRadius: "50px", // pixel or percentage value
                        buttonTextColor: "#fff", // any valid css color
                        backgroundColor: "#fafafa", // any valid css color
                        panelColor: "#fff", // any valid css color
                        outlineColor: "#444", // any valid css color
                        primaryOutlineColor: "#444", // any valid css color   }
                    }
                }
                var checkout = new Dibs.Checkout(checkoutOptions);

                //this is the event that the merchant should listen to redirect to the “payment-is-ok” page

                checkout.on('payment-completed', function (response) {
                    /*
                                Response:
                                paymentId: string (GUID without dashes)
                                */
                    window.location = '/checkout?paymentId=' + response.paymentId;
                });
            }
        },
        created() {
            this.isLoading = true;
            // this.productSlug = this.$route.params.order;
            this.getOrderDetails(this.$route.params.order);
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

    .checkout-table tr {
        margin-top: 10px;
    }

    .checkmark {
        border-radius: 0%;
    }
</style>
