<template>
  <div id="page-wrapper" style="padding-top: 20px">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Add edit</div>

        <div class="panel-body">
          <form @submit.prevent="createcategory()">
            <!-- rows -->
            <div class="row" style="margin-top: 5px">
              <div class="col-md-2">Name</div>
              <div class="col-md-4">
                <a-input placeholder="Input Name" v-model:value="name"  allow-clear />
              </div>
            </div>
            
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
import { defineComponent, ref, onMounted, reactive,toRefs } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { message } from 'ant-design-vue';  
export default defineComponent({
  setup() {
    const router =useRouter();
    const createcategory = () => {
      console.log(category);
      axios
        .post("http://localhost/intern/web_intern/public/api/backend/category/createpost",category)
        .then(function (response) {
          message.success("Done");
          router.push({name: "admin-category"});
          console.log(response);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    }
    const category=reactive({
      name:''
    
    })
    return {
      createcategory,
      ...toRefs(category)
    
    };
  },
  
});
</script>