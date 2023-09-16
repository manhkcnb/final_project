<script setup>
import { ref, onMounted, computed, toRefs, reactive } from "vue";
import axios from "axios";
import DataTable from "primevue/datatable";
import Column from "primevue/column";

import { FilterMatchMode, FilterOperator } from "primevue/api";

const products = ref([]);
const confirmModalVisible = ref(false);
const check = ref(false);
const selectedProduct = ref([]);
const productsToDelete = ref(null);

const columns = [
  {
    title: "id",
    dataIndex: "id",
    key: "id",
  },
  {
    title: "Name",
    dataIndex: "name",
    key: "name",
  },
  {
    title: "Category",
    dataIndex: "category",
    key: "category",
  },
  {
    title: "Category_name",
    dataIndex: "category_name",
    key: "category_name",
  },
  {
    title: "price",
    dataIndex: "price",
    key: "price",
  },
  {
    title: "photo",
    dataIndex: "photo",
    key: "photo",
  },
];

const getProducts = () => {
  axios
    .get(`http://localhost/intern/web_intern/public/api/backend/products`)
    .then(function (response) {
      console.log(response);
      products.value = response.data;
    })
    .catch(function (error) {
      console.error("Error fetching products data:", error);
      console.log("lỗi"); // Xử lý lỗi nếu cần
    });
};
const searchQuery = ref("");
const search = () => {
  console.log(searchQuery.value);
  axios
    .post(
      `http://localhost/intern/web_intern/public/api/backend/products/searchKey`,
      searchQuery.value,
      {
        headers: {
          "Content-Type": "application/json",
        },
      }
    )
    .then((response) => {
      console.log(response);
      products.value = response.data;
    })
    .catch((error) => {
      // Xử lý lỗi nếu cần
    });
};
const showConfirmModal = (products) => {
  productsToDelete.value = products;
  check.value = true;
  confirmModalVisible.value = true;
};
const deleteselect = () => {
  confirmModalVisible.value = true;
  check.value = false;
};
// const pro = reactive({
//       id:''
//     });
const hideConfirmModal = () => {
  confirmModalVisible.value = false;
  productsToDelete.value = null;
};

const deleteProducts = () => {
  if (productsToDelete.value) {
    axios
      .get(
        `http://localhost/intern/web_intern/public/api/backend/products/delete/${productsToDelete.value.id}`
      )
      .then((response) => {
        getProducts();
      })
      .catch((error) => {
        // Xử lý lỗi nếu cần
      });
    hideConfirmModal();
  }
};

const deleteAllProducts = () => {
  console.log(selectedProduct);

  axios
    .post(
      `http://localhost/intern/web_intern/public/api/backend/products/deleteItems`,
      selectedProduct.value,
      {
        headers: {
          "Content-Type": "application/json",
        },
      }
    )
    .then((response) => {
      getProducts();
    })
    .catch((error) => {
      // Xử lý lỗi nếu cần
    });
  hideConfirmModal();
};

onMounted(() => {
  search();
});

const test = () => {
  console.log(selectedProduct);
};
</script>


<template>
  <div id="page-wrapper" style="padding-top: 20px">
    <div class="row">
      <div v-if="confirmModalVisible" style="z-index: 1">
        <div class="modal-content">
          <p>Are you sure you want to delete this products?</p>
          <button
            v-if="check == true"
            @click="deleteProducts(productsToDelete)"
          >
            Confirm
          </button>
          <button v-if="check == false" @click="deleteAllProducts()">
            Confirms
          </button>
          <button @click="hideConfirmModal">Cancel</button>
        </div>
      </div>
      <div style="margin-bottom: 5px">
        <router-link
          :to="{ name: 'admin-products-create' }"
          class="btn btn-primary"
        >
          Create
        </router-link>
        <router-link
          :to="{ name: 'admin-products-allsoftdeleted' }"
          class="btn btn-success"
        >
          AllSoftDeleted
        </router-link>
        <button type="button" class="btn btn-danger" @click="deleteselect()">
          Delete Select
        </button>
        <span class="p-input-icon-left">
          <input type="text" v-model="searchQuery" placeholder="Tìm kiếm..." />
          <button class="button-search" @click="search">Tìm kiếm</button>
        </span>
      </div>
      <div></div>

      <DataTable
        v-model:selection="selectedProduct"
        :value="products"
        paginator
        :rows="10"
        :rowsPerPageOptions="[5, 10, 20, 50]"
      >
        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
        <Column field="name" header="Name"></Column>
        <Column field="category_name" header="Category"></Column>
        <Column header="Image">
          <template #body="slotProps">
            <img
              :src="slotProps.data.photo"
              :alt="slotProps.data.image"
              style="width: 100px"
            />
          </template>
        </Column>
        <Column field="price" header="price"></Column>
        <Column header="Actions">
          <template #body="rowData">
            <router-link
              :to="{
                name: 'admin-products-detail',
                params: { id: rowData.data.id },
              }"
              class="btn btn-primary mr-2"
            >
              Detai
            </router-link>
            <router-link
              :to="{
                name: 'admin-products-update',
                params: { id: rowData.data.id },
              }"
              class="btn btn-success mr-2"
            >
              Edit
            </router-link>

            <button
              type="button"
              class="btn btn-danger"
              @click="showConfirmModal(rowData.data)"
            >
              Delete
            </button>
          </template>
        </Column>
      </DataTable>
    </div>
  </div>
</template>




