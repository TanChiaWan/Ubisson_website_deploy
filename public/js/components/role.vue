<template>
    <div>
      <h1 class="title">All Roles</h1>
      <p class="subtitle">{{ filteredUsersCount }} Roles</p>
  
      <div class="search_block">
        <p class="search_label">
          Search:
          <input
            type="text"
            class="search_textfield"
            placeholder="Search by Name, Organization, etc"
            v-model="searchTerm"
          />
        </p>
      </div>
  
      <div class="table_wrapper">
        <table id="all_role_table">
          <tr>
            <th>Name</th>
            <th>Organization</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
          </tr>
          <tr v-for="role in displayedRoles" :key="role.id">
            <td>{{ role.name }}</td>
            <td>{{ displayOrganization(role) }}</td>
            <td>{{ role.created_at }}</td>
            <td>{{ role.updated_at }}</td>
            <td>
              <a :href="`${editroute}/${role.id}`"><i class="fa fa-eye"></i></a>
            </td>
          </tr>
        </table>
      </div>
  
      <div class="pagination_block">
        <button @click="previousPage" :disabled="currentPage === 1">Prev</button>
        <span>
          <!-- Display each page number as a button -->
          <button
            v-for="page in getPageNumber()"
            :key="page"
            @click="goToPage(page)"
            :class="{ active: page === currentPage }"
          >
            {{ page }}
          </button>
        </span>
        <button @click="nextPage" :disabled="currentPage === getPageNumber()">Next</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      roles: {
        type: Array,
        default: () => [],
      },
      organizations: {
        type: Array,
        default: () => [],
      },
    },
    data() {
      return {
        editroute: '/editrole',
        searchTerm: '',
        perPage: 5,
        currentPage: 1,
      };
    },
    computed: {
      displayOrganization() {
    const self = this;
    return function(role) {
      const organization = self.organizations.find(org => org.organizationid === role.organizationid);
      return organization ? organization.organization_name : '';
    };
  },
  

        filteredRoles() {
    const searchTerm = this.searchTerm.toLowerCase();
    this.currentPage = 1;
    return this.roles.filter((role) => {
      const nameMatch = role.name.toLowerCase().includes(searchTerm);
      const organizationMatch = this.displayOrganization(role).toLowerCase().includes(searchTerm);
      const createdDateMatch = role.created_at.toLowerCase().includes(searchTerm);
      const updatedDateMatch = role.updated_at.toLowerCase().includes(searchTerm);
      return nameMatch || organizationMatch || createdDateMatch || updatedDateMatch;
    });
      },
      filteredUsersCount() {
  return this.filteredRoles.length;
},
      displayedRoles() {
        const start = (this.currentPage - 1) * this.perPage;
        const end = start + this.perPage;
        return this.filteredRoles.slice(start, end);
      },
    },
    methods: {
      getPageNumber() {
        return Math.ceil(this.filteredRoles.length / this.perPage);
      },
      previousPage() {
        if (this.currentPage > 1) {
          this.currentPage--;
          if (this.searchTerm) {
            this.search();
          }
        }
      },
      goToPage(page) {
        if (this.currentPage !== page) {
          this.currentPage = page;
          if (this.searchTerm) {
            this.filteredRoles = this.filteredRoles.slice(); // Trigger reactivity
          }
        }
      },
      nextPage() {
        if (this.currentPage < this.getPageNumber()) {
          this.currentPage++;
          if (this.searchTerm) {
            this.search();
          }
        }
      },
    },
  };
  </script>
  
  <style>
  .title {
    overflow: hidden; /* Hide the overflowing content */
    text-overflow: ellipsis; 

    white-space: nowrap; /* Prevent line breaks */
  }
  </style>