<template>
  <div class="container" style="margin-top: 40px">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading">Enter the code sent in email</div>
          <div class="col-md-8"></div>
          <div class="panel-body">
            <div class="row" style="margin-top: 5px">
              <div class="col-md-2">Code</div>
              <div class="col-md-9">
                <a-input
                  placeholder="Password new"
                  type="text"
                  v-model:value="user.code"
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
  code: "",
});
const Confirm = () => {
  
  axios
    .post(
      "http://localhost/intern/web_intern/public/api/backend/resetPost",
      user,
      {
        headers: {
          "Content-Type": "application/json",
        },
      }
    )
    .then(function (response) {
        if (response.data == "done") {
        router.push({ path: "/password-new" });
      } else {
        message.success("Wrong Code");
      }
    })
    .catch(function (error) {
      message.success("Lỗi");
    });
};
</script>
  