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
                                        :columns="columns"
                                        :options="options">
                            <span slot="actions" slot-scope="{row}">
                                <button class="btn btn-sm btn-primary" v-on:click="edit(row.id)">Edit</button>
                                <button class="btn btn-sm btn-warning"
                                        v-on:click="restoreProduct(row.id)">Restore</button>
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
        name: "ArchiveProductIndex",
        data() {
            return {
                columns: ['id', 'name',
                    'category', 'subCategory', 'market_price',
                    'offer_price', 'last_price',
                    'total_offer_spots', 'minus_price_user_price',
                    'expire_date', 'user', 'created_at',
                    'actions'],
                options: {
                    headings: {
                        id: 'ID',
                        name: 'Name',
                        category: 'Category',
                        subCategory: 'Sub Category',
                        market_price: 'Market Price',
                        offer_price: 'Offer Price',
                        last_price: 'Last Price',
                        total_offer_spots: 'Total Spots',
                        minus_price_user_price: 'Price Per User',
                        expire_date: 'Expire Date',
                        user: 'Added By',
                        created_at: 'Created At',
                        actions: 'Actions'
                    },
                    perPage: 10,
                    perPageValues: [10, 20, 25, 50, 100],
                    sortable: ['name'],
                    filterable: ['name'],
                    requestFunction: function (data) {
                        let self = this;
                        return axios.get(`${APP_URL}/api/admin/products/archive`, {params: data}).catch(function (e) {
                            self.dispatch('error', e);
                        }.bind(this));
                    },
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
            restoreProduct(productId) {
                this.$swal({
                    title: "Restore this record?",
                    text: "Are you sure?",
                    type: "warning",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Yes, Delete it!"
                }).then((result) => { // <--
                    if (result.value) { // <-- if confirmed
                        this.deleteConfirmation(productId);
                    }
                });
            },
            deleteConfirmation(id) {
                axios.post(`${APP_URL}/api/admin/product/${id}/restore`)
                    .then(res => {
                        Alert.showSuccessAlert(res.data.message);
                        this.$refs.myTable.refresh();
                    }).catch(error => {
                    console.error(error)
                })
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
