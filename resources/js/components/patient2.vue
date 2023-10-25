<template>
  <div>
    <p class="subtitle2">{{ filteredUsersCount }} Patients</p>
    <div class="search_block">
      <p class="search_label">
        Search:
        <input
          type="text"
          class="search_textfield"
          placeholder="Search by Name, Age, etc"
          v-model="searchTerm"
        />
      </p>
    </div>

    <div class="table_wrapper">
      <table id="all_role_table">
        <tr>
          <th>Name</th>
          <th>Age</th>
          <th>Mobile Phone</th>
        </tr>

        <tr v-for="patient in displayedUsers" :key="patient.id">
          <td>{{ patient.patient_name }}</td>
          <td>{{ patient.patient_age }}</td>
          <td>+{{ patient.patient_phonenum }}</td>
          <!-- Add the remaining table cells for other patient information -->
        </tr>
      </table>
    </div>

    <div class="pagination_block">
      <button @click="previousPage" :disabled="currentPage === 1">Prev</button>
      <span>
        <!-- Display each page number as a button -->
        <button
          v-for="page in getPageNumbers()"
          :key="page"
          @click="goToPage(page)"
          :class="{ active: page === currentPage }"
        >
          {{ page }}
        </button>
      </span>
      <button @click="nextPage" :disabled="currentPage === getPageNumber().length">Next</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    patients: {
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
      return this.patients.filter((patient) => {
        const nameMatch = patient.patient_name.toLowerCase().includes(searchTerm);
        const ageMatch = patient.patient_age.toString().toLowerCase().includes(searchTerm);
        return nameMatch || ageMatch;
      });
    },
    filteredUsersCount() {
      return this.filteredUsers.filter((patient) => patient.organization_name == null).length;
    },
    displayedUsers() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      const filteredPatients = this.filteredUsers.filter((patient) => patient.organization_name == null);
      return filteredPatients.slice(start, end); // Display only the first page of filtered users
    },
  },
  methods: {
    getPageNumbers() {
      const filteredPatients = this.filteredUsers.filter((patient) => patient.organization_name == null);
      const totalPatients = filteredPatients.length;
      const totalPages = Math.ceil(totalPatients / this.perPage);
      const maxPageNumbers = 5; // Maximum number of page numbers to display
      const currentPageIndex = this.currentPage - 1;
      const pageNumbers = [];

      if (totalPages <= maxPageNumbers) {
        // If total pages is less than or equal to maxPageNumbers, display all page numbers
        for (let i = 1; i <= totalPages; i++) {
          pageNumbers.push(i);
        }
      } else {
        // If total pages is greater than maxPageNumbers, display a subset of page numbers
        const middlePageIndex = Math.floor(maxPageNumbers / 2);
        const startPageIndex = currentPageIndex - middlePageIndex;
        const endPageIndex = currentPageIndex + (maxPageNumbers - middlePageIndex - 1);

        if (startPageIndex <= 0) {
          // If the current page is near the beginning, display the first maxPageNumbers pages
          for (let i = 1; i <= maxPageNumbers; i++) {
            pageNumbers.push(i);
          }
        } else if (endPageIndex >= totalPages - 1) {
          // If the current page is near the end, display the last maxPageNumbers pages
          for (let i = totalPages - maxPageNumbers + 1; i <= totalPages; i++) {
            pageNumbers.push(i);
          }
        } else {
          // Display a subset of page numbers around the current page
          for (let i = startPageIndex + 1; i <= endPageIndex + 1; i++) {
            pageNumbers.push(i);
          }
        }
      }

      return pageNumbers;
    },
    getPageNumber() {
  const filteredPatients = this.filteredUsers.filter((patient) => patient.organization_name == null);
  const totalPatients = filteredPatients.length;
  
  const totalPages = Math.ceil(totalPatients / this.perPage);
  return totalPages; // Return the minimum value between maxPageNumbers and totalPages
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
      const totalPages = this.getPageNumber();
  if (this.currentPage < totalPages) {
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
