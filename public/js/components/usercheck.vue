<template>
  <div id="app">
    <div class="form-group">
      <select v-model="selectedRole" class="form-control">
        <option value="">Select Role</option>
        <option v-for="role in roles" :key="role" :value="role">{{ role.name }}</option>
      </select>
    </div>
    <div class="form-group">
      <div v-for="(permission) in filteredPermissions" :key="permission.id">
        <h5>{{ permission.title }}</h5>
        <div class="row gy-6">
          <div v-for="(checkbox, index) in permission.checkboxes" :key="index">
            <div class="col-sm-12">
              <label class="checkbox">
                <input type="checkbox" :name="checkbox.name" :value="checkbox.value" v-model="checkbox.checked">{{ checkbox.label }}
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    roles: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      selectedRole: '',
      permissions: []
    };
  },
  computed: {
    filteredPermissions() {
      if (!this.selectedRole) {
        return [];
      }
      return this.permissions.filter(permission => {
        return permission.roles.includes(this.selectedRole);
      });
    }
  },
  created() {
    this.fetchPermissions();
  },
  methods: {
    fetchPermissions() {
      axios.get('/api/permissions')
        .then(response => {
          this.permissions = response.data;
        })
        .catch(error => {
          console.error('Error fetching permissions:', error);
        });
    }
  }
};
</script>

<style scoped>
/* Add your custom styles here */
</style>






