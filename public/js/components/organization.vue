<template>
  <div>
    <h1 class="title">All Organizations</h1>
    <p class="subtitle">{{ filteredUsersCount }} Organizations</p>

    <div class="search_block">
      <p class="search_label">
        Search:
        <input
          type="text"
          class="search_textfield"
          placeholder="Search by Name, ID ,etc"
          v-model="searchTerm"
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
        <tr v-for="organization in displayedOrganizations" :key="organization.organizationid">
          <td>{{ organization.organizationid }}</td>
          <td>{{ organization.organization_name }}</td>
          <td>http:/{{ organization.customized_login_url }}</td>
          <td>{{ organization.administrator_name }}</td>
          <td> 
            <a :href="`${myAboutPatientRoute}/${organization.organizationid}`">
          <td>
            <p><i class="fa fa-eye"></i></p>
          
          </td>
        </a></td>
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
    organizations: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      myAboutPatientRoute: '/updateorganization',
      searchTerm: '',
      perPage: 5,
      currentPage: 1,
    };
  },
  computed: {
    filteredOrganizations() {
      const searchTerm = this.searchTerm.toLowerCase();
      this.currentPage = 1;
      return this.organizations.filter((organization) =>
        organization.organization_name.toLowerCase().includes(searchTerm) ||
        organization.organizationid.toString().includes(searchTerm) ||
        organization.administrator_name.toLowerCase().includes(searchTerm) ||
        organization.customized_login_url.toLowerCase().includes(searchTerm)
      );
    },
    filteredUsersCount() {
  return this.filteredOrganizations.length;
},
    displayedOrganizations() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      return this.filteredOrganizations.slice(start, end);
    },
  },
  methods: {
    getCustomLoginUrl(organizationid) {
    return `/14.167.2.15/${organizationid}`;
  },
    getPageNumber() {
      return Math.ceil(this.filteredOrganizations.length / this.perPage);
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
        this.filteredOrganizations = this.filteredOrganizations.slice(); // Trigger reactivity
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
  text-overflow: ellipsis; /* Truncate the text if it exceeds the container width */
  white-space: nowrap; /* Prevent line breaks */
}
</style>
