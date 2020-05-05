<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-2">
                    <CustomerLeftSidebar></CustomerLeftSidebar>
                </div>
                <div class="col-md-9 col-lg-10" style="background:#fff">
                    <div class="main-content">
                        <loading :active.sync="isLoading"
                                 :is-full-page="false"></loading>
                        <div v-if="!isLoading" class="user-profile-all-order p-3">
                            <h5 class="text-center">My Joinoffers</h5>
                            <hr>
                            <div v-for="order in orders" class="table-responsive shadow">
                                <table class="table table-bordered text-center">
                                    <tr>
                                        <td rowspan="4" style="width:20%">
                                            <img :src="order.product.featureImage" alt="Product image"
                                                 style="width:100%;">
                                        </td>
                                        <td style="width:35%">
                                            Product Name: <strong>{{order.product.name}}</strong>
                                        </td>
                                        <td style="width:15%">10</td>
                                        <td style="width:15%">
                                            <div class="timer text-center mt-2 mb-2">
                                                <vac :end-time="new Date(order.product.expire_date)">
                                                    <p><strong>Expire in</strong></p>
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

                                                    <span slot="finish" class="expired">Offer Expired!</span>
                                                </vac>
                                            </div>


                                        </td>
                                        <td style="width:15%" rowspan="2">
                                            <button style="width: 120px" class="btn btn-info btn-sm">Paid</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Order ID: <strong> #{{order.custom_order_id}}</strong>
                                        </td>
                                        <td style="width:15%"></td>
                                        <td style="width:15%">Current Price:
                                            <strong>{{order.product.current_price}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">
                                            Offer Start Date: <strong> {{order.product.created_at}}</strong>
                                        </td>
                                        <td style="width:15%">10</td>
                                        <td style="width:15%;" rowspan="2">graph</td>
                                        <td style="width:15%" rowspan="2">
                                            <button style="width: 120px" class="btn btn-success btn-sm">Pay now
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">
                                            Offer End Date: <strong>{{order.product.expire_date}}</strong>
                                        </td>
                                        <td style="width:15%">10%</td>
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
            CustomerLeftSidebar
        },
        data() {
            return {
                orders: [],
                isLoading: false,
            }
        },
        methods: {
            getCustomerOrders() {
                axios.get(`${APP_URL}/api/customer/orders`)
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
</style>
