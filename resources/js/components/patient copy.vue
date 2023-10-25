<template>
  <div>
   
   
   <p class="subtitle2">{{ filteredUsersCount }}  Patients</p>
 
                       
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
                                        <th>Age</th>
                                        <th>Diabetes Type</th>
                                        <th>Last Recorded</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    
                                    <tr v-for="patient in displayedUsers" :key="patient.id" >
  <td>{{ patient.patient_name }}</td>
  <td>{{ patient.organization_name }}</td>
  <td>{{ patient.patient_age }}</td>
  <td>{{ patient.diabetes_type }}</td>
  <td>{{ patient.date_of_diagnosis }}</td>
  <!-- Add the remaining table cells for other patient information -->


          
          <td><img src= "images/activeMobileAccount.png"></td>
          <a :href="`${myAboutPatientRoute}/${patient.patient_id}`">
  <td>
    <p><i class="fa fa-eye"></i></p>
  
  </td>
</a>

          
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
    patients: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      myAboutPatientRoute: '/aboutpatient',
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
    const organizationMatch = patient.organization_name !== null && patient.organization_name.toLowerCase().includes(searchTerm);
    const roleMatch = patient.diabetes_type.toLowerCase().includes(searchTerm);
    const ageMatch = patient.patient_age.toString().toLowerCase().includes(searchTerm); // Convert patient_age to string before applying toLowerCase()
    const dateMatch = patient.date_of_diagnosis.toLowerCase().includes(searchTerm);
    return nameMatch || organizationMatch || roleMatch || dateMatch || ageMatch;
  });
},
filteredUsersCount() {
      return this.filteredUsers.filter((patient) => patient.organization_name !== null).length;
    },
    displayedUsers() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      const filteredPatients = this.filteredUsers.filter((patient) => patient.organization_name !== null);
      return filteredPatients.slice(start, end); // Display only the first page of filtered users
      
    },
  },
  methods: {
    getPageNumber() {
      const filteredPatients = this.filteredUsers.filter((patient) => patient.organization_name !== null);
      const totalPatients = filteredPatients.length;
      return Math.ceil(totalPatients / this.perPage);
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
