<template>
    <div class="row mt-5 pl-2 pr-2 m-0">
        <div class="col-12 col-md-5">

            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
                        <h3 class="kt-portlet__head-title">
                            {{formAction.isUpdate? 'Update Sub Category' : ' Add New Sub Category'}}
                        </h3>

                        <div class="toggle-to-create-mode">
                            <div v-if="formAction.isUpdate" @click="resetFormAction"
                                 class="btn btn-primary pull-right btn-sm">
                                Toggle To Create Mode
                            </div>
                        </div>
                    </div>

                </div>

                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <form @submit.prevent="saveFormData">
                        <div class="form-group row">
                            <label class="col-12 col-form-label">Sub Category Icon:</label>
                            <div class="col-12">
                                <h3>Upload Product Images</h3>
                                <vueDropzone ref="myVueDropzone" id="dropzone"
                                             :options="dropzoneOptions"></vueDropzone>
                                <br>


                                <img v-if="formData.icon" :src="`/images/icons/${formData.icon}`" alt="icon"
                                     width="100">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-form-label">Sub Category Name:</label>
                            <div class="col-12">
                                <input required v-model="formData.name" class="form-control" for="category_name"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_Id" class="col-12 col-form-label">Select Category:</label>
                            <div class="col-12">
                                <select name="" v-model="formData.category_id" id="category_Id" class="form-control">
                                    <option>Select Category</option>
                                    <option v-for="category in categories" v-bind:value="category.id">
                                        {{category.name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-form-label">Sub Category Priority:</label>
                            <div class="col-12">
                                <input required v-model="formData.priority" class="form-control" for="category_name"
                                       type="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="btn btn-block"
                                       v-bind:class="submitButtonColor"
                                       type="submit"
                                       value="Save"
                                       v-model="formAction.isUpdate ? 'Update Category' : ' Add New Category'">
                            </div>
                        </div>
                    </form>
                    <!--end: Datatable -->

                    <div v-if="errors_exist">
                        <div v-for="error in validationErrors" class="alert alert-outline-danger">
                            {{ error}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
                        <h3 class="kt-portlet__head-title">
                            All Categories
                        </h3>
                    </div>

                </div>

                <div class="kt-portlet__body">
                    <!--begin: Datatable -->

                    <div class="container">
                        <v-server-table ref="myTable"
                                        :columns="columns"
                                        :options="options">

                            <span slot="icon" slot-scope="{row}">
                              <img v-if="row.icon" :src="`/images/icons/${row.icon}`" width="40" alt="ICON">
                            </span>

                            <span slot="actions" slot-scope="{row}">
                                <button class="btn btn-sm btn-primary" v-on:click="edit(row.id)">Edit</button>
                                <button class="btn btn-sm btn-danger"
                                        v-on:click="deleteCategory(row.id)">Delete</button>
                            </span>

                        </v-server-table>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    export default {
        name: "SubCategoryIndex",
        components: {
            vueDropzone: vue2Dropzone
        },
        data() {
            return {

                columns: ['id', 'name', 'icon', 'categoryName', 'priority', 'user', 'created_at', 'actions'],
                options: {
                    headings: {
                        id: 'ID',
                        name: 'Name',
                        icon: 'Icon',
                        categoryName: 'Category',
                        priority: 'Priority',
                        user: 'Added By',
                        created_at: 'Created At',
                        actions: 'Actions'
                    },
                    perPage: 10,
                    perPageValues: [10, 20, 25, 50, 100],
                    sortable: ['name', 'category', 'id'],
                    filterable: ['name', 'category'],
                    requestFunction: function (data) {
                        let self = this;
                        return axios.get(`${APP_URL}/api/admin/sub-category`, {params: data}).catch(function (e) {
                            self.dispatch('error', e);
                        }.bind(this));
                    },
                    responseAdapter: function (resp) {
                        return {
                            data: resp.data.subCategories,
                            count: resp.data.total,
                        }
                    }
                },
                categories: [],
                formAction: {
                    isUpdate: false,
                    editId: null,
                },
                formData: {
                    name: null,
                    category_id: null,
                    priority: 0,
                    icon: null,
                },
                errors_exist: false,
                formErrors: [],
                dropzoneOptions: {
                    component: this,
                    url: `/api/admin/image/upload`, // Set the url for your upload script location
                    method: 'POST',
                    paramName: "file", // The name that will be used to transfer the file
                    maxFiles: 1,
                    maxFilesize: 2,
                    headers: {"Authorization": `Bearer ${localStorage.getItem('token')}`},
                    accept: function (file, done) {
                        done();
                    },
                    init: function () {
                        var $this = this;
                        this.on("success", function (file, response) {
                            $this.options.component.formData.icon = response;
                            // $this.removeAllFiles(true);
                        })
                    }
                },

            }
        },
        created() {
            this.getCategories();
        },
        methods: {
            resetFormAction() {
                this.formData.name = null;
                this.formData.icon = null;
                this.formData.category_id = null;
                this.formData.priority = 0;
                this.formAction.editId = null;
                this.formErrors = [];
                this.errors_exist = false;
                this.formAction.isUpdate = false;
            },
            getCategories() {
                axios.get(`${APP_URL}/api/admin/category/`)
                    .then(res => {
                        this.categories = res.data.categories;
                    }).catch(error => {
                    console.error(error)
                })
            },
            // to add a new category
            saveFormData() {
                if (this.formAction.isUpdate) {
                    // update existing category
                    axios.patch(`${APP_URL}/api/admin/sub-category/${this.formAction.editId}`, this.formData)
                        .then(res => {
                            Alert.showSuccessAlert(res.data.message);
                            this.$refs.myTable.refresh();
                            this.resetFormAction();

                        }).catch(error => {
                        console.error(error)
                    })
                } else {
                    // add new category
                    axios.post(`${APP_URL}/api/admin/sub-category`, this.formData)
                        .then(res => {
                            if (!res.data.errors) {
                                Alert.showSuccessAlert(res.data.message);
                                this.$refs.myTable.refresh();
                                this.resetFormAction();
                            } else {
                                this.errors_exist = true;
                                this.formErrors = res.data.errors || {};
                                Alert.showErrorAlert(res.data.message);
                            }
                        }).catch(error => {

                    })
                }

            },
            // to edit category
            edit(subCategoryID) {
                this.resetFormAction();
                this.formAction.isUpdate = true;
                axios.get(`${APP_URL}/api/admin/sub-category/${subCategoryID}`)
                    .then(res => {
                        this.formAction.editId = res.data.subCategory.id;
                        this.formData.name = res.data.subCategory.name;
                        this.formData.icon = res.data.subCategory.icon;
                        this.formData.category_id = res.data.subCategory.categoryId;
                        this.formData.priority = res.data.subCategory.priority;
                    }).catch(error => {
                    console.error(error)
                })

            },
            // to delete a category
            deleteCategory(subCategoryID) {
                this.$swal({
                    title: "Delete this record?",
                    text: "Are you sure? You won't be able to revert this!",
                    type: "warning",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Yes, Delete it!"
                }).then((result) => { // <--
                    if (result.value) { // <-- if confirmed
                        this.deleteConfirmation(subCategoryID);
                    }
                });
            },
            deleteConfirmation(subCategoryID) {
                axios.delete(`${APP_URL}/api/admin/sub-category/${subCategoryID}`)
                    .then(res => {
                        Alert.showSuccessAlert(res.data.message);
                        this.$refs.myTable.refresh();
                    }).catch(error => {
                    console.error(error)
                })
            }
        },
        computed: {
            getIconUploadUrl() {
                if (this.formAction.editId)
                    return `${APP_URL}/api/admin/sub-category/${this.formAction.editId}/upload/icons`;
            },
            validationErrors() {
                let errors = Object.values(this.formErrors);
                errors = errors.flat();
                return errors;
            },
            submitButtonColor() {
                return this.formAction.isUpdate ? 'btn-success' : 'btn-primary';
            }
        }


    }
</script>

<style>
    .VueTables__search-field {
        display: flex !important;
    }

    .VueTables__search-field label, .VueTables__limit-field label {
        margin-right: 10px;
    }


    .VueTables__limit-field {
        display: flex !important;
    }

    .toggle-to-create-mode {
        position: absolute;
        right: 15px;
    }
</style>
