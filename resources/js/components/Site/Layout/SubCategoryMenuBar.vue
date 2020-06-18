<template>
    <div class="product-subcategory mt-2">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="subcategory-list text-center">
                    <ul>
                        <li v-for="(category,index) in subCategories" :key="category.id">
                            <button class="btn btn-theme"
                                    @click="selectedSubCategory(index)"
                                    :class="{active : activeSubCategory === index}"
                            >
                                <img v-if="category.icon" :src="`/images/icons/${category.icon}`" width="24" alt="ICON">

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
            return {
                activeSubCategory: null,
            }
        },
        methods: {
            selectedSubCategory(subIndex) {
                this.activeSubCategory = subIndex;
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
        color: #767676;
        margin: 0px;
        padding: 0px;
        cursor: pointer;
        font-weight: bold;
        letter-spacing: 1px;
    }
    .subcategory-list ul li {
        padding: 0px;
        margin-right: 10px;
    }
    .btn-theme {
        background-color: #edeaea !important;
        border-color: #edeaea !important;
        background-image: linear-gradient(to right, #edeaea, #edeaea);
        color: #030303 !important;
    }

    .btn-theme.active label {
        color: #000 !important;
    }
</style>
