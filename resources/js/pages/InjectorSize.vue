<script setup lang="ts">
import CalculatorLayout from '@/components/shared/CalculatorLayout.vue';
import CalculatorResults from '@/components/shared/CalculatorResults.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Link } from '@inertiajs/vue3';
import { Lightbulb } from 'lucide-vue-next';
import { ref } from 'vue';

interface InjectorResult {
    injectorSize: number;
    totalFlow: number;
    perInjector: number;
}

const result = ref<InjectorResult | null>(null);
const calculatorRef = ref();

const fields = [
    {
        key: 'targetHP',
        label: 'Target Horsepower',
        type: 'number' as const,
        step: '1',
        placeholder: 400,
        min: 50,
        max: 2000,
        unit: 'HP',
    },
    {
        key: 'dutyCycle',
        label: 'Maximum Duty Cycle',
        type: 'number' as const,
        step: '1',
        placeholder: 80,
        min: 60,
        max: 90,
        unit: '%',
    },
    {
        key: 'bsfc',
        label: 'BSFC (Brake Specific Fuel Consumption)',
        type: 'number' as const,
        step: '0.01',
        placeholder: 0.55,
        min: 0.3,
        max: 0.8,
        unit: '',
    },
    {
        key: 'injectorCount',
        label: 'Number of Injectors',
        type: 'number' as const,
        step: '1',
        placeholder: 8,
        min: 1,
        max: 16,
        unit: '',
    },
];

const faqItems = [
    {
        question: 'What duty cycle should I target for my application?',
        answer: 'For street cars, aim for 80% maximum duty cycle to maintain good idle quality and fuel economy. Performance applications can push to 85%, while race-only setups may run 90% but will sacrifice idle quality. Higher duty cycles leave less safety margin for fuel pump pressure drops and varying conditions.',
    },
    {
        question: 'How do I determine the correct BSFC value?',
        answer: 'BSFC (Brake Specific Fuel Consumption) varies by engine type: 0.45 for naturally aspirated engines, 0.55 for turbocharged applications, and 0.65+ for high-boost or E85 setups. Forced induction engines require more fuel due to higher cylinder pressures and temperatures.',
    },
    {
        question: 'Should I size up my injectors for future modifications?',
        answer: "While it's tempting to oversize for future upgrades, excessively large injectors hurt idle quality, fuel economy, and tuning precision. Size for your current goals plus 10-15% headroom. You can always upgrade injectors later as you increase power levels.",
    },
    {
        question: 'Do fuel pressure and injector pressure ratings matter?',
        answer: "Yes! Injector flow rates are rated at specific pressures (usually 43.5 PSI or 3 bar). Higher fuel pressure increases flow rate, while lower pressure reduces it. Match your fuel system pressure to the injector's rated pressure, or adjust calculations accordingly.",
    },
    {
        question: 'Can I run different sized injectors or add extra injectors?',
        answer: 'For best results, use identical injectors in all cylinders to ensure even fuel distribution. Some high-horsepower applications use staged injection with primary and secondary injectors, but this requires specialized engine management and tuning expertise.',
    },
];

const onCalculate = (values: Record<string, string | number>) => {
    result.value = null;

    // Simulate 3 second calculation
    setTimeout(() => {
        const targetHP = Number(values.targetHP);
        const dutyCycle = Number(values.dutyCycle);
        const bsfc = Number(values.bsfc);
        const injectorCount = Number(values.injectorCount);

        const dutyCycleDecimal = dutyCycle / 100;

        // Calculate total fuel flow required
        const totalFuelFlow = targetHP * bsfc;

        // Calculate per injector flow accounting for duty cycle
        const perInjectorFlow = totalFuelFlow / injectorCount / dutyCycleDecimal;

        result.value = {
            injectorSize: Math.ceil(perInjectorFlow),
            totalFlow: totalFuelFlow,
            perInjector: perInjectorFlow,
        };

        calculatorRef.value?.onCalculationComplete();
    }, 3000);
};
</script>

<template>
    <CalculatorLayout
        ref="calculatorRef"
        title="Calculator"
        title-accent="Fuel Injector Size"
        description="Calculate required injector size based on target horsepower and desired duty cycle for optimal fuel delivery."
        :fields="fields"
        :faq-items="faqItems"
        calculate-button-text="Calculate Injector Size"
        calculating-text="CALCULATING INJECTOR SIZE..."
        @calculate="onCalculate"
    >
        <!-- Results Slot -->
        <template #results>
            <CalculatorResults
                v-if="result"
                title="Required Injector Size"
                :results="[
                    {
                        label: 'Injector Flow Rate',
                        value: result.injectorSize,
                        unit: 'lb/hr',
                        highlight: true,
                    },
                    {
                        label: 'Total Fuel Flow',
                        value: result.totalFlow.toFixed(1),
                        unit: 'lb/hr',
                    },
                    {
                        label: 'Per Injector',
                        value: result.perInjector.toFixed(1),
                        unit: 'lb/hr',
                    },
                ]"
                :recommendation="{
                    icon: '💡',
                    title: 'Recommendation',
                    message: 'Always round up to the nearest available injector size and verify flow rates at your operating pressure.',
                }"
            />
        </template>

        <!-- Sidebar Slot -->
        <template #sidebar>
            <Card>
                <CardHeader>
                    <CardTitle class="flex items-center">
                        <Lightbulb class="mr-2 h-5 w-5 text-accent" />
                        Injector Sizing Tips
                    </CardTitle>
                </CardHeader>
                <CardContent class="space-y-3 text-sm text-muted-foreground">
                    <div>
                        <p class="mb-2 font-semibold text-foreground">Duty Cycle Guidelines:</p>
                        <ul class="list-inside list-disc space-y-1">
                            <li>80% - Safe maximum for street</li>
                            <li>85% - Performance applications</li>
                            <li>90% - Race only, poor idle</li>
                        </ul>
                    </div>
                    <div>
                        <p class="mb-2 font-semibold text-foreground">Common Sizes:</p>
                        <ul class="list-inside list-disc space-y-1">
                            <li>24-36 lb/hr - Stock/mild builds</li>
                            <li>42-60 lb/hr - Performance builds</li>
                            <li>80+ lb/hr - High HP applications</li>
                        </ul>
                    </div>
                    <div>
                        <p class="mb-2 font-semibold text-foreground">BSFC Values:</p>
                        <ul class="list-inside list-disc space-y-1">
                            <li>0.45 - Naturally aspirated engines</li>
                            <li>0.55 - Turbocharged engines</li>
                            <li>0.65 - High boost/E85 applications</li>
                        </ul>
                    </div>
                    <div class="mt-6">
                        <ul class="space-y-2">
                            <li>
                                <Link href="/compression-ratio-calculator" class="hover:underline">
                                    Building a high-compression engine? Check our
                                    <span class="font-medium text-accent">Compression Ratio Calculator</span>.
                                </Link>
                            </li>

                            <li>
                                <Link href="/turbo-size-calculator" class="hover:underline">
                                    Need to match injectors to your turbo? Try our
                                    <span class="font-medium text-accent">Turbo Sizing Calculator</span>.
                                </Link>
                            </li>
                            <li>
                                <Link href="/trap-speed-calculator" class="hover:underline">
                                    Want to estimate your car's performance? Use our
                                    <span class="font-medium text-accent">HP to Trap Speed Calculator</span>.
                                </Link>
                            </li>
                        </ul>
                    </div>
                </CardContent>
            </Card>
        </template>
    </CalculatorLayout>
</template>
