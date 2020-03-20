<template>
    <div class="main-panel" style="width: 100% !important;">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Dashboards
                </h3>
            </div>
            <div class="row grid-margin">
                <div class="col-12">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                                <div class="statistics-item">
                                    <p>
                                        <i class="icon-sm fab fa-trello menu-icon mr-2"></i>
                                        Total Mixes
                                    </p>
                                    <h2>#</h2>
                                </div>
                                <div class="statistics-item">
                                    <p>
                                        <i class="icon-sm fab fa-wpforms menu-icon mr-2"></i>
                                        Total Videos
                                    </p>
                                    <h2>#</h2>
                                </div>
                                <div class="statistics-item">
                                    <p>
                                        <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                                        Total Gallery Images
                                    </p>
                                    <h2>#</h2>
                                </div>
                                <div class="statistics-item">
                                    <p>
                                        <i class="icon-sm fas fa-users mr-2"></i>
                                        Total Subscribers
                                    </p>
                                    <h2>#</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent Activities</h4>
                            <div class="mt-5">
                                <div class="timeline">

                                    <div class="timeline-wrapper timeline-wrapper-success ">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h6 class="timeline-title"><b>Collection Updated</b></h6>
                                            </div>
                                            <div class="timeline-body">
                                                <p>
                                                    Lesan S. Updated A Collection To DANCERS
                                                </p>
                                            </div>
                                            <div class="timeline-footer d-flex align-items-center">
                                                <span class="ml-auto font-weight-bold">1 day ago</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="timeline-wrapper timeline-inverted timeline-wrapper-warning ">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h6 class="timeline-title"><b>Art Updated</b></h6>
                                            </div>
                                            <div class="timeline-body">
                                                <p>
                                                    Lesan S. Updated a Art: AWESOME ART
                                                </p>
                                            </div>
                                            <div class="timeline-footer d-flex align-items-center">
                                                <span class="ml-auto font-weight-bold">1 day ago</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="timeline-wrapper timeline-wrapper-success ">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h6 class="timeline-title"><b>Image Uploaded</b></h6>
                                            </div>
                                            <div class="timeline-body">
                                                <p>
                                                    Lesan S. Uploaded a Image
                                                </p>
                                            </div>
                                            <div class="timeline-footer d-flex align-items-center">
                                                <span class="ml-auto font-weight-bold">1 day ago</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="timeline-wrapper timeline-inverted timeline-wrapper-warning ">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h6 class="timeline-title"><b>Image Uploaded</b></h6>
                                            </div>
                                            <div class="timeline-body">
                                                <p>
                                                    Lesan S. Uploaded a Image
                                                </p>
                                            </div>
                                            <div class="timeline-footer d-flex align-items-center">
                                                <span class="ml-auto font-weight-bold">1 day ago</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="timeline-wrapper timeline-wrapper-success ">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h6 class="timeline-title"><b>Image Uploaded</b></h6>
                                            </div>
                                            <div class="timeline-body">
                                                <p>
                                                    Lesan S. Uploaded a Image
                                                </p>
                                            </div>
                                            <div class="timeline-footer d-flex align-items-center">
                                                <span class="ml-auto font-weight-bold">1 day ago</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="view-all-logs text-center">
                                <a href="#"
                                   class="btn btn-default text-success">View All Logs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Index"
    }
</script>

<style scoped>
    .card.card-statistics {
        background: linear-gradient(85deg, #06b76b, #f5a623);
        color: #ffffff;
    }
</style>
