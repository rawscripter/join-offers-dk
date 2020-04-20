<template>
    <div v-if="totalSubCategories" class="product-subcategory mt-2">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="subcategory-list text-center">
                    <ul>
                        <li v-for="category in subCategories" :key="category.id">
                            <router-link tag="button" class="btn btn-success"
                                         :to='{name:"sub-category-product",params:{subCategory:category.slug,category:categorySlug}}'>
                                <div class="sub-cat-item text-center">
                                    <label>{{category.name}}</label>
                                </div>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
    </div>
</template>

<script>
    export default {
        name: "SubCategoryMenuBar",
        props: ['subCategories', 'categorySlug'],
        data() {
            return {}
        },
        computed: {
            totalSubCategories() {
                return this.subCategories.lenght > 0;
            }
        }
    }
</script>

<style scoped>
    .subcategory-list {
        margin: 0px;
    }

    .subcategory-list a {
        padding: 0;
        margin: 0;
    }

    button {
        cursor: pointer;
    }

    .subcategory-list label {
        color: #fff;
        margin: 0px;
        padding: 0px;
        cursor: pointer;
    }

    .subcategory-list ul li {
        padding: 0px;
        margin-right: 10px;
    }
</style>
