<template>
  <div class="page-wrapper wow" id="product_area">
    <div class="container">
      <div class="row">
        <div class="col-md-2 col-lg-3">
          <ProductFilter @filterProduct="eventHandler" :callResetFilterFunction="false"></ProductFilter>
        </div>
        <div class="col-md-10 col-lg-9">
          <div class="main-content">
            <div class="product-area" v-if="totalProducts">
              <div class="row">
                <div
                  v-for="product in products"
                  :key="product.id"
                  class="col-md-4 bounceInUp wow col-lg-4 col-sm-6 shadow-sm ml-0 pl-0 mr-0 pr-0"
                >
                  <!-- product single  -->
                  <SingleProduct :product="product"></SingleProduct>
                  <!-- end of product single  -->
                </div>
              </div>
            </div>
            <div v-else>
              <div class="text-center mt-5" v-if="!isLoading">
                <h3 class="big-error-font">
                  <strong>{{errorText}}</strong>
                </h3>
              </div>
            </div>
            <loading :active.sync="isLoading" :is-full-page="false"></loading>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ProductFilter from "../SideBar/ProductFilter";
import SubCategoryMenuBar from "../Layout/SubCategoryMenuBar";
import SingleProduct from "../Layout/Product/Loop/SingleProduct";

export default {
  name: "SiteIndex",
  components: {
    ProductFilter,
    SubCategoryMenuBar,
    SingleProduct
  },

  data() {
    return {
      errorText: "Loading...",
      isLoading: false,
      products: [],
      page: 1,
      lastPage: 2,
      query: {
        gender: "All",
        short: "New",
        minPrice: 0,
        maxPrice: 99999
      }
    };
  },
  methods: {
    eventHandler(data) {
      this.query.gender = data.gender;
      this.query.short = data.short;
      this.query.minPrice = data.priceRange[0];
      this.query.maxPrice = data.priceRange[1];
      this.resetState();
    },
    resetState() {
      this.page = 1;
      this.lastPage = 2;
      this.products = [];
      this.loadMore();
    },
    loadMore() {
      this.isLoading = true;
      let vm = this;
      setTimeout(e => {
        axios
          .get(`${APP_URL}/api/products?page=` + this.page, {
            params: {
              gender: vm.query.gender,
              short: vm.query.short,
              minPrice: vm.query.minPrice,
              maxPrice: vm.query.maxPrice
            }
          })
          .then(response => {
            this.isLoading = false;
            this.lastPage = response.data.lastPage;
            if (response.data.products !== "") {
              $.each(response.data.products, function(key, value) {
                let found = false;
                for (let i = 0; i < vm.products.length; i++) {
                  if (vm.products[i].id === value.id) {
                    found = true;
                    break;
                  }
                }

                if (!found) {
                  vm.products.push(value);
                }
              });
            } else {
              this.errorText = "No Product Found";
            }
            vm.page += 1;
          });
        this.isLoading = false;
      }, 500);
      /**************************************/
    }
  },
  created() {
    this.isLoading = true;
  },
  computed: {
    hasMorePages() {
      return this.lastPage >= this.page;
    },
    totalProducts() {
      return this.products.length > 0;
    }
  },
  mounted() {
    // Detect when scrolled to bottom.
    const listElm = document.querySelector("body");
    listElm.addEventListener("scroll", e => {
      if (listElm.scrollTop + listElm.clientHeight >= listElm.scrollHeight) {
        this.loadMore();
      }
    });
    // Initially load some items.
    this.loadMore();
  }
};
</script>

<style scoped>
.product-area {
  background: #fafafa;
  padding: 5px;
  min-height: 70vh;
}

.big-error-font {
  font-size: 48px;
  color: #3939396b;
  margin-top: 150px !important;
}
</style>
