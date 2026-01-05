<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
})

const page = usePage()

const isActive = computed(() => page.url.startsWith(props.href))

const classes = computed(() =>
  [
    'relative inline-flex items-center text-sm font-medium transition-all duration-300',
    'after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:bg-blue-600 after:transition-all after:duration-300',

    isActive.value
      ? 'text-blue-600 after:w-full'
      : 'text-gray-600 hover:text-blue-600 after:w-0 hover:after:w-full',
  ].join(' ')
)
</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
