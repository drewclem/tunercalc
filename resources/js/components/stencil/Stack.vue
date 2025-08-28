<script setup lang="ts">
import { computed } from 'vue';

type SpaceSize = 'none' | 'xxsmall' | 'xsmall' | 'small' | 'default' | 'medium' | 'large' | 'xlarge' | 'xxlarge';

interface Props {
    space?: SpaceSize;
    as?: string;
}

const props = withDefaults(defineProps<Props>(), {
    space: 'default',
    as: 'div',
});

const spaceClasses = computed(() => {
    return {
        'space-y-0': props.space === 'none',
        'space-y-0.5': props.space === 'xxsmall',
        'space-y-1': props.space === 'xsmall',
        'space-y-2': props.space === 'small',
        'space-y-4': props.space === 'medium',
        'space-y-6': props.space === 'default',
        'space-y-8': props.space === 'large',
        'space-y-12': props.space === 'xlarge',
        'space-y-16': props.space === 'xxlarge',
    };
});
</script>

<template>
    <component :is="as" class="flex flex-col" :class="spaceClasses">
        <slot />
    </component>
</template>
