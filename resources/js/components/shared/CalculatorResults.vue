<script setup lang="ts">
import Stack from '@/components/stencil/Stack.vue';

interface ResultItem {
    label: string;
    value: string | number;
    unit?: string;
    highlight?: boolean;
}

interface Props {
    title: string;
    results: ResultItem[];
    recommendation?: {
        icon?: string;
        title: string;
        message: string;
    };
}

defineProps<Props>();
</script>

<template>
    <div class="border border-primary bg-muted p-4 dark:bg-muted">
        <Stack space="small">
            <h3 class="text-lg font-medium">{{ title }}</h3>
            <Stack space="xsmall">
                <p v-for="result in results" :key="result.label">
                    {{ result.label }}:
                    <span class="ml-2 font-semibold text-primary" :class="{ 'text-xl': result.highlight }">
                        {{ result.value }}{{ result.unit ? ' ' + result.unit : '' }}
                    </span>
                </p>
            </Stack>

            <div v-if="recommendation" class="mt-4 border border-primary bg-primary/10 p-3">
                <Stack space="xsmall">
                    <p class="font-medium">{{ recommendation.icon || '💡' }} {{ recommendation.title }}:</p>
                    <p class="text-sm">{{ recommendation.message }}</p>
                </Stack>
            </div>
        </Stack>
    </div>
</template>
