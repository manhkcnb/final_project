<template>
  <div id="page-wrapper" style="padding-top: 20px">
    <div class="row">
      <div class="container mt-4">
        <div class="card">
          <div class="container-fliud">
            <div class="wrapper row">
              <div class="preview col-md-4">
                <img :src="productsData.photo" class="preview col-md-8" />
              </div>
              <div class="details col-md-6">
                <h3 class="product-title">
                  {{ productsData.name }}
                </h3>
                <h4 class="product-description">
                  Category:{{ productsData.category_name }}
                </h4>
                <h4 class="price">
                  Price: {{ productsData.price }} <span> vnđ</span>
                </h4>

                <h5 class="sizes">
                  Size:

                  <select v-model="productsData.size_id" style="width: 100%">
                    <option v-for="row in size" :key="row.id" :value="row.id">
                      {{ row.name }}
                    </option>
                  </select>
                </h5>
                <h5 class="colors">
                  Color:
                  <select v-model="productsData.color_id" style="width: 100%">
                    <option v-for="row in color" :key="row.id" :value="row.id">
                      {{ row.name }}
                    </option>
                  </select>
                </h5>

                <div class="form-group">
                  <label for="soluong">Số lượng :</label>
                  <a-input placeholder="Input Name" v-model:value="quantity" />
                </div>
                <button @click="tss">Cập Nhập</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { defineComponent, ref, onMounted, reactive, toRefs } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { useRoute } from "vue-router";
import { Upload, message } from "ant-design-vue";
import { watch } from "vue";
export default defineComponent({
  setup() {
    const route = useRoute();
    const router = useRouter();
    const productsId = route.params.id;
    console.log(productsId);
    const size = ref([]);
    const color = ref([]);
    const productsData = reactive({
      name: "",
      category_name: "",
      price: "",
      photo: "",
      category_id: "",
      color_id: 0,
      size_id: "",
    });
    watch([() => productsData.size_id, () => productsData.color_id], () => {
      requestData.color_id = productsData.color_id;
      requestData.size_id = productsData.size_id;
      updateQuantity();
    });
    
    const tss = () => {
      axios
        .post(
          "http://localhost/intern/web_intern/public/api/backend/detailPost",
          requestData
        )
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    };
    const getProductsData = () => {
      axios
        .get(
          `http://localhost/intern/web_intern/public/api/backend/detail/${productsId}`
        )
        .then(function (response) {
          const products = response.data;
          productsData.name = products.name;
          productsData.category_name = products.category_name;
          productsData.category_id = products.category_id;
          productsData.photo = products.photo;
          productsData.price = products.price;
          console.log(productsData);
        })
        .catch(function (error) {
          // Xử lý lỗi
          console.log(error);
        });
    };
    const getColor = () => {
      axios
        .get("http://localhost/intern/web_intern/public/api/backend/color")
        .then(function (response) {
          color.value = response.data;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    };
    const getSize = () => {
      axios
        .get("http://localhost/intern/web_intern/public/api/backend/size")
        .then(function (response) {
          size.value = response.data;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    };
    const quantity = ref("");
    const requestData = reactive({
      color_id: productsData.color_id,
      size_id: productsData.size_id,
      name_id: productsId,
      quantity: quantity
    });
   
    const updateQuantity = () => {
      console.log(requestData);
      axios
        .post(
          "http://localhost/intern/web_intern/public/api/get-quantity",
          requestData
        )
        .then(function (response) {
          quantity.value = response.data;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    };

    onMounted(() => {
      getProductsData();
      getColor();
      getSize();
    });
    return {
      productsData,
      color,
      size,
      quantity,
      tss,
    };
  },
});
</script>