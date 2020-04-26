<template>
    <div class="product-subcategory mt-2">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="subcategory-list text-center">
                    <ul>
                        <li v-for="(category,index) in subCategories" :key="category.id">
                            <button class="btn btn-theme" @click="selectedSubCategory(index)">
                                <label>{{category.name}}</label>
                            </button>

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
        methods: {
            selectedSubCategory(subIndex) {
                this.$emit('selectedSubCategory', subIndex)
            }
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
