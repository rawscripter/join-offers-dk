<template>
    <div>
        <div id="sticky-header" class="fixed-top">
            <SiteTopHeader></SiteTopHeader>
            <hr class="m-0 p-0">
            <SiteNavBar></SiteNavBar>
        </div>
        <!--to load body-->
        <div class="mt-200" id="main_body_area">
            <slot></slot>
        </div>

        <div class="site-footer">
            <SiteFooter></SiteFooter>
        </div>
    </div>
</template>

<script>
    import SiteNavBar from "./SiteNavBar";
    import SiteTopHeader from "./SiteTopHeader";
    import SiteFooter from "../SiteFooter";

    export default {
        name: "SiteLayout",
        components: {
            SiteNavBar,
            SiteTopHeader,
            SiteFooter
        }
    }
</script>

<style scoped>
    /* The sticky class is added to the header with JS when it reaches its scroll position */
    .sticky {
        position: fixed;
        top: 0;
        width: 100%
    }

    .mt-200 {
        margin-top: 210px;
    }

    @media (max-width: 1200px){
.mt-200{
    margin-top: 290px;
}
    }


    @media (max-width: 900px){
        .mt-200{
            margin-top: 300px;
        }
    }

</style>
