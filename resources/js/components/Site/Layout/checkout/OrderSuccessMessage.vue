<template>
    <div class="row">
        <div class="col-12 col-md-6 m-auto">
            <div class="shadow">
                <div class="card-body">
                    <h2 class="text-center color-green"><strong>Congratulations! Payment Successful</strong></h2>
                    <div class="order-details mt-5">
                        <h4>Order ID: <strong>#{{orderData.custom_order_id}}</strong></h4>
                        <h4>Product Name: <strong>{{orderData.product.name}}</strong></h4>
                        <h4>Quantity: <strong>{{orderData.quantity}}</strong></h4>
                        <h4>Product Price: <strong>{{orderData.product.offer_price}}</strong></h4>
                        <h4>Paid Amount: <strong>{{paymentData.amount}}</strong></h4>
                        <h4>Payment Status: <strong>{{'Paid'}}</strong></h4>
                        <h4>Payment Date: <strong>{{ paymentData.created_at }}</strong></h4>
                    </div>
                    <br>
                    <br>
                    <p>Visit Dashboard to get more information.</p>
                    <div class="text-center m-auto">
                        <router-link :to="{name:'customer-orders'}" class="btn btn-theme ">
                            Order Details
                        </router-link>
                    </div>

                    <div class="mt-5 text-center">
                        <router-link to="/">
                            Continue Shopping
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
