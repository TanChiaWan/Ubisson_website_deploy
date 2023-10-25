<template>
  
<div class="col-lg-4"  v-for="group in practice_groups" :key="group.practice_group_id">
  <a :href="`${myAboutPatientRoute}/${group.practice_group_id}-${group.organizationid_FK}`" style="text-decoration: none; color: inherit;">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6 groupname" style="padding-right: 0;">
            <b><h6>{{ group.name }}</h6></b>
          </div>
           <div class="col-md-6 text-end">
            
              <i class="ti ti-stethoscope ms-2 me-2" style="margin: 0 5px;"></i>{{ displayOrganization2(group) }}
              <i class="ti ti-user ms-2 me-2" style="margin: 0 5px;"></i>{{ displayOrganization(group) }}
            </div>
          </div>

        <hr style="background-color: #707070; ">
        <p class="text-center">Average {{ calculateAverageMmolPerL(group) }} mmol/L</p>
       <div class="row text-center">
          <div class="col-md-6 low_event_color">{{displayCount1(group)}}</div>
          <div class="col-md-6 high_event_color">{{displayCount2(group)}}</div>
        </div>
      </div>
    </div>
    </a>
  </div>

</template>


<script>
export default {
  props: {
    practice_groups: {
      type: Array,
      default: () => [],
    },
    patientingroup: {
      type: Array,
      default: () => [],
    },
    professionalingroup: {
      type: Array,
      default: () => [],
    },
    patient: {
      type: Array,
      default: () => [],
    },
    logbook:{
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      myAboutPatientRoute: '/praticegroupdetails',
  
    };
  },
  methods: {
    calculateAverageMmolPerL(group) {
    let totalBgLevel = 0;
    let count = 0;

    for (let i = 0; i < this.patientingroup.length; i++) {
      const patientGroup = this.patientingroup[i];
      if (
        patientGroup.group_id === group.practice_group_id

      ) {
        
        const logbook = this.logbook.find(
          log => log.patient_id_FK === patientGroup.patient_id
          
        );
     
        if (logbook && logbook.bg_level) {
          const bg_level = parseFloat(logbook.bg_level);

          totalBgLevel += bg_level;
      
          count++;
        }
      }
    }
 // Log the value of totalBgLevel

    if (count === 0) {
      return 0; // Handle the case when no matching items are found
    }

    const average = totalBgLevel / count;
    return average.toFixed(2); // Return average with 2 decimal places
  },
},

  computed: {
    displayOrganization() {
    return function(group) {
      let patientingroupCount = 0;
      for (let i = 0; i < this.patientingroup.length; i++) {
        if (this.patientingroup[i].group_id === group.practice_group_id) {
          patientingroupCount++;
        }
      }
      return patientingroupCount;
    };
  },
  displayOrganization2() {
    return function(group) {
      let professionalingroupCount = 0;
      for (let i = 0; i < this.professionalingroup.length; i++) {
        if (this.professionalingroup[i].group_id === group.practice_group_id) {
          professionalingroupCount++;
        }
      }
      return professionalingroupCount;
    };
  },
  displayCount1() {
  return (group) => {
    let dangerLowTotal = 0;
    for (let i = 0; i < this.patientingroup.length; i++) {
      if (
        this.patientingroup[i].group_id === group.practice_group_id &&
        this.patientingroup[i].patient_id
      ) {
      
        const patient = this.patient[i];
        if (patient && patient.dangerLow) {
          dangerLowTotal += patient.dangerLow;
        }
      }
    }
    return dangerLowTotal;
  };
},
    
displayCount2() {
  return (group) => {
    let dangerHighTotal = 0;
    for (let i = 0; i < this.patientingroup.length; i++) {
      if (
        this.patientingroup[i].group_id === group.practice_group_id &&
        this.patientingroup[i].patient_id
      ) {
        
        const patient = this.patient[i];
        if (patient && patient.dangerHigh) {
          dangerHighTotal += patient.dangerHigh;
        }
      }
    }
    return dangerHighTotal;
  };
},

  }
};
</script>