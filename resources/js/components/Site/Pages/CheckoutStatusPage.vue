<template>
    <div class="page-wrapper">
        <div class="container">
            <loading :active.sync="isLoading"
                     :is-full-page="true"></loading>
            <!-- start checkout product info area  -->
            <div v-if="!isLoading">
                <PaymentFailed v-if="!isPaymentSuccessful"></PaymentFailed>
                <OrderSuccessMessage v-else :order-data="orderData" :paymentData="paymentData"></OrderSuccessMessage>
            </div>
        </div>
    </div>
</template>

<script>
    import PaymentFailed from "../Layout/checkout/PaymentFailed";
    import OrderSuccessMessage from "../Layout/checkout/OrderSuccessMessage";

    export default {
        components: {
            PaymentFailed,
            OrderSuccessMessage
        },
        name: "OrderCheckoutPage",
        data() {
            return {
                isLoading: false,
                isPaymentSuccessful: false,
                orderId: '',
                orderData: [],
                paymentData: [],
                paymentType: 1,
            }
        },
        methods: {
            getPaymentDetails() {
                axios.get(`${APP_URL}/api/order/${this.orderId}/details`)
                    .then(res => {
                        this.isLoading = false;
                        this.isPaymentSuccessful = res.data.payment.isPaid;
                        if (this.isPaymentSuccessful) {
                            this.orderData = res.data.order;
                            if (this.paymentType == 2) {
                                this.paymentData = res.data.order.second_payment;
                            } else {
                                this.paymentData = res.data.order.first_payment;
                            }
                        }
                    }).catch(error => {
                    console.error(error)
                })
            },
        },
        created() {
            this.isLoading = true;
            this.orderId = this.$route.query.order;
            this.isPaymentSuccessful = this.$route.query.status === 'success';
            this.paymentType = this.$route.query.type;
            this.getPaymentDetails();
        },
    }
</script>

