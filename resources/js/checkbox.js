const app = new Vue({
    el: '#app',
    data: {
        selectedRole: '',
        permissions: [{
                title: 'Audit',
                roles: ['', 'Super_Admin', 'Outlet_admin'],
                checkboxes: [
                    { name: 'view_logs', value: 'view_logs', label: 'View Logs', checked: true },
                ]
            },
            {
                title: 'Message',
                roles: ['', 'Super_Admin', 'Hospital_Admin', 'Professional', 'Outlet_admin'],
                checkboxes: [
                    { name: 'view_message', value: 'view_message', label: 'View Message', checked: true },
                    { name: 'send_message', value: 'send_message', label: 'Send Message', checked: true },
                    { name: 'view_broadcastmessage', value: 'view_broadcastmessage', label: 'View Broadcast Message', checked: true },
                    { name: 'send_broadcastmessage', value: 'send_broadcastmessage', label: 'Send Broadcast Message', checked: true },
                    { name: 'edit_broadcastmessage', value: 'edit_broadcastmessage', label: 'Edit Broadcast Message', checked: true },
                ]
            },
            {
                title: 'Old Permissions',
                roles: ['', 'Super_Admin', 'Hospital_Admin', 'Professional'],
                checkboxes: [
                    { name: 'internal_patients', value: 'internal_patients', label: 'Internal Patients', checked: true },
                    { name: 'external_patients', value: 'external_patients', label: 'External Patients', checked: true },
                    { name: 'my_organization', value: 'my_organization', label: 'My Organization', checked: true },
                    { name: 'my_organization', value: 'all_organizations', label: 'All Organizations', checked: true },
                    { name: 'my_organization', value: 'modify_roles', label: 'Modify Roles', checked: true },
                ]
            },
            {
                title: 'Organisation',
                roles: ['', 'Super_Admin', 'Hospital_Admin', 'Professional'],
                checkboxes: [
                    { name: 'view_own_organisation', value: 'view_own_organisation', label: 'View Own Organisation', checked: true },
                    { name: 'edit_own_organisation', value: 'edit_own_organisation', label: 'Edit Own Organisation', checked: true },
                    { name: 'view_other_organisation', value: 'view_other_organisation', label: 'View Other Organisation', checked: true },
                    { name: 'edit_other_organisation', value: 'edit_other_organisation', label: 'Edit Other Organisation', checked: true },
                    { name: 'create_organisation', value: 'create_organisation', label: 'Create Organisation', checked: true },
                ]
            },
            {
                title: 'Patient',
                roles: ['', 'Super_Admin', 'Hospital_Admin', 'Professional'],
                checkboxes: [
                    { name: 'view_internal_patient_data', value: 'view_internal_patient_data', label: 'View Internal Patient', checked: true },
                    { name: 'edit_internal_patient', value: 'edit_internal_patient', label: 'Edit Internal Patient', checked: true },
                    { name: 'create_internal_patient', value: 'create_internal_patient', label: 'Create Internal Patient', checked: true },
                    { name: 'view_internal_patient_data', value: 'view_internal_patient_data', label: 'View Internal Patient Data', checked: true },
                    { name: 'create_internal_patient_data', value: 'create_internal_patient_data', label: 'Create Internal Patient Data', checked: true },
                    { name: 'edit_internal_patient_data', value: 'edit_internal_patient_data', label: 'Edit Internal Patient Data', checked: true },
                    { name: 'disable_internal_patient', value: 'disable_internal_patient', label: 'Disable Internal Patient', checked: true },
                    { name: 'view_external_patient', value: 'view_external_patient', label: 'View External Patient', checked: true },
                    { name: 'edit_external_patient', value: 'edit_external_patient', label: 'Edit External Patient', checked: true },
                    { name: 'create_external_patient', value: 'create_external_patient', label: 'Create External Patient', checked: true },
                    { name: 'view_external_patient_data', value: 'view_external_patient_data', label: 'View External Patient Data', checked: true },
                    { name: 'create_external_patient_data', value: 'create_external_patient_data', label: 'Create External Patient Data', checked: true },
                    { name: 'edit_external_patient_data', value: 'edit_external_patient_data', label: 'Edit External Patient Data', checked: true },
                    { name: 'disable_external_patient', value: 'disable_external_patient', label: 'Disable External Patient', checked: true },
                    { name: 'view_hyper_event', value: 'view_hyper_event', label: 'View Hyper Event', checked: true },
                    { name: 'view_hypo_event', value: 'view_hypo_event', label: 'View Hypo Event', checked: true },
                    { name: 'view_appointment', value: 'view_appointment', label: 'View Appointment', checked: true },
                    { name: 'create_appointment', value: 'create_appointment', label: 'Create Appointment', checked: true },
                    { name: 'edit_appointment', value: 'edit_appointment', label: 'Edit Appointment', checked: true },
                    { name: 'delete_appointment', value: 'delete_appointment', label: 'Delete Appointment', checked: true },
                    { name: 'add_patient_from_app', value: 'add_patient_from_app', label: 'Add Patient From App', checked: true },
                    { name: 'merge_patient_account', value: 'merge_patient_account', label: 'Merge Patient Account', checked: true },
                ]
            },
            {
                title: 'Practice Group',
                roles: ['', 'Super_Admin', 'Hospital_Admin', 'Professional', 'Outlet_admin'],
                checkboxes: [
                    { name: 'create_practice_group', value: 'create_practice_group', label: 'Create Practice Group', checked: true },
                    { name: 'view_practice_group', value: 'view_practice_group', label: 'View Practice Group', checked: true },
                    { name: 'edit_practice_group', value: 'edit_practice_group', label: 'Edit Practice Group', checked: true },
                    { name: 'delete_practice_group', value: 'delete_practice_group', label: 'Delete Practice Group', checked: true },
                    { name: 'add_patient_to_group', value: 'add_patient_to_group', label: 'Add Patient To Group', checked: true },
                    { name: 'add_professional_to_group', value: 'add_professional_to_group', label: 'Add Professional To Group', checked: true },
                ]
            },
            {
                title: 'Roles And Permission',
                roles: ['', 'Super_Admin'],
                checkboxes: [
                    { name: 'view_roles', value: 'view_roles', label: 'View Roles', checked: true },
                    { name: 'edit_roles', value: 'edit_roles', label: 'Edit Roles', checked: true },
                    { name: 'create_roles', value: 'create_roles', label: 'Create Roles', checked: true },
                    { name: 'manage_permissions', value: 'manage_permissions', label: 'Manage Permissions', checked: true },
                ]
            },
            {
                title: 'User',
                roles: ['', 'Super_Admin', 'Hospital_Admin', 'Professional'],
                checkboxes: [
                    { name: 'view_internal_user', value: 'view_internal_user', label: 'View Internal User', checked: true },
                    { name: 'edit_internal_user', value: 'edit_internal_user', label: 'Edit Internal User', checked: true },
                    { name: 'create_internal_user', value: 'create_internal_user', label: 'Create Internal User', checked: true },
                    { name: 'disable_internal_user', value: 'disable_internal_user', label: 'Disable Internal User', checked: true },
                    { name: 'change_user_password', value: 'change_user_password', label: 'Change User Password', checked: true },
                    { name: 'view_external_user', value: 'view_external_user', label: 'View External User', checked: true },
                    { name: 'edit_external_user', value: 'edit_external_user', label: 'Edit External User', checked: true },
                    { name: 'create_external_user', value: 'create_external_user', label: 'Create External User', checked: true },
                    { name: 'disable_external_user', value: 'disable_external_user', label: 'Disable External User', checked: true },
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