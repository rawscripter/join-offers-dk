<template>
    <div class="row mt-5 pl-2 pr-2 m-0 no-margin">
        <div class="col-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg" :class="tableHeadClass">
                    <div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
                        <h3 class="kt-portlet__head-title">
                            {{orderStatus.toUpperCase()}} ORDERS
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <div class="table-responsivess">
                        <v-server-table :url="serverRequestUrl" ref="myTable"
                                        :columns="columns"
                                        :options="options">
                                                 <span slot="is_join_price_paid"
                                                       slot-scope="{row}">
                                                    <span v-if="row.is_join_price_paid"
                                                          class="kt-badge kt-badge--inline kt-badge--success">Paid</span>
                                                     <span v-else class="kt-badge kt-badge--inline kt-badge--warning">Not Paid</span>
                                                 </span>
                            <span slot="is_full_price_paid"
                                  slot-scope="{row}">
                                <span v-if="row.is_full_price_paid" class="kt-badge kt-badge--inline kt-badge--success">Paid</span>
                                <span v-else class="kt-badge kt-badge--inline kt-badge--warning">Not Paid</span>
                            </span>
                            <span slot="order_status" slot-scope="{row}">
                                                            <div v-if="!row.is_canceled">
                                                                  <span v-if="row.order_status"
                                                                        class="kt-badge kt-badge--inline kt-badge--success">Compete</span>
                                                     <span v-else class="kt-badge kt-badge--inline kt-badge--info">Running</span>
                                                            </div>
<div v-else>
     <span class="kt-badge kt-badge--inline kt-badge--danger">Canceled</span>
</div>
                                                        </span>
                            <span slot="actions" slot-scope="{row}">

                                <router-link :to="{name:'admin-order-details',params:{order:row.custom_order_id}}"
                                             class="btn btn-sm btn-primary">
                                            Order Details
                                </router-link>


                            </span>
                        </v-server-table>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "ProductIndex",
        data() {
            return {
                orderStatus: 'all',
                product: null,
                columns: ['id',
                    'custom_order_id',
                    'product.name',
                    'product.expire_date',
                    // 'product.market_price',
                    // 'product.offer_price',
                    // 'product.current_price',
                    'join_price',
                    'quantity',
                    'total_price',
                    'is_join_price_paid',
                    'is_full_price_paid',
                    'order_status',
                    'created_at',
                    'actions'
                ],
                options: {
                    headings: {
                        id: 'ID',
                        custom_order_id: 'Order ID',
                        'product.name': 'Product Name',
                        // 'product.current_price': 'Current Price',
                        // 'product.market_price': 'Market Price',
                        // 'product.offer_price': 'Start Price',
                        'product.expire_date': 'End Date',
                        join_price: 'Join price',
                        total_price: 'Paid Join Price',
                        quantity: 'Order Quantity',
                        created_at: 'Order At',
                        order_status: 'Order Status',
                        is_join_price_paid: '1st Payment ',
                        is_full_price_paid: '2nd Payment ',
                        actions: 'Actions'
                    },
                    perPage: 10,
                    perPageValues: [10, 20, 25, 50, 100],
                    sortable: ['name', 'custom_order_id', 'created_at', 'order_status', 'is_join_price_paid', 'is_full_price_paid', 'quantity'],
                    filterable: ['name'],
                    responseAdapter: function (resp) {
                        return {
                            data: resp.data.orders,
                            count: resp.data.total,
                        }
                    }
                },
            }
        },
        methods: {
            orderDetails(categoryID) {
            },
        },
        computed: {
            serverRequestUrl() {
                if (this.product != null) {
                    return `${APP_URL}/api/admin/orders?status=${this.orderStatus}&product=${this.product}`;
                } else {
                    return `${APP_URL}/api/admin/orders?status=${this.orderStatus}`;
                }
            },
            tableHeadClass() {
                if (this.orderStatus === 'all') {
                    return 'all-orders';
                }
                if (this.orderStatus === 'running') {
                    return 'running-orders';
                }
                if (this.orderStatus === 'canceled') {
                    return 'canceled-orders';
                }

                if (this.orderStatus === 'complete') {
                    return 'complete-orders';
                }
            }
        },
        watch: {
            '$route.query': {
                immediate: true,
                handler(newVal) {
                    this.orderStatus = newVal.status;
                }
            }
        },
        created() {
            if (this.$route.query.status) {
                this.orderStatus = this.$route.query.status;
                this.product = this.$route.query.product;
            }
        }

    }
</script>

<style>
    .VueTables__search-field {
        display: flex !important;
    }

    .VueTables__search-field label, .VueTables__limit-field label {
        margin-right: 10px;
    }

    .VueTables__limit-field {
        display: flex !important;
    }

    .running-orders {
        background: #5578eb;
    }

    .running-orders .kt-font-brand {
        color: #ffffff !important;
    }

    .running-orders h3 {
        color: #fff !important;
    }

    .complete-orders {
        background: #0abb87;
    }

    .complete-orders .kt-font-brand {
        color: #ffffff !important;
    }

    .complete-orders h3 {
        color: #fff !important;
    }

    .canceled-orders {
        background: #fd397a;
    }

    .canceled-orders .kt-font-brand {
        color: #ffffff !important;
    }

    .canceled-orders h3 {
        color: #fff !important;
    }

    .kt-badge.kt-badge--inline {
        font-size: 13px;
    }
</style>
