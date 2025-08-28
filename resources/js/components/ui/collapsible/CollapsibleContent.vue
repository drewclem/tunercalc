<script setup lang="ts">
import { inject, nextTick, onMounted, ref, watch } from 'vue';

interface CollapsibleContext {
    toggle: () => void;
    open: boolean;
}

const collapsible = inject<CollapsibleContext>('collapsible');

if (!collapsible) {
    throw new Error('CollapsibleContent must be used within a Collapsible component');
}

const { open } = collapsible;
const contentRef = ref<HTMLDivElement>();
const contentHeight = ref(0);

const updateHeight = async () => {
    if (contentRef.value) {
        await nextTick();
        const height = contentRef.value.scrollHeight;
        contentHeight.value = height;
        contentRef.value.style.setProperty('--reka-collapsible-content-height', `${height}px`);
    }
};

onMounted(() => {
    updateHeight();
});

watch(() => open, (isOpen) => {
    if (isOpen) {
        updateHeight();
    }
});

// Watch for content changes
const observer = ref<ResizeObserver>();

onMounted(() => {
    if (contentRef.value) {
        observer.value = new ResizeObserver(() => {
            if (open) {
                updateHeight();
            }
        });
        observer.value.observe(contentRef.value);
    }
});
</script>

<template>
    <div
        ref="contentRef"
        :data-state="open ? 'open' : 'closed'"
        class="CollapsibleContent overflow-hidden border border-t-0 dark:border-primary-foreground/20 bg-white dark:bg-card"
        :class="{'py-2 border-primary': open, 'border-transparent': !open}"
        :style="{ 
            height: open ? `${contentHeight}px` : '0px'
        }"
    >
        <slot />
    </div>
</template>


<style scoped>
.CollapsibleContent {
    overflow: hidden;
}

.CollapsibleContent[data-state="open"] {
    animation: slideDown 300ms ease-out;
}

.CollapsibleContent[data-state="closed"] {
    animation: slideUp 300ms ease-out;
}

@keyframes slideDown {
    from {
        height: 0;
    }
    to {
        height: var(--reka-collapsible-content-height);
    }
}

@keyframes slideUp {
    from {
        height: var(--reka-collapsible-content-height);
    }
    to {
        height: 0;
    }
}
</style>
