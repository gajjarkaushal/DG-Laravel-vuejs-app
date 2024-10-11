<template>
    <AuthenticatedLayout>
      <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
          <h1>Managers</h1>
          <button @click="showCreateModal = true" class="btn btn-primary">+ Add Manager</button>
  
          <!-- ManagerForm component displayed when showCreateModal is true -->
          <ManagerForm
            ref="managerForm"
            v-if="showCreateModal"
            @close="showCreateModal = false"
            @refresh="fetchManagers"
          />
        </div>
      </div>
  
      <div class="listings">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
          <table class="min-w-full mt-4">
            <thead>
              <tr>
                <th class="border-b">ID</th>
                <th class="border-b">First Name</th>
                <th class="border-b">Last Name</th>
                <th class="border-b">Email</th>
                <th class="border-b">Role</th>
                <th class="border-b">Status</th>
                <th class="border-b">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="manager in managers" :key="manager.id">
                <td class="border-b">{{ manager.id }}</td>
                <td class="border-b">{{ manager.first_name }}</td>
                <td class="border-b">{{ manager.last_name }}</td>
                <td class="border-b">{{ manager.email }}</td>
                <td class="border-b">{{ manager.role }}</td>
                <td class="border-b">{{ manager.status }}</td>
                <td class="border-b">
                  <button @click="editManager(manager)" class="text-blue-600">Edit</button>
                  <button @click="deleteManager(manager.id)" class="text-red-600">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ManagerForm from './ManagerForm.vue';
import { ref } from 'vue';
import axios from 'axios';

const managers = ref([]);
const showCreateModal = ref(false);
const managerForm = ref([]); // Added this line to define managerForm

const fetchManagers = async () => {
  try {
    const response = await axios.get('/v1/managers-api');
    managers.value = response.data;
  } catch (error) {
    console.error("There was an error fetching the managers!", error);
  }
};

const deleteManager = async (id) => {
  if (confirm('Are you sure you want to delete this installer?')) {
        try {
          await axios.delete(`/v1/managers-api/${id}`);
          this.fetchInstallers(); // Refresh the list
        } catch (error) {
          console.error("There was an error deleting the installer!", error);
        }
      }
};

const editManager = (manager) => {  
  showCreateModal.value = true;
  managers.setManager = { ...manager }; // Set the selected manager data
  
  ManagerForm.$refs.setManager(manager); // Optional if you are directly accessing ref
};
fetchManagers();
</script>
  <style scoped>
  .btn {
    padding: 0.5rem 1rem;
    background-color: #4f46e5;
    color: white;
    border: none;
    border-radius: 0.25rem;
    margin: 0px 10px;
  }
  .btn:hover {
    background-color: #4338ca;
  }
  h1 {
    text-align: center;
    font-size: 30px;
  }
  </style>
