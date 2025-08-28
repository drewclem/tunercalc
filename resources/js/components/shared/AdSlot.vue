<script setup lang="ts">
import { ref } from 'vue';

interface Props {
    type: 'leaderboard' | 'rectangle' | 'banner';
    className?: string;
    label: string;
}

withDefaults(defineProps<Props>(), {
    className: '',
});

const dimensions = {
    leaderboard: '728x90',
    rectangle: '300x250',
    banner: '468x60',
};

const height = {
    leaderboard: 'h-20',
    rectangle: 'h-48',
    banner: 'h-16',
};

const maxWidth = {
    leaderboard: '728px',
    rectangle: '300px',
    banner: '468px',
};

const show = ref(false);
</script>

<template>
    <div v-if="show" :class="`text-center text-sm text-muted-foreground ${className}`">
        <div class="mx-auto max-w-7xl">
            <div :class="`bg-border ${height[type]} mx-auto flex items-center justify-center`" :style="{ maxWidth: maxWidth[type] }">
                [{{ dimensions[type] }} {{ type.charAt(0).toUpperCase() + type.slice(1) }} Ad]
            </div>
        </div>
    </div>
</template>
