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
                                <div class="text-center mb-2"><strong>Ordrer #{{order.custom_order_id}}</strong></div>
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
                                            Produkt titel:
                                            <router-link
                                                    :to="{name: 'product-details', params:{slug:order.product.slug}}">
                                                <strong>{{order.product.name}}</strong>
                                            </router-link>
                                        </td>
                                        <td style="width:15%">Gennemsnitlig pris:
                                            <strong>{{order.product.market_price}} Kr</strong></td>
                                        <td style="width:15%">
                                            Antal: <strong>{{order.quantity}}</strong>
                                        </td>
                                        <td style="width:15%" rowspan="2" v-if="!order.is_canceled">
                                            <div class="text-center mb-2"><strong>Første betaling
                                                ({{order.first_payment.amount}} Kr)</strong></div>
                                            <button style="width: 120px" class="btn non-hover btn-info btn-sm">Betalt
                                            </button>
                                        </td>
                                        <td style="width:15%" rowspan="4" v-else>
                                            <button style="width: 120px" class="btn btn-danger btn-sm">Annulleret
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Begivenheds ID: <strong>
                                            #{{order.product.event_id}}</strong>
                                        </td>
                                        <td style="width:15%">
                                            Start pris:
                                            <strong>{{order.product.offer_price}} Kr</strong>
                                        </td>
                                        <td style="width:15%">Deltagere:
                                            <strong>{{order.product.totalOrders}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">
                                            Startdato: <strong> {{order.product.created_at}}</strong>
                                        </td>
                                        <td style="width:15%">
                                            Nuværende pris:
                                            <strong>{{order.product.current_price}} Kr</strong>
                                        </td>
                                        <td style="width:15%;" rowspan="2">
                                            <router-link
                                                    :to="{name:'product.graph',params:{product:order.product.event_id}}">
                                                <img src="/images/icons/price-fall.gif" width="150px" alt="">
                                                <span class="d-block btn btn-default btn-sm">Graf</span>
                                            </router-link>
                                        </td>
                                        <td style="width:15%" rowspan="2" v-if="!order.is_canceled">
                                            <div class="text-center mb-2"><strong>Anden betaling
                                                ({{((order.second_payment_amount)) }} Kr)

                                            </strong></div>
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
                                                        <div v-if="!order.is_full_price_paid"
                                                             style="width: 120px;margin: 0 auto;">
                                                            <router-link
                                                                    :to="{name:'final-checkout',params:{order:order.custom_order_id}}"
                                                                    class="btn btn-block btn-success btn-sm">
                                                                Betal nu
                                                            </router-link>
                                                        </div>
                                            <button v-else style="width: 120px" class="btn  non-hover btn-info btn-sm">Betalt
                                            </button>
                                                    </span>
                                                </vac>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">
                                            Slutdato: <strong>{{order.product.expire_date}}</strong>
                                        </td>
                                        <td style="width:15%">Besparelse i procent:
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
