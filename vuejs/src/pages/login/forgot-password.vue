<template>
  <div class="container" style="margin-top: 40px">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading">Get password</div>
          <div class="col-md-8"></div>
          <div class="panel-body">
            <div class="row" style="margin-top: 5px">
              <div class="col-md-2">Email</div>
              <div class="col-md-9">
                <a-input
                  placeholder="Enter gmail to retrieve your password"
                  type="email"
                  v-model:value="user.email"
                  allow-clear
                />
              </div>
            </div>
            <div class="row" style="margin-top: 5px">
              <div class="col-md-2"></div>
              <div class="col-md-9">
                <button @click="forget" class="btn btn-primary">
                  Forget password
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
const router = useRouter();
const user = reactive({
  email: "",
});
const store = useStore();
const forget = () => {
// this.$store.commit("email_reset", this.user.email);
store.commit('setEmailReset', user.email);
console.log(store.getters.getEmail_reset);
  axios
    .post(
      "http://localhost/intern/web_intern/public/api/backend/forgotPasswordPost",
      user,
      {
        headers: {
          "Content-Type": "application/json",
        },
      }
    )
    .then(function (response) {
      if (response.data == "done") {
        router.push({ path: "/reset-password" });
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
