<template>
    <div class="header_menu">
        <nav class="navbar navbar-expand-lg navbar-light" style="background:#fff">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <button class="navbar-toggler" type="button" id="openSidebar">
                filter sidebar
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto text-center">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">
                            Home
                        </router-link>
                    </li>

                    <li class="nav-item" v-for="category in categories">
                        <router-link :to="{name:'category-product',params:{category:category.slug}}" class="nav-link">
                            {{category.name}}
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        name: "SiteNavBar",
        data() {
            return {
                categories: []
            }
        },
        methods: {
            getCategories() {
                axios.get(`${APP_URL}/api/categories`)
                    .then(res => {
                        this.categories = res.data.categories;
                    }).catch(error => {
                    console.error(error)
                })
            },
        },
        created() {
            this.getCategories();
        }
    }
</script>

<style scoped>
    a.nav-link.router-link-exact-active.router-link-active {
        color: rgba(0, 0, 0, .9);
    }
</style>
