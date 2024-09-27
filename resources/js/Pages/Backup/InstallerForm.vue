<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
// Props passed from the parent
const props = defineProps({
  installer: {
    type: Object,
    default: () => ({}),
  },
});

// Form data and error handling
const formData = ref({
  business_name: '',
  email: '',
  phone_number: '',
  website_url: '',
  address_1: '',
  city: '',
  postcode: '',
  status: 'Pending',
});

// Success and error messages
const errors = ref('');
const successMessage = ref('');

// Watch for changes in the installer prop and update formData accordingly
watch(() => props.installer, (newInstaller) => {
  if (newInstaller) {
    formData.value = {
      business_name: newInstaller.business_name || '',
      email: newInstaller.email || '',
      phone_number: newInstaller.phone_number || '',
      website_url: newInstaller.website_url || '',
      address_1: newInstaller.address_1 || '',
      city: newInstaller.city || '',
      postcode: newInstaller.postcode || '',
      status: newInstaller.status || 'Pending',
    };
  }
}, { immediate: true }); // Set immediate: true to apply this on initial mount

// Handle form submission
const handleSubmit = () => {
  // Clear previous error and success messages
  errors.value = '';
  successMessage.value = '';

  const url = formData.value.id ? `/v1/installers-api/${formData.value.id}` : '/v1/installers-api';
  const method = formData.value.id ? 'put' : 'post';

  axios[method](url, formData.value)
    .then((response) => {
      successMessage.value = formData.value.id ? 'Installer updated successfully!' : 'Installer added successfully!';
      // Emit events to refresh parent and close the modal
      emit('refresh');
      emit('close');
    })
    .catch((error) => {
      if (error.response && error.response.status === 400) {
        // Handle validation errors
        errors.value = error.response.data.error ? error.response.data.error : 'Something was wrong.';
      } else {
        console.error('Error during form submission:', error);
      }
    });
};

</script>

<template>
  
  <!-- Success and Error Messages (Above Form) -->
  <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
  <div v-if="errors" class="alert alert-denger">{{ errors }}</div>

  <!-- Form for Installer -->
  <form @submit.prevent="handleSubmit">
    <div class="form-group">
      <label for="business_name">Business Name</label>
      <input v-model="formData.business_name" type="text" class="form-control" id="business_name" required />
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input v-model="formData.email" type="email" class="form-control" id="email" required />
    </div>

    <div class="form-group">
      <label for="phone_number">Phone Number</label>
      <input v-model="formData.phone_number" type="text" class="form-control" id="phone_number" required />
    </div>

    <div class="form-group">
      <label for="website_url">Website URL</label>
      <input v-model="formData.website_url" type="url" class="form-control" id="website_url" />
    </div>

    <div class="form-group">
      <label for="address_1">Address 1</label>
      <input v-model="formData.address_1" type="text" class="form-control" id="address_1" required />
    </div>

    <div class="form-group">
      <label for="city">City</label>
      <input v-model="formData.city" type="text" class="form-control" id="city" required />
    </div>

    <div class="form-group">
      <label for="postcode">Postcode</label>
      <input v-model="formData.postcode" type="text" class="form-control" id="postcode" required />
    </div>

    <div class="form-group">
      <label for="status">Status</label>
      <select v-model="formData.status" class="form-control" id="status">
        <option value="Pending">Pending</option>
        <option value="Active">Active</option>
        <option value="Disabled">Disabled</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>
<style scoped>
.modal {
  background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
form {
    border: 1px solid;
    padding: 30px;
    margin: 20px 10px;
}

form .form-group {
    padding: 10px;
}

form .form-group label {
    width: 200px;
    display: inline-block;
}
.alert {
    border: 1px solid;
    padding: 10px;
    margin: 10px 0px;
    color: #fff;
}
.alert-denger{
  background: #c73838b3;
}
.alert-success{
  background: #4caf50;
}
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
</style>