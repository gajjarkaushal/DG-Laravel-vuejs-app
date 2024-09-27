<script setup>
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';  // Use Inertia's usePage to access prop

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InstallerForm from './InstallerForm.vue';
import axios from 'axios';

// Access the installer object from Inertia's $page.props
const page = usePage();
console.log(InstallerForm.$refs);
// const installer = computed(() => page.props.installer);
// console.log(installer);
console.log('Installer ID:', installer.value.id);  // Access the installer ID

const fetchInstaller = async (id) => {
  try {
    const response = await axios.get(`/v1/installers-api/${id}`);
    installer.value = response.data;  // Set the installer data
  } catch (error) {
    console.error("Failed to fetch installer:", error);
  }
};
// Fetch installer data if we're in edit mode (installerId exists)
onMounted(() => {
    
  if (installerId.value) {
    fetchInstaller(installerId.value);
  }
});
</script>

<template>
  <AuthenticatedLayout>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 v-if="installerId">Edit Installer</h1>
        <h1 v-else>Create Installer</h1>

        <!-- InstallerForm component, passing installer data if available -->
        <InstallerForm v-if="installerId" :installer="installer" @refresh="fetchInstallers" />
        <InstallerForm v-else @refresh="fetchInstallers" />
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
/* Your styles here */
</style>