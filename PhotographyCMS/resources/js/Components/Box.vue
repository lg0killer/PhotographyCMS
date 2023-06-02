<template>
  <div class="border m-4 border-gray-100 dark:border-gray-700 rounded-md p-4 shadow-sm dark:text-gray-300 bg-gray-100 dark:bg-gray-700">
    <div class="text-gray-500 font-medium">
      <slot name="header" />
    </div>
    <slot/>
  </div>
</template>
