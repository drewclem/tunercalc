<script setup lang="ts">
import Stack from '@/components/stencil/Stack.vue';

interface Props {
    title: string;
    description: string;
}

defineProps<Props>();
</script>

<template>
    <div>
        <Stack>
            <div>
                <p>icon</p>
                <Stack>
                    <h3>Title</h3>
                    <p>Description</p>
                </Stack>
            </div>

            <ul>
                <li>
                    <p>Item 1</p>
                </li>
            </ul>

            <button>Open Calculator</button>
        </Stack>
    </div>
</template>
