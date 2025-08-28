<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppHeader from '@/components/AppHeader.vue';
import AppFooter from '@/components/ui/AppFooter.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <div class="relative flex min-h-screen flex-col">
        <AppHeader :breadcrumbs="breadcrumbs" />

        <AppContent class="flex-1">
            <slot />
        </AppContent>

        <AppFooter />
    </div>
</template>
