<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-2">
                    <CustomerLeftSidebar></CustomerLeftSidebar>
                </div>
                <div class="col-md-9 col-lg-10" style="background:#fff">
                    <div class="main-content">
                        <div class="user-profile-update-form ">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 ml-auto wow bounceInUp">
                                    <CustomerProfileInfo></CustomerProfileInfo>
                                </div>
                                <div class="col-md-6 col-lg-6 mr-auto  wow bounceInUp">
                                    <UpdateUserPassword></UpdateUserPassword>
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
    import UpdateUserPassword from "../../Layout/Customer/UpdateUserPassword";
    import CustomerProfileInfo from "../../Layout/Customer/CustomerProfileInfo";

    export default {
        name: "CustomerProfile",
        components: {
            CustomerLeftSidebar,
            UpdateUserPassword,
            CustomerProfileInfo
        }
    }
</script>

<style scoped>
    input.form-control {
        margin-bottom: 8px;
        height: 40px;
        border-radius: 5px !important;
        border-color: #e8e8e8;
    }
</style>
