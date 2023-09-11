<template>
  <header class="border-b border-gray-200 bg-gray-100 dark:border-gray-700 dark:bg-gray-800 w-screen">
    <div class="container mx-auto">
      <nav class="p-4 flex items-center justify-between">
        <div class="text-lg font-medium">
          <Link href="/">FStop Photography</Link>
        </div>
        <div v-if="user" class="text-lg font-medium">
          <Link :href="route('user.photo.index')">My Photos</Link>
        </div>
        <div v-if="user" class="flex items-center gap-4">
          <Link :href="route('photo.create')" class="btn-primary">+ New Photo</Link>
          <div class="text-gray-500 hover:text-gray-100">
            <Link :href="route('user-account.edit')">{{ user.name }}</Link>
          </div>
          <div class="text-gray-500 hover:text-gray-100">
            <Link :href="route('logout')">Logout</Link>
          </div>
        </div>
        <div v-else class="flex items-center gap-2">
          <Link :href="route('user-account.create')">Register</Link>
          <Link :href="route('login')">Login</Link>
        </div>
      </nav>
    </div>
  </header>

  <main class="container mx-auto p-4 w-full">
    <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
      {{ flashSuccess }}
    </div> 
    <slot></slot>
  </main>


</template>

<script setup>
import { computed,ref } from 'vue'
import { Link,usePage } from '@inertiajs/vue3'
import ApplicationMark from '@/Components/UI/ApplicationMark.vue'
import Banner from '@/Components/UI/Banner.vue'
import Dropdown from '@/Components/UI/Dropdown.vue'
import DropdownLink from '@/Components/UI/DropdownLink.vue'
import NavLink from '@/Components/UI/NavLink.vue'
import ResponsiveNavLink from '@/Components/UI/ResponsiveNavLink.vue'

defineProps({
  title: String
})

const showingNavigationDropdown = ref(false)
const logout = () => {
  router.post(route('logout'))
}

const page = usePage()
const flashSuccess = computed(() => page.props.flash.success)
const user = computed(() => page.props.user)
</script>
