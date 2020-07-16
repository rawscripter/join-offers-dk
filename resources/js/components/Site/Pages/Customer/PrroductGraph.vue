<template>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-2">
                    <CustomerLeftSidebar></CustomerLeftSidebar>
                </div>
                <div class="col-md-9 col-lg-10" style="background:#fff">
                    <button class="btn btn-info" @click="$router.go(-1)">Tilbage</button>
                    <br>
                    <br>
                    <div id="chart">
                        <apexchart type="line" height="350" :options="chartOptions"
                                   :series="series"></apexchart>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import CustomerLeftSidebar from "../../Layout/Customer/CustomerLeftSidebar";

    import VueApexCharts from 'vue-apexcharts';

    export default {
        name: "PrroductGraph",
        components: {
            apexchart: VueApexCharts,
            CustomerLeftSidebar,

        },
        data() {
            return {
                chartOptions: {
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: true
                        }
                    },
                    dataLabels: {
                        enabled: true
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    title: {
                        text: 'Product Price fall by Order',
                        align: 'left'
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                    },
                    xaxis: {
                        categories: [],
                    }
                },
                series: [{
                    name: "Price",
                    data: []
                }],
            }
        },
        methods: {
            getGraphValues(eventID) {
                axios.get(`${APP_URL}/api/customer/product/${eventID}/graph`)
                    .then(res => {


                        this.chartOptions = {
                            ...this.chartOptions, ...{
                                xaxis: {
                                    categories: [...res.data.order]
                                }
                            }
                        }

                        this.series = [{
                            data: res.data.price
                        }]
                    }).catch(err => console.log(err))
            }
        },
        created() {
            this.getGraphValues(this.$route.params.product)
        }
    }
</script>

<style scoped>

</style>
