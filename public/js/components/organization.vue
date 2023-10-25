<template>
<div>
      <h1>All Organizations</h1>
      <p class="subtitle">{{ organizations.length.toString() }} Organizations</p>

      <div class="search_block">
        <p class="search_label">
          Search:
          <input
            type="text"
            class="search_textfield"
            placeholder="search by name"
            v-model="organization.organization_name"
          />
        </p>
      </div>

      <div class="table_wrapper">
        <table id="all_organization_table">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Customized Login URL</th>
            <th>Admin Name</th>
            <th>Action</th>
          </tr>
          <tr v-for="organization in organizations" :key="organization.organizationid">
            <td>{{ organization.organizationid }}</td>
          <td>{{ organization.organization_name }}</td>
          <td>{{ organization.customized_login_url }}</td>
          <td>{{ organization.administrator_name }}</td>
            <td><a href="#"><i class="fa fa-eye"></i></a></td>
          </tr>
        </table>
      </div>

      
    </div>
  </template>
  
  <script>
  import VuejsPaginate from 'vuejs-paginate';
  export default {
  
    props:{
      organizations:{
        default:[]
      }
    },
    created:function(){
      console.log('this.organizations')
    }
  }
  </script>
  
  