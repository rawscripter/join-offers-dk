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
                            All Customers
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <!--begin: Datatable -->

                    <div class="table-responsivess">
                        <v-server-table :url="serverRequestUrl" ref="myTable"
                                        :columns="columns"
                                        :options="options">

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
        name: "CustomerIndex",
        data() {
            return {
                columns: [
                    'id',
                    'name',
                    'email',
                    'info.phone',
                    'info.company_name',
                    'info.cvr_number',
                    'info.ean_number',
                    'info.city',
                    'info.zip_code',
                    'total_orders',
                    'created_at',
                    // 'actions'
                ],
                options: {
                    headings: {
                        id: 'ID',
                        name: 'Name',
                        email: 'Email',
                        'info.phone': 'Phone',
                        'info.company_name': 'Email',
                        'info.cvr_number': 'CVR Number',
                        'info.ean_number': 'EAN Number',
                        'info.city': 'city',
                        'info.zip_code': 'zip_code',
                        'total_orders': 'Orders',
                        'created_at': 'Join Date',
                        // actions: 'Actions'
                    },
                    perPage: 10,
                    perPageValues: [10, 20, 25, 50, 100],
                    sortable: ['name'],
                    filterable: ['name'],
                    responseAdapter: function (resp) {
                        return {
                            data: resp.data.customers,
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
                return `${APP_URL}/api/admin/customers`;
            },
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
</style>
