<script setup lang="ts">
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import { ChevronDown } from 'lucide-vue-next';

interface Props {
    question: string;
    answer: string;
}

defineProps<Props>();
</script>

<template>
    <Collapsible>
        <CollapsibleTrigger
            class="flex w-full items-center justify-between border border-primary p-4 text-left font-medium transition-colors hover:bg-muted/50 dark:border-primary-foreground/20"
            #default="{ open }"
        >
            <span>{{ question }}</span>
            <ChevronDown class="h-4 w-4 text-muted-foreground transition-transform duration-300" :class="{ 'rotate-180': open }" />
        </CollapsibleTrigger>
        <CollapsibleContent>
            <div class="px-4 pt-2 pb-4">
                <p class="text-sm text-muted-foreground">{{ answer }}</p>
            </div>
        </CollapsibleContent>
    </Collapsible>
</template>
