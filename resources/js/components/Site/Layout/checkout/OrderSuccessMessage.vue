<template>
    <div class="row">
        <div class="col-12 col-md-6 m-auto">
            <div class="shadow">
                <div class="card-body">
                    <h2 class="text-center color-green"><strong>Congratulations! Payment Successful</strong></h2>
                    <div class="order-details mt-5">
                        <h4>Ordre ID: <strong>#{{orderData.custom_order_id}}</strong></h4>
                        <h4>Produkt titel: <strong>{{orderData.product.name}}</strong></h4>
                        <h4>Antal: <strong>{{orderData.quantity}}</strong></h4>
                        <h4>Produkt pris: <strong>{{orderData.product.offer_price + orderData.variant_total}} Kr</strong></h4>
                        <h4>Betalt beløb: <strong>{{paymentData.amount}} Kr</strong></h4>
                        <h4>Betalingsstatus: <strong>{{'Paid'}}</strong></h4>
                        <h4>Betalingsdato: <strong>{{ paymentData.created_at }}</strong></h4>
                    </div>
                    <br>
                    <br>
                    <p>Besøg Dashboard for at få mere information.</p>
                    <div class="text-center m-auto">
                        <!--                        <router-link :to="{name:'customer-completed-orders',query:{type:'completed'}}"-->
                        <!--                                     class="btn btn-theme ">-->
                        <!--                            Go to Orders-->
                        <!--                        </router-link>-->
                        <router-link :to="{name:'customer-dashboard'}"
                                     class="btn btn-theme ">
                            Besøg Dashboard
                        </router-link>


                    </div>

                    <div class="mt-5 text-center">
                        <router-link to="/">
                            Fortsætte med at handle
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OrderSuccessMessage",
        props: ['orderData', 'paymentData'],
        data() {
            return {}
        }
    }
</script>

<style scoped>
    .order-details h4 {
        margin-bottom: 10px;
    }

    .color-green {
        color: green;
    }
</style>
