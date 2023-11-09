<template>
  <div>
    <h1 class="title">All Users</h1>
    <p class="subtitle">{{ professionals.length.toString() }} Users</p>

    <div class="search_block">
      <p class="search_label">
        Search:
        <input
          type="text"
          class="search_textfield"
          placeholder="Search by Name, ID, etc"
          v-model="searchTerm"
        />
      </p>
    </div>

    <div class="table_wrapper">
      <table id="all_user_table">
        <tr>
          <th>Name</th>
          <th>Account Role</th>
          <th>E-mail Address</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <tr v-for="professional in displayedUsers" :key="professional.id">
          <td>{{ professional.professional_name }}</td>
          <td>{{ professional.professional_account_role }}</td>
          <td>{{ professional.professional_email_address }}</td>
          <td>{{ professional.status }}</td>
          <td>
            <a href="#"><i class="fa fa-eye"></i></a>
            <a href="#"><i class="fa fa-archive" aria-hidden="true"></i></a>
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
    professionals: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      searchTerm: '',
      perPage: 5,
      currentPage: 1,
    };
  },
  computed: {
    filteredUsers() {
  const searchTerm = this.searchTerm.toLowerCase();
  this.currentPage = 1;
  return this.professionals.filter((professional) => {
    const nameMatch = professional.professional_name.toLowerCase().includes(searchTerm);
    const emailMatch = professional.professional_email_address.toLowerCase().includes(searchTerm);
    const roleMatch = professional.professional_account_role.toLowerCase().includes(searchTerm);
    const statusMatch = professional.status.toLowerCase().includes(searchTerm);
    return nameMatch || emailMatch || roleMatch || statusMatch;
  });
},

    displayedUsers() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      return this.filteredUsers.slice(start, end);
    },
  },
  methods: {
    getPageNumber() {
      return Math.ceil(this.filteredUsers.length / this.perPage);
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
          this.filteredUsers = this.filteredUsers.slice(); // Trigger reactivity
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
