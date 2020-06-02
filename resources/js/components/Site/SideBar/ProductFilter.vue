<template>
    <div :class="showFilterMenuOnMobile ? 'show-filter-on-mobile' : '' " class="main-sidebar shadow" id="main_sidebar">
        <div class="filter-title text-center">
            <h5><strong>Filter</strong></h5>
        </div>
        <div  @click="showFilterMenuOnMobile = !showFilterMenuOnMobile" class="sidebar-header hide-desktop d-flex justify-content-between">
            <i class="fas fa-times mt-2" id="closeMobileSidebar"></i>
        </div>
        <form>
            <div class="till_filter">
                <h5><b>Till :</b></h5>
                <!-- checkbox single  -->
                <label class="checkbox_container">alle
                    <input v-model="filter.gender" value="All" type="radio">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
                <!-- checkbox single  -->
                <label class="checkbox_container">Maend
                    <input v-model="filter.gender" value="Men" type="radio">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
                <!-- checkbox single  -->
                <label class="checkbox_container">Kvinder
                    <input v-model="filter.gender" value="Women" type="radio">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
                <!-- checkbox single  -->
                <label class="checkbox_container">Born
                    <input v-model="filter.gender" value="kids" type="radio">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->

            </div>
            <div class="shoter_filter mt-3">
                <h5><b>Shorter efter</b></h5>
                <label class="checkbox_container">Ny
                    <input v-model="filter.short" value="new" type="radio">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
                <!-- checkbox single  -->
                <label class="checkbox_container">Popular
                    <input v-model="filter.short" value="popular" type="radio">
                    <span class="checkmark"></span>
                </label>
                <!-- end of checkbox single  -->
                <!-- checkbox single  -->
                <!-- checkbox single  -->
                <label class="checkbox_container">sidste chance
                    <input v-model="filter.short" value="old" type="radio">
                    <span class="checkmark"></span>
                </label>

                <label class="checkbox_container">Coming Soon
                    <input v-model="filter.short" value="coming_soon" type="radio">
                    <span class="checkmark"></span>
                </label>

                <!-- end of checkbox single  -->
            </div>
            <div class="price_filter">
                <br>
                <!-- <label for="amount">Price range:</label> -->
                <!--                <vue-range-slider @change="signalChange" :min="10" :max="10000"-->
                <!--                                  v-model="range"></vue-range-slider>-->

                <vue-slider :max="10000" v-model="range"></vue-slider>

                <div class="price-range-text mt-2">
                    <input type="number" v-model="range[0]">
                    -
                    <input type="number" max v-model="range[1]">
                </div>
            </div>
            <br>
            <div class="submit">
                <input type="button" @click="signalChange" value="Filter Product" class="btn btn-block btn-theme">
            </div>
            <br>
            <p class="small reset-btn text-center" @click="resetFilter">
                Reset Filter
            </p>
        </form>
    </div>
</template>

<script>

    import VueSlider from 'vue-slider-component'
    import 'vue-slider-component/theme/default.css'


    export default {
        name: "ProductFilter",
        components: {
            VueSlider
        },
        props: ['callResetFilterFunction'],
        data() {
            return {
                showFilterMenuOnMobile: false,
                range: [0, 10000],
                filter: {
                    gender: 'All',
                    short: 'new',
                    priceRange: null,
                }
            }
        },
        methods: {
            resetFilter() {
                this.filter.gender = 'All';
                this.filter.short = 'new';
                this.filter.priceRange = null;
                this.range = [0, 10000];
                this.signalChange();

            },
            signalChange() {
                this.filter.priceRange = this.range;
                this.$emit('filterProduct', this.filter)
            }
        },
        watch: {
            callResetFilterFunction(val) {
                if (val) {
                    this.resetFilter();
                    this.$emit('filterFromResetCompleted')
                }
            }
        },
        mounted() {
            this.$root.$on('showFilterMenuOnMobile', (dataReceived) => {
                this.showFilterMenuOnMobile = dataReceived;
            })
        }
    }
</script>

<style>


    .price-range-text {
        text-align: center;
        font-weight: bold;
        color: #ff652e;
        font-size: 20px;
    }

    .reset-btn {
        cursor: pointer;
    }

    .vue-slider-process {
        background-color: #ff632d !important;
        border-radius: 15px;
    }

    .vue-slider-dot-tooltip-inner {
        border-color: #ff622c !important;
        background-color: #ff652d !important;
    }

    input[type="number"] {
        width: 100px;
        text-align: center;
        /* border-color: #aaaaaa; */
        border: 1px solid #eaeaea;
        padding: 5px 10px;
        font-size: 16px;
        color: #858585;
        border-radius: 4px;
    }

    .show-filter-on-mobile {
        transform: translate(0px) !important;
    }

    #closeMobileSidebar {
        padding-right: 10px;
        position: absolute;
        right: 0;
        top: 18px;
    }
</style>
