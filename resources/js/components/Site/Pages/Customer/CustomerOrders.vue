<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-2">
                    <CustomerLeftSidebar></CustomerLeftSidebar>
                </div>
                <div class="col-md-9 col-lg-10" style="background:#fff">

                    <div id="dibs-complete-checkout"></div>
                    <div class="main-content" v-if="!hideOrderDetailsForm">
                        <loading :active.sync="isPaymentBoxLoading"
                                 :is-full-page="false"></loading>
                        <div class="user-profile-all-order p-3">
                            <h5 class="text-center">My JoinOffers</h5>
                            <hr>
                            <div v-for="(order,index) in orders" class="table-responsive shadow wow bounceInUp">
                                <div class="text-center mb-2"><strong>Order #{{order.custom_order_id}}</strong></div>
                                <table class="table table-bordered text-center">
                                    <tr>
                                        <td rowspan="4" style="width:15%">
                                            <router-link
                                                :to="{name: 'product-details', params:{slug:order.product.slug}}">
                                                <img :src="order.product.featureImage" alt="Product image"
                                                     style="width:100%;">
                                            </router-link>
                                        </td>
                                        <td style="width:35%">
                                            Product Name:
                                            <router-link
                                                :to="{name: 'product-details', params:{slug:order.product.slug}}">
                                                <strong>{{order.product.name}}</strong>
                                            </router-link>
                                        </td>
                                        <td style="width:15%">Average Prince:
                                            <strong>{{order.product.market_price}} dkk</strong></td>
                                        <td style="width:15%">
                                            Order Quantity: <strong>{{order.quantity}}</strong>
                                        </td>
                                        <td style="width:15%" rowspan="2" v-if="!order.is_canceled">
                                            <div class="text-center mb-2"><strong>First Payment
                                                ({{order.first_payment.amount}} dkk)</strong></div>
                                            <button style="width: 120px" class="btn non-hover btn-info btn-sm">Paid
                                            </button>
                                        </td>
                                        <td style="width:15%" rowspan="4" v-else>
                                            <button style="width: 120px" class="btn btn-danger btn-sm">Canceled</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Event ID: <strong> #{{order.product.event_id}}</strong>
                                        </td>
                                        <td style="width:15%">
                                            Start Prince:
                                            <strong>{{order.product.offer_price}} dkk</strong>
                                        </td>
                                        <td style="width:15%">Participants:
                                            <strong>{{order.product.totalOrders}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">
                                            Offer Start Date: <strong> {{order.product.created_at}}</strong>
                                        </td>
                                        <td style="width:15%">
                                            Current Price:
                                            <strong>{{order.product.current_price}} dkk</strong>
                                        </td>
                                        <td style="width:15%;" rowspan="2">
                                            <router-link
                                                :to="{name:'product.graph',params:{product:order.product.event_id}}">
                                                <img src="/images/icons/price-fall.gif" width="150px" alt="">
                                                <span class="d-block btn btn-default btn-sm">Show Graph</span>
                                            </router-link>
                                        </td>
                                        <td style="width:15%" rowspan="2" v-if="!order.is_canceled">
                                            <div class="text-center mb-2"><strong>Second Payment
                                                ({{(order.product.current_price * order.quantity) -
                                                order.first_payment.amount}} dkk)</strong></div>
                                            <div class="timer text-center mt-2 mb-2">
                                                <vac :end-time="new Date(order.product.expire_date)">
                                                    <div
                                                        class="timer-area d-flex justify-content-center mt-3 mb-3"
                                                        slot="process"
                                                        slot-scope="{ timeObj }">
                                                        <div class="clock">
                                                            <div class="well bottom-pane">
                                                                <div id="days" class="num">{{timeObj.d}}</div>
                                                            </div>
                                                        </div>

                                                        <div class="clock">

                                                            <div class="well bottom-pane">
                                                                <div id="hours" class="num">{{timeObj.h}}</div>
                                                            </div>
                                                        </div>
                                                        <div class="clock">

                                                            <div class="well bottom-pane">
                                                                <div id="mins" class="num">{{timeObj.m}}</div>
                                                            </div>
                                                        </div>

                                                        <div class="clock">
                                                            <div class="well bottom-pane">
                                                                <div id="secs" class="num">{{timeObj.s}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span slot="finish" class="expired">
<!--                                                           <button v-if="!order.is_full_price_paid"-->
                                                        <!--                                                                   @click="payOrderFullPrice(index)"-->
                                                        <!--                                                                   style="width: 120px"-->
                                                        <!--                                                                   class="btn btn-success btn-sm">-->
                                                        <!--                                                               Pay now-->
                                                        <!--                                            </button>-->

                                                        <div v-if="!order.is_full_price_paid"
                                                             style="width: 120px;margin: 0 auto;">
                                                            <router-link
                                                                :to="{name:'final-checkout',params:{order:order.custom_order_id}}"
                                                                class="btn btn-block btn-success btn-sm">
                                                                Pay now
                                                            </router-link>
                                                        </div>
                                            <button v-else style="width: 120px" class="btn  non-hover btn-info btn-sm">Paid
                                            </button>
                                                    </span>
                                                </vac>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">
                                            Offer End Date: <strong>{{order.product.expire_date}}</strong>
                                        </td>
                                        <td style="width:15%">Saving Percentage:
                                            <strong>{{order.product.saving_percentage}}%</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


    import CustomerLeftSidebar from "../../Layout/Customer/CustomerLeftSidebar";

    export default {
        name: "CustomerOrders",
        components: {
            CustomerLeftSidebar,
        },

        data() {
            return {
                showChartModal: true,

                orderType: 'running',
                orders: [],
                isLoading: false,
                isPaymentBoxLoading: false,
                hideOrderDetailsForm: false,
                orderDetails: {
                    productId: null,
                    quantity: 1,
                    totalPrice: 0,
                    unitPrice: 0,
                }
            }
        },
        methods: {
            getCustomerOrders() {
                axios.get(`${APP_URL}/api/customer/orders?status=${this.orderType}`)
                    .then(res => {
                        this.isLoading = false;
                        this.orders = res.data.orders;
                    }).catch(error => {
                    console.error(error)
                })
            },
            payOrderFullPrice(orderIndex) {
                this.isPaymentBoxLoading = true;
                this.makeFullPaymentRequest(orderIndex);
            },

            makeFullPaymentRequest(orderIndex) {
                this.isPaymentLoading = true;
                axios.post(`${APP_URL}/api/payment/${this.orders[orderIndex].id}/full-payment`)
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
        created() {
            this.isLoadin = true;
            if (this.$route.query.type) {
                this.orderType = this.$route.query.type;
            }

            this.getCustomerOrders()
        }
    }
</script>

<style scoped>
    .bottom-pane {
        margin-top: 0px;
        border-radius: 5px;
        background-color: #eaeaea;
        padding: 5px;
        border: 0px;
        text-align: center;
        width: 35px;
    }

    .num {
        font-size: 16px;
        color: #000;
        font-weight: bold;
    }

    span.expired {
        font-weight: bold;
        color: red;
        font-size: 18px;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .non-hover {
        cursor: text !important;
    }

    .show-graph {
        display: block;
    }
</style>
