<template>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <AppTopSubHeader :header="headerTitle"></AppTopSubHeader>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row" id="dash">
                <!--total offers-->
                <div class="col-sm-12 col-md-4 col-lg-4 h-270">
                    <loading :active.sync="isLoading"
                             :is-full-page="false"></loading>
                    <router-link to="/admin/products">
                        <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-brand">
                            <div class="kt-portlet__body kt-portlet__body--fluid  h-270">
                                <div class="kt-widget26">
                                    <div class="kt-widget26__content">
                                        <span class="kt-widget26__number">{{dashboardData.totalProducts}}</span>
                                        <span class="kt-widget26__desc">Total Offers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
                <!--total offers end-->

                <!--total offers-->
                <div class="col-sm-12 col-md-4 col-lg-4 h-270">
                    <loading :active.sync="isLoading"
                             :is-full-page="false"></loading>
                    <router-link to="/admin/products">
                        <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-success">
                            <div class="kt-portlet__body kt-portlet__body--fluid  h-270">
                                <div class="kt-widget26">
                                    <div class="kt-widget26__content">
                                        <span class="kt-widget26__number">{{dashboardData.activeProducts}}</span>
                                        <span class="kt-widget26__desc">Active Offers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
                <!--total offers end-->

                <!--total offers-->
                <div class="col-sm-12 col-md-4 col-lg-4 h-270">
                    <loading :active.sync="isLoading"
                             :is-full-page="false"></loading>
                    <router-link to="/admin/products">
                        <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-danger">
                            <div class="kt-portlet__body kt-portlet__body--fluid  h-270">
                                <div class="kt-widget26">
                                    <div class="kt-widget26__content">
                                        <span class="kt-widget26__number">{{dashboardData.expiredProducts}}</span>
                                        <span class="kt-widget26__desc">Expired Offers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
                <!--total offers end-->

                <!--total orders-->
                <div class="col-sm-12 col-md-4 col-lg-4 h-270">
                    <loading :active.sync="isLoading"
                             :is-full-page="false"></loading>
                    <router-link to="/admin/orders?status=all">
                        <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-brand">
                            <div class="kt-portlet__body kt-portlet__body--fluid  h-270">
                                <div class="kt-widget26">
                                    <div class="kt-widget26__content">
                                        <span class="kt-widget26__number">{{dashboardData.totalOrders}}</span>
                                        <span class="kt-widget26__desc">Total Orders</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
                <!--total orders?status=all end-->

                <!--total active orders-->
                <div class="col-sm-12 col-md-4 col-lg-4 h-270">
                    <loading :active.sync="isLoading"
                             :is-full-page="false"></loading>
                    <router-link to="/admin/orders?status=running">
                        <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-success">
                            <div class="kt-portlet__body kt-portlet__body--fluid  h-270">
                                <div class="kt-widget26">
                                    <div class="kt-widget26__content">
                                        <span class="kt-widget26__number">{{dashboardData.activeOrders}}</span>
                                        <span class="kt-widget26__desc">Active Orders</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
                <!--total orders end-->

                <!--total completed orders-->
                <div class="col-sm-12 col-md-4 col-lg-4 h-270">
                    <loading :active.sync="isLoading"
                             :is-full-page="false"></loading>
                    <router-link to="/admin/orders?status=completed">
                        <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-danger">
                            <div class="kt-portlet__body kt-portlet__body--fluid  h-270">
                                <div class="kt-widget26">
                                    <div class="kt-widget26__content">
                                        <span class="kt-widget26__number">{{dashboardData.completedOrders}}</span>
                                        <span class="kt-widget26__desc">Completed Orders</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
                <!--total orders end-->
                <!--total completed orders-->
                <div class="col-sm-12 col-md-4 col-lg-4 h-270">
                    <loading :active.sync="isLoading"
                             :is-full-page="false"></loading>
                    <router-link to="/admin/customers">
                        <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-danger">
                            <div class="kt-portlet__body kt-portlet__body--fluid  h-270">
                                <div class="kt-widget26">
                                    <div class="kt-widget26__content">
                                        <span class="kt-widget26__number">{{dashboardData.totalCustomers}}</span>
                                        <span class="kt-widget26__desc">Total Customers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
                <!--total orders end-->
            </div>
            <!-- body contents ends here -->
        </div>
    </div>
</template>

<script>

    import AppTopSubHeader from "../Header/AppTopSubHeader";

    export default {
        name: "AppBody",
        components: {
            AppTopSubHeader
        },
        data() {
            return {
                isLoading: false,
                headerTitle: 'Dashboard',
                dashboardData: {
                    totalProducts: 0,
                    activeProducts: 0,
                    expiredProducts: 0,
                    totalOrders: 0,
                    activeOrders: 0,
                    completedOrders: 0,
                    totalCustomers: 0,
                }
            }
        },
        methods: {
            getAdminDashboardData() {
                axios.get(`/api/admin/dashboard/data`)
                    .then(res => {
                        if (res.data.status === 200) {
                            this.dashboardData = res.data.data;
                            this.isLoading = false;
                        }
                    }).catch(err => console.log(err));
            }
        },
        created() {
            this.isLoading = true;
            this.getAdminDashboardData();
        }
    }
</script>

<style>
    .kt-header--fixed.kt-subheader--fixed.kt-subheader--enabled .kt-wrapper {
        padding-top: 60px;
    }

    .h-270, .kt-portlet.kt-portlet--height-fluid-half {
        height: 120px !important;
        margin-bottom: 10px;
    }

</style>
