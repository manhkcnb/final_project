<template>
    <div id="page-wrapper" style="padding-top: 20px">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Edit</div>
  
          <div class="panel-body">
            <form @submit.prevent="editUser()">
              <!-- rows -->
              <div class="row" style="margin-top: 5px">
                <div class="col-md-2">Name</div>
                <div class="col-md-4">
                  <a-input
                    placeholder="Input Name"
                    v-model:value="userData.name"
                    allow-clear
                  />
                </div>
              </div>
              <!-- end rows -->
              <!-- rows -->
              <div class="row" style="margin-top: 5px">
                <div class="col-md-2">Code</div>
                <div class="col-md-4">
                  <a-input
                    placeholder="input code"
                    v-model:value="userData.code"
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
      const userId = route.params.id;
      const userData = reactive({
        name: "",
        email: "",
        password: "",
      });
  
      const editUser = () => {
        axios
          .post(
            `http://localhost/intern/web_intern/public/api/backend/color/updatePost/${userId}`,
            userData
          )
          .then(function (response) {
            router.push({name: "admin-colors"});
            console.log(response);
          })
          .catch(function (error) {
            // Xử lý lỗi
            console.log(error);
          });
      };
  
      const getUserData = () => {
        axios
          .get(
            `http://localhost/intern/web_intern/public/api/backend/color/update/${userId}`
          )
          .then(function (response) {
            // Xử lý dữ liệu người dùng được trả về từ máy chủ
            const user = response.data; // Giả sử dữ liệu người dùng trả về có cấu trúc { name, email, password }
            userData.name = user.name;
            userData.code = user.code;
           
          })
          .catch(function (error) {
            // Xử lý lỗi
            console.log(error);
          });
      };
  
      // Gọi hàm để lấy dữ liệu người dùng khi component được tạo
      onMounted(() => {
        getUserData();
      });
  
      return {
        userData,
        editUser,
      };
    },
  });
  </script>
  