<template>
    <div id="page-wrapper" style="padding-top: 20px">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Edit</div>
  
          <div class="panel-body">
            <form @submit.prevent="editcategory()">
              <!-- rows -->
              <div class="row" style="margin-top: 5px">
                <div class="col-md-2">Name</div>
                <div class="col-md-4">
                  <a-input
                    placeholder="Input Name"
                    v-model:value="categoryData.name"
                    allow-clear
                  />
                </div>
              </div>
              <!-- end rows -->
              <!-- rows -->
              
  
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
      const route = useRoute();
      const router =useRouter();
      const categoryId = route.params.id;
      const categoryData = reactive({
        name: ""
      });
  
      const editcategory = () => {
        axios
          .post(
            `http://localhost/intern/web_intern/public/api/backend/category/updatePost/${categoryId}`,categoryData
          )
          .then(function (response) {
            router.push({name:"admin-category"});
            console.log(response);
          })
          .catch(function (error) {
            // Xử lý lỗi
            console.log(error);
          });
      };
  
      const getcategoryData = () => {
        axios
          .get(
            `http://localhost/intern/web_intern/public/api/backend/category/update/${categoryId}`
          )
          .then(function (response) {
            const category = response.data; 
            categoryData.name = category.name;
          })
          .catch(function (error) {
            console.log(error);
          });
      };
      onMounted(() => {
        getcategoryData();
      });
  
      return {
        categoryData,
        editcategory,
      };
    },
  });
  </script>
  