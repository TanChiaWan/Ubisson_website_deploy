<template>

  
      <div class="table-responsive table" style="overflow-y: hidden;">
                    <table class="table text-nowrap mb-0 align-middle datatable">
                      <thead class="text-dark fs-4">
                        <tr style="background-color: #7ecbcc;">
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Name</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Organization</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Organization Status</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Age</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Diabetes Type</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Last Record</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Action</h6>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="patient in displayedUsers" :key="patient.id" >
                          <td class="border-bottom-0"><p class="mb-0 fw-normal">{{ patient.patient_name }}</p></td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ patient.organization_name }}</p>                    
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">Yes</p>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ patient.patient_age }}</p>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ patient.diabetes_type }}</p>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ patient.date_of_diagnosis }}</p>
                          </td>
                          <td class="border-bottom-0">
                            <a :href="`${myAboutPatientRoute}/${patient.patient_id}`" class="text-center"><i class="ti ti-eye"></i></a>
                          </td>
                        </tr> 
                       
                                                       
                      </tbody>
                    </table>
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
