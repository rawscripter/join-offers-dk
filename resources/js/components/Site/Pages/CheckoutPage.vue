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
                                <th>Produktbillede</th>
                                <th>Begivenheds</th>
                                <th>Deltagelsespris <br>
                                    (del 1 of two betalinger)
                                </th>
                                <th>Antal</th>
                                <th>Bemærk</th>
                                <th>Alt</th>
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
                                    {{ product.join_price.toFixed(2)}} Kr<br>
                                    {{ product.join_payment_percentage }} % of
                                    {{product.offer_price}} Kr
                                </td>
                                <td>
                                    <button type="button" @click="decreaseOrderQuantity"
                                            class="btn btn-success btn-sm rounded mr-0"><i
                                        class="fas fa-minus"></i></button>
                                    <input :max="product.max_unit_per_user" type="number" id="oqty" min="1"
                                           v-model="orderDetails.quantity"
                                           style="width:60px;text-align:center">
                                    <button type="button" @click="increaseOrderQuantity" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                                <td style="width:25%">
                                    <p class="m-0 p-0" v-html="product.order_note"></p>
                                </td>
                                <td>
                                    {{orderDetails.totalPrice.toFixed(2)}} Kr<br>
                                    Heraf moms : {{ taxPrice.toFixed(2) }} Kr
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
                                        <h5 class="text-center"><strong>Order Details</strong></h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="checkout-table table table-hover" style="width:100%">

                                            <tr v-for="(variation,variationIndex) in product.product_variation">
                                                <!--                                                <td></td>-->
                                                <td class="variations" colspan="2">
                                                    <div class="text-center"><strong>{{variation.name}}</strong></div>
                                                    <div class="variation"
                                                         v-for="(option,optionIndex) in variation.options">
                                                        <input class="hidden radio-label" :id="`radio-btn-${option.id}`"
                                                               type="radio"
                                                               :value="option.id"
                                                               :name="`variationOption[${variation.id}]`"
                                                               :checked="isOptionAlreadySelected(option.id)"
                                                        />
                                                        <label
                                                            @click="changeProductPriceOnVariationChange(variation.id,option.id,option.price)"
                                                            class="button-label" :for="`radio-btn-${option.id}`">
                                                            <span> {{option.name}}  <span v-if="option.price >0">+{{option.price}}kr</span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>


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
                                                <td> {{ product.join_price.toFixed(2)}} Kr ({{
                                                    product.join_payment_percentage }} %
                                                    of
                                                    {{product.offer_price}} Kr)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Antal</strong>:</td>
                                                <td>{{orderDetails.quantity}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total</strong>:</td>
                                                <td>{{orderDetails.totalPrice.toFixed(2)}} Kr</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div>
                                                        <label class="checkbox_container">Abonner på nyhedsbrev.
                                                            <input v-model="orderDetails.newsletter" value="1"
                                                                   type="checkbox"> <span
                                                                class="checkmark"></span></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" colspan="2">
                                                    <button @click="createOrder"
                                                            class="btn btn-block mt-3 btn-success">Betal nu
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
                productSlug: null,
                isUserLoggedIn: User.loggedIn(),
                orderDetails: {
                    newsletter: 0,
                    productId: null,
                    quantity: 1,
                    totalPrice: 0,
                    unitPrice: 0,
                    variantTotal: 0
                },
                selectedVariations: []
            }
        },
        watch: {
            'orderDetails.quantity'(val) {
                this.orderDetails.totalPrice = this.orderDetails.unitPrice * val
            },
            'product.join_price'(val) {
                this.orderDetails.unitPrice = val;
            }
        },
        computed: {
            taxPrice() {
                return this.orderDetails.totalPrice * 0.2
            }
        },
        methods: {
            changeProductPriceOnVariationChange(variationID, optionID, price) {

                let selectedIndex = this.selectedVariations.findIndex(x => x.variationID === parseInt(variationID));

                // already selected
                if (selectedIndex !== -1) {
                    if (this.selectedVariations[selectedIndex].optionID === optionID) return;

                    let optionVariationOptionId = this.selectedVariations[selectedIndex].optionID;

                    let productVariations = this.product.product_variation[selectedIndex];
                    let optionVariationOptionIndex = productVariations.options.findIndex(x => x.id === parseInt(optionVariationOptionId));

                    let optionVariationOption = productVariations.options[optionVariationOptionIndex];

                    this.product.offer_price -= optionVariationOption.price;
                    let newPrice = ((this.product.join_payment_percentage / 100) * optionVariationOption.price);

                    this.product.join_price -= newPrice;
                    this.orderDetails.totalPrice -= newPrice * this.orderDetails.quantity;


                    this.orderDetails.variantTotal -= optionVariationOption.price;
                    this.selectedVariations[selectedIndex].optionID = optionID;


                } else {
                    let newObject = {
                        variationID: variationID,
                        optionID: optionID
                    }
                    this.selectedVariations.push(newObject)
                }

                let newPrice = ((this.product.join_payment_percentage / 100) * price);

                this.orderDetails.variantTotal += price;
                this.product.offer_price += price;

                this.product.join_price += newPrice;
                this.orderDetails.totalPrice += newPrice * this.orderDetails.quantity;
            },

            isOptionAlreadySelected(optionID) {

                return this.selectedVariations.find(x => x.optionID === optionID);

                // return selectedIndex !== -1;

            },

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

                        let seletedVariationCokkieObject = this.$cookies.get(`product-variation-${this.product.id}`);
                        if (seletedVariationCokkieObject) {
                            this.selectedVariations = JSON.parse(seletedVariationCokkieObject);
                            let vm = this;
                            this.selectedVariations.forEach(function (variation) {
                                let selectedVariationIndex = vm.product.product_variation.findIndex(x => x.id === variation.variationID);
                                let variationOptions = vm.product.product_variation[selectedVariationIndex].options;
                                let selectedVariationOptionIndex = variationOptions.findIndex(x => x.id === variation.optionID);
                                let needToAddPrice = variationOptions[selectedVariationOptionIndex].price;
                                vm.product.offer_price += needToAddPrice;
                                vm.product.join_price += ((vm.product.join_payment_percentage / 100) * needToAddPrice);
                                vm.orderDetails.totalPrice += ((vm.product.join_payment_percentage / 100) * needToAddPrice);
                                vm.orderDetails.variantTotal += needToAddPrice;
                            })
                        }

                    }).catch(error => {
                    console.error(error)
                })
            },

            createOrder() {

                // check if product has variation and user selected the variation

                let totalVariationsOfProduct = this.product.product_variation.length;
                if (totalVariationsOfProduct > 0) {
                    if (totalVariationsOfProduct !== this.selectedVariations.length) {
                        Alert.showErrorAlert('Please select product variations.');
                        return;
                    }
                }


                this.isPaymentLoading = true;
                axios.post(`${APP_URL}/api/order/create`, {
                    orderDetails: this.orderDetails,
                    variations: this.selectedVariations
                })
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
            this.productSlug = this.$route.params.slug;
            this.getProduct(this.productSlug);

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

    .variation_btn {
        cursor: pointer;
    }


    .button-wrap {
        position: relative;
        text-align: center;
        top: 50%;
        margin-top: -2.5em;
    }

    @media (max-width: 40em) {
        .button-wrap {
            margin-top: -1.5em;
        }
    }

    .variation {
        float: left;
    }

    .button-label {
        display: inline-block;
        padding: 5px 15px;
        margin-right: 0.5em;
        margin-top: 0.5em;
        cursor: pointer;
        color: #292929;
        border-radius: 0.25em;
        background: #ffffff;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2), inset 0 -3px 0 rgba(0, 0, 0, 0.22);
        transition: 0.3s;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-size: 15px;
    }

    .button-label h1 {
        font-size: 1em;
        font-family: "Lato", sans-serif;
    }

    .button-label:hover {
        background: #d6d6d6;
        color: #101010;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2), inset 0 -3px 0 rgba(0, 0, 0, 0.32);
    }

    .button-label:active {
        -webkit-transform: translateY(2px);
        transform: translateY(2px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2), inset 0px -1px 0 rgba(0, 0, 0, 0.22);
    }

    @media (max-width: 40em) {
        .button-label {
            padding: 0em 1em 3px;
            margin: 0.25em;
        }
    }

    .radio-label:checked + .button-label {
        background: #ff844e;
        color: #efefef;
    }

    .hidden {
        display: none;
    }

</style>
