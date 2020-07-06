<template>
    <div class="row row-full-height m-3">
        <div class="col-sm-12">
            <loading :active.sync="isLoading"
                     :is-full-page="false"></loading>
            <div v-if="!isLoading">
                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <h3 :class="tableHeadClass" class="mt-5 p-3 text-center">Order Summery</h3>
                        <div class="row row-no-padding row-col-separator-xl">
                            <div class="col-md-12 col-lg-12 col-xl-4">
                                <!--begin:: Widgets/Stats2-1 -->
                                <div class="kt-widget1">
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Order ID</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">#{{order.custom_order_id}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Event ID</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">#{{order.product.event_id}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Start Date</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.product.created_at}}</span>
                                    </div>
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Expire Date</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.product.expire_date}}</span>
                                    </div>

                                </div>
                                <!--end:: Widgets/Stats2-1 -->
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-4">
                                <!--begin:: Widgets/Stats2-2 -->
                                <div class="kt-widget1">

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Product ID</h3>
                                        </div>
                                        <span class="kt-widget1__number kt-font-info">#{{order.product.id}}</span>
                                    </div>
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Product Name</h3>
                                        </div>
                                        <span class="kt-widget1__number kt-font-info">{{order.product.name}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Product Offer Price</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-info">{{order.product.offer_price}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Product Current Price</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-info">{{order.product.current_price}}</span>
                                    </div>
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Product Join Price</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-info">{{order.product.join_price}}</span>
                                    </div>
                                    <br>

                                    <div v-if="order.variations.length > 0">
                                        <h5>Variations</h5>
                                        <br>
                                        <div class="kt-widget1__item" v-for="variationOption in order.variations">
                                            <div class="kt-widget1__info">
                                                <h3 class="kt-widget1__title">
                                                    <strong>{{variationOption.variation.product_variation.name}}</strong>
                                                    - {{variationOption.variation.name}} </h3>
                                            </div>
                                            <span
                                                class="kt-widget1__number">{{variationOption.variation.price}}</span>
                                        </div>
                                    </div>

                                    <br>

                                </div>
                                <!--end:: Widgets/Stats2-2 -->            </div>
                            <div class="col-md-12 col-lg-12 col-xl-4">
                                <!--begin:: Widgets/Stats2-3 -->
                                <div class="kt-widget1">
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Customer:</h3>
                                        </div>
                                        <span class="kt-widget1__number kt-font-info">#{{order.customer.id}} - {{order.customer.name}}</span>
                                    </div>
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Order Quantity:</h3>
                                        </div>
                                        <span class="kt-widget1__number kt-font-info">{{order.quantity}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Order Date</h3>
                                        </div>
                                        <span class="kt-widget1__number kt-font-info">{{order.created_at}}</span>
                                    </div>
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">1st Payment</h3>
                                        </div>
                                        <span v-if="order.is_join_price_paid"
                                              class="kt-widget1__number kt-font-success">Paid</span>

                                        <span v-else
                                              class="kt-widget1__number kt-font-danger">Not Paid</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">2nd Payment</h3>
                                        </div>
                                        <span v-if="order.is_full_price_paid"
                                              class="kt-widget1__number kt-font-success">Paid</span>

                                        <span v-else
                                              class="kt-widget1__number kt-font-danger">Not Paid</span>
                                    </div>

                                </div>
                                <!--end:: Widgets/Stats2-3 -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">

                        <div class="row row-no-padding row-col-separator-xl">
                            <div class="col-md-12 col-lg-12 col-xl-4">
                                <!--begin:: Widgets/Stats2-1 -->
                                <h3 class="mt-5 p-3">Customer Details</h3>
                                <div class="kt-widget1">
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Customer Name:</h3>
                                        </div>
                                        <span class="kt-widget1__number kt-font-success">#{{order.customer.name}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Customer Email</h3>
                                        </div>
                                        <span class="kt-widget1__number kt-font-success">{{order.customer.email}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Customer Phone</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.customer.info.phone}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">City</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.customer.info.city}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Zip Code</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.customer.info.zip_code}}</span>
                                    </div>


                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Company Name</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.customer.info.company_name}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">CVR Number</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.customer.info.cvr_number}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">EAN Number</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.customer.info.ean_number}}</span>
                                    </div>


                                </div>
                                <!--end:: Widgets/Stats2-1 -->
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-4">
                                <!--begin:: Widgets/Stats2-1 -->
                                <h3 class="mt-5 p-3">Shipping Details</h3>
                                <div class="kt-widget1">
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Name:</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">#{{order.shipping_info.name}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Email</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.shipping_info.email}}</span>
                                    </div>
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Address</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.shipping_info.address}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Phone</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.shipping_info.phone}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">City</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.shipping_info.city}}</span>
                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">Zip Code</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.shipping_info.zip_code}}</span>
                                    </div>

                                    <div class="shipping_method" v-if="order.shipping_info.shipping_method_details">
                                        <h3 class="mt-4 mb-3">Shipping Method</h3>
                                        <div class="kt-widget1__item">
                                            <div class="kt-widget1__info">
                                                <h3 class="kt-widget1__title">Company Name</h3>
                                            </div>
                                            <span
                                                class="kt-widget1__number kt-font-success">{{order.shipping_info.shipping_method_details.CompanyName}}</span>
                                        </div>

                                        <div class="kt-widget1__item">
                                            <div class="kt-widget1__info">
                                                <h3 class="kt-widget1__title">Company Number</h3>
                                            </div>
                                            <span
                                                class="kt-widget1__number kt-font-success">{{order.shipping_info.shipping_method_details.Number}}</span>
                                        </div>
                                        <div class="kt-widget1__item">
                                            <div class="kt-widget1__info">
                                                <h3 class="kt-widget1__title">City Name</h3>
                                            </div>
                                            <span
                                                class="kt-widget1__number kt-font-success">{{order.shipping_info.shipping_method_details.CityName}}</span>
                                        </div>
                                        <div class="kt-widget1__item">
                                            <div class="kt-widget1__info">
                                                <h3 class="kt-widget1__title">Streetname</h3>
                                            </div>
                                            <span
                                                class="kt-widget1__number kt-font-success">{{order.shipping_info.shipping_method_details.Streetname}}</span>
                                        </div>

                                        <div class="kt-widget1__item">
                                            <div class="kt-widget1__info">
                                                <h3 class="kt-widget1__title">Streetname2</h3>
                                            </div>
                                            <span
                                                class="kt-widget1__number kt-font-success">{{order.shipping_info.shipping_method_details.Streetname2}}</span>
                                        </div>

                                        <div class="kt-widget1__item">
                                            <div class="kt-widget1__info">
                                                <h3 class="kt-widget1__title">ZipCode</h3>
                                            </div>
                                            <span
                                                class="kt-widget1__number kt-font-success">{{order.shipping_info.shipping_method_details.ZipCode}}</span>
                                        </div>

                                    </div>


                                </div>
                                <!--end:: Widgets/Stats2-1 -->
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-4">
                                <!--begin:: Widgets/Stats2-1 -->
                                <h3 class="mt-5 p-3">Payment Details</h3>
                                <div class="kt-widget1">
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">1st Payment Status</h3>
                                        </div>
                                        <span v-if="order.is_join_price_paid"
                                              class="kt-widget1__number kt-font-success">Paid</span>

                                        <span v-else
                                              class="kt-widget1__number kt-font-danger">Not Paid</span>
                                    </div>
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">1st Payment Paid Amount</h3>
                                        </div>
                                        <span v-if="order.is_join_price_paid"
                                              class="kt-widget1__number kt-font-success">{{order.first_payment.amount}} ({{order.quantity}}x * {{order.product.join_price}})</span>

                                    </div>

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">1st Payment Date</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.first_payment.created_at}}</span>
                                    </div>

                                    <!--for second payment -->
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">2nd Payment Status</h3>
                                        </div>
                                        <span v-if="order.is_full_price_paid"
                                              class="kt-widget1__number kt-font-success">Paid</span>

                                        <span v-else
                                              class="kt-widget1__number kt-font-danger">Not Paid</span>
                                    </div>

                                    <span v-if="order.is_full_price_paid">

                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">2nd Payment Paid Amount</h3>
                                        </div>
                                        <span v-if="order.is_join_price_paid"
                                              class="kt-widget1__number kt-font-success">{{order.second_payment.amount}} ({{order.quantity}}x * {{order.product.current_price}})</span>
                                    </div>
                                    <div class="kt-widget1__item">
                                        <div class="kt-widget1__info">
                                            <h3 class="kt-widget1__title">2nd Payment Date</h3>
                                        </div>
                                        <span
                                            class="kt-widget1__number kt-font-success">{{order.second_payment.created_at}}</span>
                                    </div>
                                    </span>

                                </div>
                                <!--end:: Widgets/Stats2-1 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OrderDetails",
        data() {
            return {
                isLoading: false,
                orderId: null,
                order: [],
            }
        },
        methods: {
            getPaymentDetails() {
                axios.get(`${APP_URL}/api/order/${this.orderId}/details`)
                    .then(res => {
                        this.isLoading = false;
                        this.order = res.data.order;
                    }).catch(error => {
                    console.error(error)
                })
            },
        },
        created() {
            this.isLoading = true;
            this.orderId = this.$route.params.order;
            this.getPaymentDetails();
        },
        computed: {
            tableHeadClass() {
                if (this.order.is_canceled === 1) {
                    return 'order-status-canceled';
                }
                if (this.order.order_status === 1) {
                    return 'order-status-completed';
                }
                if (this.order.order_status === 0) {
                    return 'order-status-running';
                }
                return 'order-status-canceled';
            }
        }
    }
</script>

<style scoped>
    .order-status-completed {
        background: #59bb87;
        color: #fff;
        font-weight: bold;
        margin: 0;
        margin-top: 0px !important;
    }

    .order-status-running {
        background: #5578eb;
        color: #fff;
        font-weight: bold;
        margin: 0;
        margin-top: 0px !important;
    }

    .order-status-running {
        background: #fd397a;
        color: #fff;
        font-weight: bold;
        margin: 0;
        margin-top: 0px !important;
    }

</style>
