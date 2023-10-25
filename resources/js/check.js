const app = new Vue({
    el: '#app',
    data: {
      selectedRole: '',
      permissions: [
        {
          title: 'Audit',
          roles: ['Super_Admin', 'Professional'],
          checkboxes: [
            { name: 'view_logs', value: 'view_logs', label: 'View Logs', checked: true },
          ]
        },
        {
          title: 'Message',
          roles: ['Super_Admin', 'Professional'],
          checkboxes: [
            { name: 'view_message', value: 'view_message', label: 'View Message', checked: true },
            { name: 'send_message', value: 'send_message', label: 'Send Message', checked: true },
          ]
        },
        {
          title: 'Broadcast Message',
          roles: ['Super_Admin', 'Hospital_Admin'],
          checkboxes: [
            { name: 'view_broadcastmessage', value: 'view_broadcastmessage', label: 'View Broadcast Message', checked: true },
            { name: 'send_broadcastmessage', value: 'send_broadcastmessage', label: 'Send Broadcast Message', checked: true },
            { name: 'edit_broadcastmessage', value: 'edit_broadcastmessage', label: 'Edit Broadcast Message', checked: true },
          ]
        },
        {
          title: 'Outlet Management',
          roles: ['Outlet_admin'],
          checkboxes: [
            { name: 'view_outlet', value: 'view_outlet', label: 'View Outlet', checked: true },
            { name: 'add_outlet', value: 'add_outlet', label: 'Add Outlet', checked: true },
            { name: 'edit_outlet', value: 'edit_outlet', label: 'Edit Outlet', checked: true },
            { name: 'delete_outlet', value: 'delete_outlet', label: 'Delete Outlet', checked: true },
          ]
        }
      ]
    },
    computed: {
      filteredPermissions() {
        return this.permissions.filter(permission => {
          return permission.roles.includes(this.selectedRole)
        })
      }
    }
  })