<template>
    <div class="row mt-5 pl-2 pr-2 m-0 no-margin">
        <div class="col-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
                        <h3 class="kt-portlet__head-title">
                            All Products
                        </h3>
                    </div>

                </div>

                <div class="kt-portlet__body">
                    <!--begin: Datatable -->

                    <div class="table-responsivess">
                        <v-server-table ref="myTable"
                                        :url="serverRequestUrl"
                                        :columns="columns"
                                        :options="options">


                             <span slot="totalOrders" slot-scope="{row}">

                                 <router-link class="btn btn-sm btn-primary"
                                              :to="{name:'orders',query:{product:row.id,status:'all'}}">
                                     {{row.totalOrders}}
                                 </router-link>
                            </span>


                            <span slot="actions" slot-scope="{row}">
                                <button class="btn btn-sm btn-primary" v-on:click="edit(row.id)">Edit</button>
                                <button class="btn btn-sm btn-danger"
                                        v-on:click="deleteCategory(row.id)">Archive</button>
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
                productStatus: null,
                columns: ['id',
                    'name',
                    'event_id',
                    'category',
                    'subCategory',
                    'market_price',
                    'offer_price',
                    'last_price',
                    'total_offer_spots',
                    'minus_price_user_price',
                    'totalOrders',
                    'expire_date',
                    'user',
                    'created_at',
                    'actions'],
                options: {
                    headings: {
                        id: 'ID',
                        name: 'Name',
                        event_id: 'Event ID',
                        category: 'Category',
                        subCategory: 'Sub Category',
                        market_price: 'Market Price',
                        offer_price: 'Offer Price',
                        last_price: 'Last Price',
                        total_offer_spots: 'Total Spots',
                        minus_price_user_price: 'Price Per User',
                        totalOrders: 'Total Orders',
                        expire_date: 'Expire Date',
                        user: 'Added By',
                        created_at: 'Created At',
                        actions: 'Actions'
                    },
                    perPage: 10,
                    perPageValues: [10, 20, 25, 50, 100],
                    sortable: ['name', 'event_id', 'expire_date', 'current_price', 'id'],
                    filterable: ['name', 'event_id', 'expire_date', 'current_price', 'id'],
                    responseAdapter: function (resp) {
                        return {
                            data: resp.data.products,
                            count: resp.data.total,
                        }
                    }
                },
            }
        },
        methods: {
            edit(categoryID) {
                // this.resetFormAction();
                this.$router.push({name: 'product.edit', params: {product: categoryID}})
            },
            // to delete a category
            deleteCategory(categoryID) {
                this.$swal({
                    title: "Delete this record?",
                    text: "Are you sure? You won't be able to revert this!",
                    type: "warning",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Yes, Delete it!"
                }).then((result) => { // <--
                    if (result.value) { // <-- if confirmed
                        this.deleteConfirmation(categoryID);
                    }
                });
            },
            deleteConfirmation(categoryID) {
                axios.delete(`${APP_URL}/api/admin/product/${categoryID}`)
                    .then(res => {
                        Alert.showSuccessAlert(res.data.message);
                        this.$refs.myTable.refresh();
                    }).catch(error => {
                    console.error(error)
                })
            }
        },
        computed: {
            serverRequestUrl() {
                if (this.productStatus != null) {
                    return `${APP_URL}/api/admin/product?status=${this.productStatus}`;
                }else{
                    return `${APP_URL}/api/admin/product`;
                }
            },
        },
        watch: {
            '$route.query': {
                immediate: true,
                handler(newVal) {
                    this.productStatus = newVal.status;
                }
            }
        },
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


</style>
