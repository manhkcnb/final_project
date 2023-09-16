<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import Paginator from "primevue/paginator";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import ColumnGroup from "primevue/columngroup"; // optional
import Row from "primevue/row";

const products = ref([]);
const confirmModalVisible = ref(false);
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
    .get(`http://localhost/intern/web_intern/public/api/backend/products/allSoftDeleted`)
    .then(function (response) {
      products.value = response.data;
    })
    .catch(function (error) {
      console.error("Error fetching products data:", error);
      console.log("lỗi"); // Xử lý lỗi nếu cần
    });
};

const showConfirmModal = (products) => {
  productsToDelete.value = products;
  confirmModalVisible.value = true;
};

const hideConfirmModal = () => {
  confirmModalVisible.value = false;
  productsToDelete.value = null;
};

const deleteProducts = () => {
  if (productsToDelete.value) {
    axios
      .get(
        `http://localhost/intern/web_intern/public/api/backend/products/deletes/${productsToDelete.value.id}`
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
const restore=(id) =>{
    axios
      .get(
        `http://localhost/intern/web_intern/public/api/backend/products/restore/${id}`
      )
      .then((response) => {
        getProducts();
      })
      .catch((error) => {
        // Xử lý lỗi nếu cần
      });
    
  
}

onMounted(() => {
  getProducts();
});
</script>


<template>
  <div id="page-wrapper" style="padding-top: 20px">
    <div class="row">
      <div v-if="confirmModalVisible" style="z-index: 1">
        <div class="modal-content">
          <p>Are you sure you want to delete this products?</p>
          <button @click="deleteProducts(productsToDelete)">Confirm</button>
          <button @click="hideConfirmModal">Cancel</button>
        </div>
      </div>
      <div style="margin-bottom: 5px">
          <router-link
            :to="{ name: 'admin-products' }"
            class="btn btn-primary"
          >
            Products
          </router-link>
          
        </div>
      <DataTable
        :value="products"
        paginator
        :rows="10"
        :rowsPerPageOptions="[5, 10, 20, 50]"
      >
        <Column field="name" header="Name"></Column>
        <Column field="category_name" header="Category"></Column>
        <Column header="Image">
        <template #body="slotProps">
            <img :src="slotProps.data.photo" :alt="slotProps.data.image" style="width: 100px;" />
        </template>
    </Column>
        <Column field="price" header="price"></Column>
        <Column header="Actions">
          <template #body="rowData">
            <button
              type="button"
              class="btn btn-success"
              @click="restore(rowData.data.id)"
            >
                Restore
            </button>
            
            
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




