<template>
  <h1>Index</h1>
  <text>The message is: {{ message }}</text>
</template>

<script setup>
  defineProps({
    message: String
  })
</script>
