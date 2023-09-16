<template>
  <div class="container" style="margin-top: 40px">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading">Login</div>
          <div class="panel-body">
            <div class="row" style="margin-top: 5px">
              <div class="col-md-2">Email</div>
              <div class="col-md-9">
                <a-input
                  placeholder="input email"
                  type="email"
                  v-model:value="user.email"
                  allow-clear
                />
              </div>
            </div>
            <div class="row" style="margin-top: 5px">
              <div class="col-md-2">Password</div>
              <div class="col-md-9">
                <a-input
                  placeholder="input passwword"
                  type="password"
                  v-model:value="user.password"
                  allow-clear
                />
              </div>
            </div>
            <div class="row" style="margin-top: 5px">
              <div class="col-md-2"></div>
              <div class="col-md-9">
                <button @click="login" class="btn btn-primary">Login</button>
                <input type="reset" value="Reset" class="btn btn-danger" />
              </div>
            </div>
          </div>
          <router-link :to="{ name: 'forgot-password' }">
            Forgot password
          </router-link>
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
import { useStore } from "vuex";
const store = useStore();
const router = useRouter();
const user = reactive({
  email: "",
  password: "",
});

  // store.commit("setEmail",'');

const login = () => {
  
  axios
    .post(
      "http://localhost/intern/web_intern/public/api/backend/loginPost",
      user,
      {
        headers: {
          "Content-Type": "application/json",
        },
      }
    )
    .then(function (response) {
     
      if (response.data == "done") {
        store.commit("setEmail", user.email);
        console.log(store.getters.getEmail);
        router.push({ path: "/admin" });
      } else {
        message.success("Wrong email or password");
      }
    })
    .catch(function (error) {
      message.success("Lỗi");
      console.log(error);
    });
};
</script>
