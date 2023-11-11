<script setup>
defineProps ({
  chartOptions: Object,
  series: Object
})


</script>

<template>
  <apexchart type="pie" :options="chartOptions" :series="series"></apexchart>
</template>
