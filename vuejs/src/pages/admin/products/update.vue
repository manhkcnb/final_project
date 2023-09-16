<template>
    <div id="page-wrapper" style="padding-top: 20px">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Edit</div>
  
          <div class="panel-body">
            <form @submit.prevent="editProducts()">
              <!-- rows -->
              <div class="row" style="margin-top: 5px">
                <div class="col-md-2">Name</div>
                <div class="col-md-4">
                  <a-input
                    placeholder="Input Name"
                    v-model:value="productsData.name"
                    allow-clear
                  />
                </div>
              </div>
              <!-- end rows -->
              <!-- rows -->
              <div class="row" style="margin-top: 5px">
              <div class="col-md-2">Category</div>
              <div class="col-md-4">
                <select v-model="category_id"  style="width: 100%">
                  <option  selected> {{productsData.category_name}}</option>
                  <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                  >
                    {{category.name}}
                  </option>
                </select>
              </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top: 5px">
              <div class="col-md-2">Photo</div>
              <div class="col-md-4">
                <a-input
                  placeholder="input photo"
                  v-model:value="productsData.photo"
                  allow-clear
                />
              </div>
            </div>
            <div class="row" style="margin-top: 5px">
              <div class="col-md-2">Price</div>
              <div class="col-md-4">
                <a-input
                  placeholder="input password"
                  v-model:value="productsData.price"
                  allow-clear
                />
              </div>
            </div>
  
              <!-- end rows -->
              <!-- rows -->
              <div class="row" style="margin-top: 5px">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                  <a-button type="primary" html-type="submit">
                    <span>Lưu</span>
                  </a-button>
                </div>
              </div>
              <!-- end rows -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { defineComponent, ref, onMounted, reactive, toRefs } from "vue";
  import { useRoute } from "vue-router";
  import axios from "axios";
  import { useRouter } from "vue-router";
  
  
  export default defineComponent({
    setup() {
      const categories = ref([]);
      const route = useRoute();
      const router =useRouter();
      const productsId = route.params.id;
      const productsData = reactive({
        name: "",
        category_name: "",
        price: "",
        photo:'',
        category_id: "",
        
       
      });
      
      const editProducts = () => {
        axios
          .post(
            `http://localhost/intern/web_intern/public/api/backend/products/updatePost/${productsId}`,
            productsData
          )
          .then(function (response) {
            router.push({name: "admin-products"});
            console.log(response);
          })
          .catch(function (error) {
            // Xử lý lỗi
            console.log(error);
          });
      };
  
      const getProductsData = () => {
        axios
          .get(
            `http://localhost/intern/web_intern/public/api/backend/products/update/${productsId}`
          )
          .then(function (response) {
           
            const products = response.data; 
            productsData.name = products.name;
            productsData.category_name = products.category_name;
            productsData.category_id = products.category_id;
            productsData.photo = products.photo;
            productsData.price = products.price;

          })
          .catch(function (error) {
            // Xử lý lỗi
            console.log(error);
          });
      };const getCategory = () => {
      axios
        .get("http://localhost/intern/web_intern/public/api/backend/category")
        .then(function (response) {
          categories.value = response.data;
          console.log(categories);
          console.log(1);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    };
    
  
      // Gọi hàm để lấy dữ liệu người dùng khi component được tạo
      onMounted(() => {
        getProductsData();
        getCategory();
      });
      console.log(productsData);
      return {
        productsData,
        editProducts,
        categories
      };
    },
  });
  </script>
  