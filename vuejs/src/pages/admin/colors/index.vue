<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
const users = ref([]);
const confirmModalVisible = ref(false);
const userToDelete = ref(null);

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
  
];

const getUsers = () => {
  axios
    .get(`http://localhost/intern/web_intern/public/api/backend/color`)
    .then(function (response) {
      users.value = response.data;
    })
    .catch(function (error) {
      console.error("Error fetching user data:", error);
      console.log("lỗi"); // Xử lý lỗi nếu cần
    });
};

const showConfirmModal = (user) => {
  userToDelete.value = user;
  confirmModalVisible.value = true;
};

const hideConfirmModal = () => {
  confirmModalVisible.value = false;
  userToDelete.value = null;
};

const deleteUser = () => {
  if (userToDelete.value) {
    axios
      .get(
        `http://localhost/intern/web_intern/public/api/backend/color/delete/${userToDelete.value.id}`
      )
      .then((response) => {
        getUsers();
      })
      .catch((error) => {
        // Xử lý lỗi nếu cần
      });
    hideConfirmModal();
  }
};

onMounted(() => {
  getUsers();
});
</script>
<template>
  <div id="page-wrapper" style="padding-top: 20px">
    <div class="row">
      <div v-if="confirmModalVisible" style="z-index: 1">
        <div class="modal-content">
          <p>Are you sure you want to delete this color?</p>
          <button @click="deleteUser(userToDelete)">Confirm</button>
          <button @click="hideConfirmModal">Cancel</button>
        </div>
      </div>
      <div style="margin-bottom: 5px">
          <router-link
            :to="{ name: 'admin-color-create' }"
            class="btn btn-primary"
          >
            Create
          </router-link>
        </div>
      <DataTable
        :value="users"
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
                name: 'admin-color-update',
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

