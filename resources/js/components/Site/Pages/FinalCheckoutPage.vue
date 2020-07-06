<template>
    <div class="page-wrapper">
        <div class="container">
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
                                    <img :src="product.thumbImage" v-if="product.thumbImage != null" :alt="product.name"
                                         style="width:50px">
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
                                    {{((order.second_payment_amount)) }} Kr
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end checkout product info area  -->

                <!-- start checkout billing area  -->
                <div class="checkout-billing-area mt-4" v-if="!isLoading">
                    <div class="row">
                        <div class="col-12  col-lg-12">
                            <div id="dibs-complete-checkout"></div>
                        </div>
                           
                        <div class="col-md-4 col-lg-4" v-if="!hideOrderDetailsForm">
                            <div class="checkout-customer-info">
                                <div class="card border-0 shadow">
                                    <div class="card-body">
                                        <div class="form-title mb-4 text-muted">
                                            <h5>Shipping Address</h5>
                                        </div>
                                        <form action="#" id="checkoutInforForm" @submit.prevent="saveShippingMethod">
                                            <div class="form-group">
                                                <label>Name *</label>
                                                <input v-model="shippingInfo.name" type="text"
                                                       class="form-control form-control-sm rounded-0"
                                                       name="name">
                                            </div>
                                            <div class="form-group">
                                                <label>Address *</label>
                                                <input v-model="shippingInfo.address" type="text"
                                                       class="form-control form-control-sm rounded-0"
                                                       name="address">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 ml-0 pl-0">
                                                    <div class="form-group">
                                                        <label>City *</label>
                                                        <input type="text"
                                                               v-model="shippingInfo.city"
                                                               class="form-control form-control-sm rounded-0"
                                                               name="city">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 mr-0 pr-0">
                                                    <div class="form-group">
                                                        <label>Postal code *</label>
                                                        <input type="text"
                                                               v-model="shippingInfo.zip_code"
                                                               class="form-control form-control-sm rounded-0"
                                                               name="post_code">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email *</label>
                                                <input type="email" v-model="shippingInfo.email"
                                                       class="form-control form-control-sm rounded-0"
                                                       name="email">
                                            </div>
                                            <div class="form-group">
                                                <label>phone number *</label>
                                                <input v-model="shippingInfo.phone" type="text"
                                                       class="form-control form-control-sm rounded-0"
                                                       name="email">
                                            </div>
                                            <div class="form-group">
                                                <label>Note</label>
                                                <textarea v-model="shippingInfo.note"
                                                          class="form-control form-control-sm"
                                                          rows="4"
                                                          name="note"></textarea>
                                            </div>

                                            <div class="form-group mt-3">
                                                <button type="submit" class="btn btn-block btn-theme">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4" :class="enableShippingMethodArea ? 'enable' : 'disable' "
                             v-if="!hideOrderDetailsForm">
                            <div class="checkout-customer-info">
                                <div class="card border-0 ">
                                    <div class="card-body shadow">
                                        <div class="form-title mb-4 text-muted">
                                            <h5>Shipping Method</h5>
                                        </div>
                                        <div class="delivery-methods">
                                            <div v-for="(method,index) in shippingMethods" class="method bordered p-3"
                                                 :class="index === selectedMethod ? 'active': ''"
                                                 @click="selectedMethod = index">
                                                <div class="method-title">
                                                    <h5>
                                                        <strong>{{method.CompanyName}}</strong>
                                                    </h5>
                                                    <small> <span class="text-muted">{{method.CityName}}</span></small>
                                                </div>
                                                <div class="method-details text-muted">
                                                    Address: {{method.Streetname}} , {{method.Streetname2}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- start checkout billing area  -->

                        <div class="col-12 col-lg-4" :class="enablePaymentArea ? 'enable' : 'disable' "
                             v-if="!hideOrderDetailsForm">
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
                                                <td>{{product.offer_price + order.variant_total}} Kr</td>
                                            </tr>


                                            <!--                                            <tr>-->
                                            <!--                                                <td><strong>Din betaling:</strong></td>-->
                                            <!--                                                <td> {{ product.join_price}} Kr ({{ product.join_payment_percentage }}-->
                                            <!--                                                    % of-->
                                            <!--                                                    {{product.offer_price}} Kr)-->
                                            <!--                                                </td>-->
                                            <!--                                            </tr>-->
                                            <tr>
                                                <td><strong>Antal</strong>:</td>
                                                <td>{{orderDetails.quantity}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total:</strong></td>
                                                <td> {{((order.second_payment_amount)) }} dkk
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" colspan="2">
                                                    <button @click="payNow"
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
                selectedMethod: 0,
                isLoading: false,
                isPaymentLoading: false,
                product: null,
                order: null,
                orderID: null,
                productSlug: null,
                isUserLoggedIn: User.loggedIn(),
                shippingInfo: {
                    name: null,
                    email: null,
                    address: null,
                    city: null,
                    zip_code: null,
                    phone: null,
                    note: null
                },
                orderDetails: {
                    newsletter: 0,
                    productId: null,
                    quantity: 1,
                    totalPrice: 0,
                    unitPrice: 0,
                },
                shippingMethods: []
            }
        },
        methods: {
            saveShippingMethod() {
                axios.post(`${APP_URL}/api/order/${this.order.id}/shipping/update`, this.shippingInfo)
                    .then(response => {
                        this.getGLSPickupPoints();
                    })
                    .catch(error => {
                        Alert.showErrorAlert('Error');
                    })
            },

            getGLSPickupPoints() {
                axios.post(`${APP_URL}/api/gls/shops`, this.shippingInfo)
                    .then(response => {
                        this.isLoading = false;
                        this.shippingMethods = response.data.PakkeshopData;

                    })
                    .catch(error => {
                        Alert.showErrorAlert('Error');
                    })
            },
            getUserInfo() {
                this.isLoading = true;
                axios.get(`${APP_URL}/api/user/get/info`)
                    .then(response => {
                        this.isLoading = false;
                        this.shippingInfo = response.data
                        this.getGLSPickupPoints();
                    })
                    .catch(error => {
                        Alert.showErrorAlert('Error');
                    })
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

            payNow() {
                axios.post(`${APP_URL}/api/order/${this.order.id}/shipping/method/update`, {
                    shipping_method_type: 'gls',
                    shipping_method_details: this.shippingMethods[this.selectedMethod]
                })
                    .then(response => {
                        this.makeFullPaymentRequest();
                    })
                    .catch(error => {
                        Alert.showErrorAlert('Error');
                    })
            },
            makeFullPaymentRequest() {
                this.isPaymentLoading = true;
                axios.post(`${APP_URL}/api/payment/${this.order.id}/full-payment`)
                    .then(res => {
                        this.initCheckout(res.data.paymentId)
                        this.hideOrderDetailsForm = true;
                        this.isPaymentLoading = false;
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
        computed: {
            enablePaymentArea() {
                if (Array.isArray(this.shippingMethods)) {
                    return this.shippingMethods.length > 0;
                }
                return false;
            },
            enableShippingMethodArea() {
                return this.shippingInfo.city !== null && this.shippingInfo.zip_code !== null;
            }
        },
        created() {
            this.isLoading = true;
            this.orderID = this.$route.params.order;
            this.getOrderDetails(this.$route.params.order);
            this.getUserInfo();
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

    .delivery-methods .method {
        cursor: pointer;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .method.bordered {
        border: 1px solid #e2e2e2;
    }

    .method.bordered.active {
        border-color: #ff973a;
    }

    .disable {
        pointer-events: none;
        opacity: .5;
    }
</style>
