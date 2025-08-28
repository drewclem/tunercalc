<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { cn } from '@/lib/utils'

const props = defineProps<{
  class?: HTMLAttributes['class']
}>()
</script>

<template>
  <div
    data-slot="card"
    :class="
      cn(
        'heist-glow bg-card text-card-foreground flex flex-col   border border-primary py-6',
        props.class,
      )
    "
  >
    <slot />
  </div>
</template>
