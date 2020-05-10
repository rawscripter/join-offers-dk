<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-2">
                    <CustomerLeftSidebar></CustomerLeftSidebar>
                </div>
                <div class="col-md-9 col-lg-10" style="background:#fff">
                    <div class="main-content">
                        <div class="row">
                            <div class="col-md-3 wow bounceIn">
                                <div class="shadow border-bottom border-theme">
                                    <div class="card-body text-center">
                                        <h2 class="text-muted"><strong>{{dashboardData.totalOrders}}</strong></h2>
                                        <h5 class="text-muted"><strong>Total Events</strong></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 wow bounceIn">
                                <div class="shadow  border-bottom border-active">
                                    <div class="card-body text-center">
                                        <h2 class="text-muted"><strong>{{dashboardData.activeOrders}}</strong></h2>
                                        <h5 class="text-muted"><strong>Active Events</strong></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 wow bounceIn">
                                <div class="shadow  border-bottom border-green">
                                    <div class="card-body text-center">
                                        <h2 class="text-muted"><strong>{{dashboardData.completedOrders}}</strong></h2>
                                        <h5 class="text-muted"><strong>Completed Events</strong></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 wow bounceIn">
                                <div class="shadow  border-bottom border-red">
                                    <div class="card-body text-center">
                                        <h2 class="text-muted"><strong>{{dashboardData.canceledOrders}}</strong></h2>
                                        <h5 class="text-muted"><strong>Canceled Events</strong></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mt-4 wow bounceIn">
                                <div class="shadow   border-bottom border-pink">
                                    <div class="card-body text-center">
                                        <h2 class="text-muted"><strong>{{dashboardData.canceledOrders}}</strong></h2>
                                        <h5 class="text-muted"><strong>Missing Event Payments</strong></h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CustomerLeftSidebar from "../../Layout/Customer/CustomerLeftSidebar";

    export default {
        name: "CustomerProfile",
        components: {
            CustomerLeftSidebar,
        },
        data() {
            return {
                isLoading: false,
                headerTitle: 'Dashboard',
                dashboardData: {
                    totalOrders: 0,
                    activeOrders: 0,
                    completedOrders: 0,
                    canceledOrders: 0,
                }
            }
        },
        methods: {
            getAdminDashboardData() {
                axios.get(`/api/customer/dashboard/data`)
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

<style scoped>
    .border-bottom:hover {
        opacity: 1;
        transition-duration: .3s;
    }

    .border-bottom {
        border-bottom: 4px solid #dee2e6 !important;
        opacity: .6;
        cursor: pointer;
    }

    .border-theme {
        border-color: #000000 !important;
    }

    .border-active {
        border-color: #ff7431 !important;
    }

    .border-red {
        border-color: red !important;
    }

    .border-pink {
        border-color: pink !important;
    }

    .border-green {
        border-color: green !important;
    }
</style>
