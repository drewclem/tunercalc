<script setup lang="ts">
import { computed, provide, ref } from 'vue';

interface Props {
    open?: boolean;
    defaultOpen?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    open: undefined,
    defaultOpen: false,
});

const emit = defineEmits<{
    'update:open': [value: boolean];
}>();

const isOpen = ref(props.defaultOpen);

const updateOpen = (value: boolean) => {
    if (props.open !== undefined) {
        emit('update:open', value);
    } else {
        isOpen.value = value;
    }
};

const toggle = () => {
    updateOpen(!(props.open ?? isOpen.value));
};

const openState = computed(() => props.open ?? isOpen.value);

provide('collapsible', {
    open: openState,
    toggle,
    updateOpen,
});
</script>

<template>
    <div class="dark:border-primary-foreground/20">
        <slot />
    </div>
</template>

