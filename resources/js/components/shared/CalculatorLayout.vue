<script setup lang="ts">
import Stack from '@/components/stencil/Stack.vue';
import { Button } from '@/components/ui/button';
import { Card } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import MainLayout from '@/layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';

import FAQItem from '@/components/shared/FAQItem.vue';
import AdSlot from './AdSlot.vue';

interface SelectOption {
    value: string;
    label: string;
}

interface CalculatorField {
    key: string;
    label: string;
    type: 'number' | 'select';
    step?: string;
    placeholder?: number | string;
    min?: number;
    max?: number;
    unit?: string;
    options?: SelectOption[];
    defaultValue?: string;
}

interface FAQItem {
    question: string;
    answer: string;
}

interface Props {
    title: string;
    titleAccent?: string;
    description: string;
    fields: CalculatorField[];
    faqItems: FAQItem[];
    pageTitle?: string;
    calculateButtonText?: string;
    calculatingText?: string;
}

const props = withDefaults(defineProps<Props>(), {
    pageTitle: undefined,
    calculateButtonText: 'Calculate',
    calculatingText: 'CALCULATING...',
});

const emit = defineEmits<{
    calculate: [values: Record<string, number | string>];
}>();

const formData = reactive<Record<string, number | string>>({});
const errors = reactive<Record<string, string>>({});
const isCalculating = ref(false);

// Initialize form data with default values
props.fields.forEach((field) => {
    if (field.type === 'select') {
        formData[field.key] = field.defaultValue || field.options?.[0]?.value || '';
    } else {
        formData[field.key] = field.placeholder || 0;
    }
});

const validateForm = (): boolean => {
    // Clear all errors
    Object.keys(errors).forEach((key) => {
        errors[key] = '';
    });

    let isValid = true;

    props.fields.forEach((field) => {
        if (field.type === 'number') {
            const value = formData[field.key] as number;

            if (field.min !== undefined && value < field.min) {
                errors[field.key] = `Minimum ${field.min}${field.unit ? ' ' + field.unit : ''}`;
                isValid = false;
            }

            if (field.max !== undefined && value > field.max) {
                errors[field.key] = `Maximum ${field.max}${field.unit ? ' ' + field.unit : ''}`;
                isValid = false;
            }
        }
    });

    return isValid;
};

const onSubmit = () => {
    if (!validateForm()) return;

    isCalculating.value = true;
    emit('calculate', { ...formData });
};

const onCalculationComplete = () => {
    isCalculating.value = false;
};

// Expose method to parent
defineExpose({
    onCalculationComplete,
});
</script>

<template>
    <Head :title="pageTitle || title" />
    <MainLayout>
        <div class="mx-auto max-w-6xl px-4 py-8">
            <Stack space="xlarge">
                <!-- Header -->
                <div class="text-center">
                    <Stack space="small">
                        <h1 class="text-4xl font-bold">
                            <span class="text-accent">{{ titleAccent }}</span> {{ title }}
                        </h1>
                        <p class="text-muted-foreground">{{ description }}</p>
                    </Stack>
                </div>

                <div class="grid gap-8 lg:grid-cols-3">
                    <!-- Main Form -->
                    <Stack class="lg:col-span-2">
                        <Card class="p-6">
                            <form @submit.prevent="onSubmit" class="space-y-6">
                                <div class="grid gap-6 md:grid-cols-2">
                                    <div v-for="field in fields" :key="field.key">
                                        <label class="mb-2 block text-sm font-medium">
                                            {{ field.label }}
                                            <span v-if="field.unit" class="text-muted-foreground">({{ field.unit }})</span>
                                        </label>

                                        <!-- Number Input -->
                                        <Input
                                            v-if="field.type === 'number'"
                                            v-model.number="formData[field.key]"
                                            type="number"
                                            :step="field.step"
                                            :placeholder="String(field.placeholder || '')"
                                            class="font-mono"
                                            :class="{ 'border-destructive': errors[field.key] }"
                                        />

                                        <!-- Select Input -->
                                        <select
                                            v-else-if="field.type === 'select'"
                                            v-model="formData[field.key]"
                                            class="flex h-10 w-full rounded-md border border-primary/50 bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50 dark:bg-input/30"
                                            :class="{ 'border-destructive': errors[field.key] }"
                                        >
                                            <option v-for="option in field.options" :key="option.value" :value="option.value">
                                                {{ option.label }}
                                            </option>
                                        </select>

                                        <p v-if="errors[field.key]" class="mt-1 text-sm text-destructive">
                                            {{ errors[field.key] }}
                                        </p>
                                    </div>
                                </div>

                                <div v-if="isCalculating" class="mt-6 text-center">
                                    <div class="inline-flex items-center gap-2">
                                        <div class="h-4 w-4 animate-spin rounded-full border-2 border-primary border-t-transparent"></div>
                                        <span class="font-semibold">{{ calculatingText }}</span>
                                    </div>
                                </div>
                                <Button v-else type="submit" class="w-full py-3 font-semibold" :disabled="isCalculating">
                                    {{ calculateButtonText }}
                                </Button>
                            </form>

                            <!-- Results Slot -->
                            <div v-if="$slots.results" class="mt-6">
                                <slot name="results" />
                            </div>
                        </Card>

                        <AdSlot type="leaderboard" label="Calculator Sidebar" />

                        <!-- FAQ Section -->
                        <div v-if="faqItems.length > 0">
                            <h2 class="mb-6 text-2xl font-bold">Frequently Asked Questions</h2>
                            <Stack space="medium">
                                <FAQItem v-for="faq in faqItems" :key="faq.question" :question="faq.question" :answer="faq.answer" />
                            </Stack>
                        </div>
                    </Stack>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <Stack>
                            <div>
                                <slot name="sidebar" />
                            </div>
                            <AdSlot type="rectangle" label="Calculator Sidebar" />
                        </Stack>
                    </div>
                </div>
            </Stack>
        </div>
    </MainLayout>
</template>
