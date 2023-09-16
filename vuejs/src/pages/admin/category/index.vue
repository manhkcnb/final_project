<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import Paginator from "primevue/paginator";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import ColumnGroup from "primevue/columngroup"; // optional
import Row from "primevue/row";

const category = ref([]);
const confirmModalVisible = ref(false);
const categoryToDelete = ref(null);

const columns = [
  {
    title: "id",
    dataIndex: "id",
    key: "id",
  },
  {
    title: "name",
    dataIndex: "name",
    key: "name",
  },
  
];

const getcategory = () => {
  axios
    .get(`http://localhost/intern/web_intern/public/api/backend/category`)
    .then(function (response) {
      category.value = response.data;
      console.log(category.value);
    })
    .catch(function (error) {
      console.error("Error fetching user data:", error);
      console.log("lỗi"); // Xử lý lỗi nếu cần
    });
};

const showConfirmModal = (category) => {
  categoryToDelete.value = category;
  confirmModalVisible.value = true;
};

const hideConfirmModal = () => {
  confirmModalVisible.value = false;
  categoryToDelete.value = null;
};

const deleteCategory = () => {
  if (categoryToDelete.value) {
    axios
      .get(
        `http://localhost/intern/web_intern/public/api/backend/category/delete/${categoryToDelete.value.id}`
      )
      .then((response) => {
        getcategory();
      })
      .catch((error) => {
        // Xử lý lỗi nếu cần
      });
    hideConfirmModal();
  }
};

onMounted(() => {
  getcategory();
});
</script>


<template>
  <div id="page-wrapper" style="padding-top: 20px">
    <div class="row">
      <div v-if="confirmModalVisible" style="z-index: 1">
        <div class="modal-content">
          <p>Are you sure you want to delete this category?</p>
          <button @click="deleteCategory(categoryToDelete)">Confirm</button>
          <button @click="hideConfirmModal">Cancel</button>
        </div>
      </div>
      <div style="margin-bottom: 5px">
          <router-link
            :to="{ name:'admin-category-create'}"
            class="btn btn-primary"
          >
            Create
          </router-link>
        </div>
      <DataTable
        
        :value="category"
        paginator
        :rows="3"
        :rowsPerPageOptions="[5, 10, 20, 50]"
      >
        <Column field="id" header="Id"></Column>
        <Column field="name" header="Name"></Column>
        <Column header="Actions">
          <template #body="rowData">
            
            <router-link
              :to="{
                name: 'admin-category-update',
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

