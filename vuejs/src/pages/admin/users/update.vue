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
                <div class="col-md-2">Email</div>
                <div class="col-md-4">
                  <a-input
                    placeholder="input email"
                    v-model:value="userData.email"
                    allow-clear
                  />
                </div>
              </div>
              <!-- end rows -->
              <!-- rows -->
              <div class="row" style="margin-top: 5px">
                <div class="col-md-2">Password</div>
                <div class="col-md-4">
                  <a-input
                    placeholder="input password"
                    v-model:value="userData.password"
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
            `http://localhost/intern/web_intern/public/api/backend/users/update-post/${userId}`,
            userData
          )
          .then(function (response) {
            router.push({name: "admin-users"});
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
            `http://localhost/intern/web_intern/public/api/backend/users/update/${userId}`
          )
          .then(function (response) {
            const user = response.data; 
            userData.name = user.name;
            userData.email = user.email;
            userData.password = user.password;
          })
          .catch(function (error) {
          });
      }; 
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
  