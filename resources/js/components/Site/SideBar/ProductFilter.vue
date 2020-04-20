<template>
    <div class="main-sidebar shadow" id="main_sidebar">
        <div class="filter-title text-center">
            <h5><strong>Filter</strong></h5>
        </div>
        <div class="sidebar-header d-flex justify-content-between">
            <i class="fas fa-times mt-2" id="closeMobileSidebar"></i>
        </div>
        <div class="till_filter">
            <h5><b>Till :</b></h5>
            <form action="#" id="tillFilter">
                <!-- checkbox single  -->
                <label class="checkbox_container">alle
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
                <!-- checkbox single  -->
                <label class="checkbox_container">Maend
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
                <!-- checkbox single  -->
                <label class="checkbox_container">Kvinder
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
                <!-- checkbox single  -->
                <label class="checkbox_container">Born
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
            </form>
        </div>
        <div class="shoter_filter mt-3">
            <h5><b>Shorter efter</b></h5>
            <form action="#" id="shorterFilter">
                <!-- checkbox single  -->
                <label class="checkbox_container">Popular
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
                <!-- checkbox single  -->
                <label class="checkbox_container">Ny
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
                <!-- checkbox single  -->
                <label class="checkbox_container">sidste chance
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
                <!-- checkbox single  -->
                <label class="checkbox_container">Kommer snart
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
            </form>
        </div>
        <div class="price_filter">
            <!-- <label for="amount">Price range:</label> -->
            <form action="#">
                <div id="slider-range"></div>
                <p style="margin-top:10px;">
                    <input type="text" id="amount" readonly
                           style="border:0; color:#f6931f; font-weight:bold;width:55%;">
                </p>
                <p style="margin-top:10px;">
                    <button class="btn btn-block btn-success btn-sm rounded-0">Filter</button>
                </p>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductFilter"
    }
</script>

<style scoped>

</style>
