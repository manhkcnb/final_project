<template>
    <div class="container" style="margin-top: 40px">
      <div class="row">
        <div class="col-md-8 col-md-offset-3">
          <div class="panel panel-primary">
            <div class="panel-heading"></div>
            
            <div class="panel-body">
              <div class="row" style="margin-top: 5px">
                <div class="col-md-3">Password new</div>
                <div class="col-md-8">
                  <a-input
                    placeholder="Password new"
                    type="password"
                    v-model:value="user.password"
                    allow-clear
                  />
                </div>
              </div>
              <div class="row" style="margin-top: 5px">
                <div class="col-md-2"></div>
                <div class="col-md-9">
                  <button @click="Confirm" class="btn btn-primary">
                    Confirm
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
    <script setup>
  import { reactive } from "vue";
  import axios from "axios";
  import { useRouter } from "vue-router";
  import { message } from "ant-design-vue";
  import { useStore } from 'vuex';
  const store = useStore();
  const router = useRouter();
  const user = reactive({
    email:store.getters.getEmail_reset,
    password: "",
  });
  const Confirm = () => {
    console.log(user);
    axios
      .post(
        "http://localhost/intern/web_intern/public/api/backend/passwordNew",
        user,
        {
          headers: {
            "Content-Type": "application/json",
          },
        }
      )
      .then(function (response) {
       if(response.data=="done"){
          router.push({ path: "/login" });
       }else{
        
       }
      })
      .catch(function (error) {
        message.success("Lỗi");
        console.log(error);
      });
  };
  </script>
    