<template>
  <div id="page-wrapper" style="padding-top: 20px">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Add</div>

        <div class="panel-body">
          <form @submit.prevent="createProducts()">
            <!-- rows -->
            <div class="row" style="margin-top: 5px">
              <div class="col-md-2">Name</div>
              <div class="col-md-4">
                <a-input
                  placeholder="Input Name"
                  v-model:value="name"
                  allow-clear
                />
              </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top: 5px">
              <div class="col-md-2">Category</div>
              <div class="col-md-4">
                <select v-model="category_id" style="width: 100%">
                  <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                  >
                    {{ category.name }}
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
                  v-model:value="photo"
                  allow-clear
                />
              </div>
            </div>
            <div class="row" style="margin-top: 5px">
              <div class="col-md-2">Price</div>
              <div class="col-md-4">
                <a-input
                  placeholder="input price"
                  v-model:value="price"
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
import axios from "axios";
import { useRouter } from "vue-router";
import { message } from "ant-design-vue";

export default defineComponent({
  setup() {
    const categories = ref([]);
    const router = useRouter();
    const createProducts = () => {
      console.log(products);
      axios
        .post(
          "http://localhost/intern/web_intern/public/api/backend/products/createPost",
          products
        )
        .then(function (response) {
          message.success("Done");
          router.push({ name: "admin-products" });
          console.log(response);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    };
    const products = reactive({
      name: "",
      category_id: "",
      price: "",
      photo: "",
    });

    const getCategory = () => {
      axios
        .get("http://localhost/intern/web_intern/public/api/backend/category")
        .then(function (response) {
          categories.value = response.data;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    };
    onMounted(() => {
      getCategory();
    });
    return {
      createProducts,
      categories,
      ...toRefs(products),
    };
  },
});
</script>