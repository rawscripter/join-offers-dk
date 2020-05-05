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
                paymentId: '',
                orderData: [],
                paymentData: [],

            }
        },
        methods: {
            getPaymentDetails() {
                axios.get(`${APP_URL}/api/order/payment/${this.paymentId}/status`)
                    .then(res => {
                        this.isLoading = false;
                        this.isPaymentSuccessful = res.data.payment.isPaid;
                        if (this.isPaymentSuccessful) {
                            this.orderData = res.data.order;
                            this.paymentData = res.data.orderPayment;
                        }
                    }).catch(error => {
                    console.error(error)
                })
            },
        },
        created() {
            this.isLoading = true;
            this.paymentId = this.$route.query.paymentId;
            this.getPaymentDetails();
        },
    }
</script>

