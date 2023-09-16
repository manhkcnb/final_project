<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import Paginator from "primevue/paginator";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import ColumnGroup from "primevue/columngroup"; // optional
import Row from "primevue/row";

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
  {
    title: "Email",
    dataIndex: "email",
    key: "email",
  },
];

const getUsers = () => {
  axios
    .get(`http://localhost/intern/web_intern/public/api/backend/users`)
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
        `http://localhost/intern/web_intern/public/api/backend/users/delete/${userToDelete.value.id}`
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
          <p>Are you sure you want to delete this user?</p>
          <button @click="deleteUser(userToDelete)">Confirm</button>
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
        
        :value="users"
        paginator
        :rows="3"
        :rowsPerPageOptions="[5, 10, 20, 50]"
       
       
        
      >
      
        <Column field="name" header="Name"></Column>
        <Column field="email" header="Email"></Column>
        <Column header="Actions">
          <template #body="rowData">
            
            <router-link
              :to="{
                name: 'admin-users-update',
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

<!-- <template>
  <div id="page-wrapper" style="padding-top: 20px">
    <div class="row">
      <div v-if="confirmModalVisible" style="z-index: 1">
        <div class="modal-content">
          <p>Are you sure you want to delete this user?</p>
          <button @click="deleteUser(userToDelete)">Confirm</button>
          <button @click="hideConfirmModal">Cancel</button>
        </div>
      </div>
      <div class="col-md-12">
        
        <div style="margin-bottom: 5px">
          <router-link
            :to="{ name: 'admin-users-create' }"
            class="btn btn-primary"
          >
            Create
          </router-link>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">List</div>
          <div class="panel-body">
            <table class="table table-bordered table-hover" border="1">
              <tr style="margin: 2px">
                <th>Name</th>
                <th>Email</th>
                <th></th>
              </tr>

              <tr v-for="(user, index) in paginatedUsers" :key="user.name">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>

                <td>
                  <span>
                    <router-link
                      :to="{
                        name: 'admin-users-update',
                        params: { id: user.id },
                      }"
                      class="btn btn-success mr-2"
                    >
                      Edit
                    </router-link>

                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="showConfirmModal(user)"
                    >
                      Delete
                    </button>
                  </span>
                </td>
              </tr>
            </table>
          </div>
          <div>
           
          </div>
        </div>
      </div>
    </div>

  <div class="card">
      <Paginator v-model="currentPage" :rows="3" :totalRecords="totalRecords" :rowsPerPageOptions="[1, 2, 3]" @onPageChange="onPageChange"></Paginator>

  </div>
  </div>
</template> -->





