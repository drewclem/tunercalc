<script setup lang="ts">
import { inject } from 'vue';

interface CollapsibleContext {
    toggle: () => void;
    open: boolean;
}

const collapsible = inject<CollapsibleContext>('collapsible');

if (!collapsible) {
    throw new Error('CollapsibleTrigger must be used within a Collapsible component');
}

const { toggle, open } = collapsible;
</script>

<template>
    <button type="button" @click="toggle" class="w-full bg-white dark:bg-primary">
        <slot :open="open" />
    </button>
</template>
