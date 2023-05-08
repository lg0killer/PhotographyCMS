<template>
  <Link href="/">Main Page</Link>&nbsp;
  <Link href="/hello">Hello Page</Link>

  <slot></slot>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>
