<template>
  <div>
    <table>
    <thead class='tablehead'>
      <tr>
        <th>Date</th>
        <th>Period</th>
        <th>More Info</th>
      </tr>
      </thead>
       <tbody class='tablebody'>
      <tr v-for="logbook in logbooks" :key="logbook.logbook_id">
        <td>{{ logbook.bg_logbook_date }}</td>
        <td>{{ logbook.bg_period }}</td>
        <td>
          <router-link :to="{ path: '/BG/' + BG.date }">Show Detail</router-link>
        </td>
      </tr>
      </tbody>
    </table>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  props: {
    logbook: {
      type: Array,
      default: () => [],
    },
  },
  
};
</script>
