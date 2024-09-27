<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';

// Success and error messages
const errors = ref('');
const successMessage = ref('');

// Props passed from the parent
const props = defineProps(['manager']);
const emit = defineEmits(['close', 'refresh']);
// Reactive form data
const form = ref({
  first_name: '',
  last_name: '',
  email: '',
  role: 'Editor',
  status: 'Pending',
});
console.log(props);

// State to track if we are editing a manager
const editing = ref(false);
// Watch for changes in the passed manager prop
watch(() => props.manager, (newManager) => {
  console.log(props);  
  if (newManager) {
    editing.value = true; // Set editing state to true
    form.value = { ...newManager }; // Populate form with manager data
  } else {
    resetForm(); // Reset the form if no manager is passed
  }
});

// Function to handle form submission
const handleSubmit = async () => {
    // Clear previous error and success messages
  errors.value = '';
  successMessage.value = '';
  try {
    if (editing.value) {
      await axios.put(`/v1/managers-api/${form.value.id}`, form.value)
    } else {
      await axios.post('/v1/managers-api', form.value); // Add new manager
    }
    successMessage.value = formData.value.id ? 'Installer updated successfully!' : 'Installer added successfully!';
    emit('refresh'); // Emit refresh event to parent
    emit('close'); // Close the modal
    resetForm(); // Reset the form for next use
  } catch (error) {
    if (error.response && error.response.status === 400) {
      // Handle validation errors
      errors.value = error.response.data.error ? error.response.data.error : 'Something was wrong.';
    } else {
      console.error('Error during form submission:', error);
    }
    console.error("There was an error saving the manager!", error);
  }
};

// Function to reset the form
const resetForm = () => {
  form.value = { 
    first_name: '', 
    last_name: '', 
    email: '', 
    role: 'Editor', 
    status: 'Pending' 
  }; // Clear form fields
  editing.value = false; // Reset editing state
};
</script>
<template>
  <div class="modal">
      <!-- Success and Error Messages (Above Form) -->
    <form @submit.prevent="handleSubmit">
      <div class="form-group">
        <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
        <div v-if="errors" class="alert alert-denger">{{ errors }}</div>
      </div>
      <h2>{{ editing ? 'Edit Manager' : 'Add Manager' }}</h2>
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" v-model="form.first_name" required />
      </div>
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" v-model="form.last_name" required />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" v-model="form.email" required />
      </div>
      <div class="form-group">
        <label for="role">Role</label>
        <select v-model="form.role" required>
          <option value="Editor">Editor</option>
          <option value="Administrator">Administrator</option>
        </select>
      </div>
      <div class="form-group">
        <label for="status">Status</label>
        <select v-model="form.status" required>
          <option value="Pending">Pending</option>
          <option value="Active">Active</option>
          <option value="Disabled">Disabled</option>
        </select>
      </div>
      <button type="submit" class="btn">{{ editing ? 'Update' : 'Add' }} Manager</button>
      <button type="button" class="btn" @click="$emit('close')">Cancel</button>
    </form>
  </div>
</template>

<style scoped>
form {
    border: 1px solid;
    padding: 30px;
    background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form .form-group {
    padding: 10px;
}

form label {
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
h2 {
    font-weight: 600;
    font-size: 30px;
    padding: 10px;
}
</style>