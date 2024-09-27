<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <AuthenticatedLayout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1>Installers</h1>            
            <button @click="showCreateModal = true" class="btn btn-primary">+ Add Installer</button>
        
             <!-- InstallerForm component displayed when showCreateModal is true -->
            <InstallerForm ref="installerForm" v-if="showCreateModal" @close="showCreateModal = false" @refresh="fetchInstallers" />
        </div>
    </div>
    
    <div class="listings">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <table class="min-w-full mt-4">
          <thead>
            <tr>
              <th class="border-b">ID</th>
              <th class="border-b">Name</th>
              <th class="border-b">Business Name</th>
              <th class="border-b">Email</th>
              <th class="border-b">Phone</th>
              <th class="border-b">Status</th>
              <th class="border-b">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="installer in installers" :key="installer.id">
              <td class="border-b">{{ installer.id }}</td>
              <td class="border-b">{{ installer.name }}</td>
              <td class="border-b">{{ installer.business_name }}</td>
              <td class="border-b">{{ installer.email }}</td>
              <td class="border-b">{{ installer.phone }}</td>
              <td class="border-b">{{ installer.status }}</td>
              <td class="border-b">
                <router-link :to="'/installers/' + installer.id" class="text-blue-600">Edit</router-link>
                <button @click="deleteInstaller(installer.id)" class="text-red-600">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import InstallerForm from './InstallerForm.vue';
import axios from 'axios';

export default {
  data() {
    return {
      installers: [],
      showCreateModal: false,  // Declare the modal state here
    };
  },
  created() {
    this.fetchInstallers();
  },
  methods: {
    async fetchInstallers() {
      try {
        const response = await axios.get('/v1/installers-api');
        this.installers = response.data;
      } catch (error) {
        console.error("There was an error fetching the installers!", error);
      }
    },
    async deleteInstaller(id) {
      if (confirm('Are you sure you want to delete this installer?')) {
        try {
          await axios.delete(`/v1/installers-api/${id}`);
          this.fetchInstallers(); // Refresh the list
        } catch (error) {
          console.error("There was an error deleting the installer!", error);
        }
      }
    },
    async editInstaller(id) {
        this.installers = this.installers.find(i => i.id === id);
      this.$refs.form.edit(installer);
    },
  }
};
</script>

<style scoped>
.btn {
  padding: 0.5rem 1rem;
  background-color: #4f46e5;
  color: white;
  border: none;
  border-radius: 0.25rem;
    margin:0px 10px;
}
.btn:hover {
  background-color: #4338ca;
}
h1 {
    text-align: center;
    font-size:30px;
}   
</style>
