<script setup lang="ts">
import CalculatorLayout from '@/components/shared/CalculatorLayout.vue';
import CalculatorResults from '@/components/shared/CalculatorResults.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Zap } from 'lucide-vue-next';
import { ref } from 'vue';

interface TurboResult {
    requiredCFM: number;
    compressorSize: string;
    turbineAR: string;
    spoolChar: string;
}

const result = ref<TurboResult | null>(null);
const calculatorRef = ref();

const fields = [
    {
        key: 'targetHP',
        label: 'Target Horsepower',
        type: 'number' as const,
        step: '1',
        placeholder: 500,
        min: 200,
        max: 1500,
        unit: 'HP',
    },
    {
        key: 'displacement',
        label: 'Engine Displacement',
        type: 'number' as const,
        step: '0.1',
        placeholder: 2.0,
        min: 1.0,
        max: 8.0,
        unit: 'L',
    },
    {
        key: 'targetRPM',
        label: 'Target RPM',
        type: 'number' as const,
        step: '100',
        placeholder: 6500,
        min: 4000,
        max: 9000,
        unit: 'RPM',
    },
    {
        key: 'boostPressure',
        label: 'Boost Pressure',
        type: 'number' as const,
        step: '0.1',
        placeholder: 20,
        min: 5,
        max: 40,
        unit: 'PSI',
    },
    {
        key: 'volumetricEfficiency',
        label: 'Volumetric Efficiency',
        type: 'select' as const,
        options: [
            { value: '85', label: 'Street Build (85%)' },
            { value: '95', label: 'Performance (95%)' },
            { value: '105', label: 'Race Engine (105%)' },
        ],
        defaultValue: '95',
    },
    {
        key: 'application',
        label: 'Application',
        type: 'select' as const,
        options: [
            { value: 'street', label: 'Street/Daily Driver' },
            { value: 'performance', label: 'Performance/Track' },
            { value: 'race', label: 'Race/Drag' },
        ],
        defaultValue: 'performance',
    },
];

const faqItems = [
    {
        question: 'How does turbine A/R ratio affect performance?',
        answer: 'A/R ratio controls exhaust flow velocity through the turbine. Smaller A/R (0.63-0.73) creates higher exhaust velocity, spinning the turbine faster for quicker spool but limiting high-RPM flow. Larger A/R (0.86-1.15) flows better at high RPM but spools more slowly. Choose based on your priority: responsiveness vs. top-end power.',
    },
    {
        question: 'Should I size up or down from the calculated recommendation?',
        answer: 'For street driving, consider sizing down slightly for better spool and throttle response. For drag racing or high-RPM applications, sizing up can provide more top-end power. The calculated size provides the best balance, but your specific priorities (spool vs. peak power) should guide the final decision.',
    },
    {
        question: 'How do I size turbos for a twin-turbo setup?',
        answer: 'For twin-turbo setups, divide your target horsepower by two and calculate for each turbo individually. Smaller individual turbos typically spool faster than a single large turbo while providing similar total airflow. Consider whether you want identical turbos or different sizes for staged boost delivery.',
    },
    {
        question: 'How do altitude and temperature affect turbo sizing?',
        answer: 'Higher altitudes and temperatures reduce air density, requiring larger turbos to flow the same mass of air. Add 10-15% to your CFM requirements for every 3000 feet above sea level or when operating in consistently hot climates. Cold air is denser and may allow slightly smaller turbo sizing.',
    },
    {
        question: 'How important is matching the turbo to my exhaust manifold?',
        answer: 'Exhaust manifold design significantly affects turbo performance. Log manifolds are simple but can hurt spool due to unequal pulse timing. Tubular manifolds with proper runner lengths improve spool and power but cost more. The manifold-to-turbine flange must also physically match your turbo choice.',
    },
];

const onCalculate = (values: Record<string, string | number>) => {
    result.value = null;

    // Simulate 3 second calculation
    setTimeout(() => {
        const displacement = Number(values.displacement);
        const targetRPM = Number(values.targetRPM);
        const boostPressure = Number(values.boostPressure);
        const volumetricEfficiency = Number(values.volumetricEfficiency);
        const application = values.application as string;

        // Calculate CFM requirement
        const atmosphericPressure = 14.7; // PSI at sea level
        const absolutePressure = atmosphericPressure + boostPressure;
        const pressureRatio = absolutePressure / atmosphericPressure;
        const ve = volumetricEfficiency / 100;

        // CFM = (Displacement × RPM × VE × Pressure Ratio) / (2 × 1728)
        const cfm = (displacement * 61.024 * targetRPM * ve * pressureRatio) / (2 * 1728);

        // Determine compressor size and A/R based on application
        let compressorSize: string, turbineAR: string, spoolChar: string;

        if (cfm < 400) {
            compressorSize = 'Small (GT25-GT28)';
            turbineAR = application === 'street' ? '0.63-0.73' : '0.73-0.86';
            spoolChar = 'Quick spool, moderate top end';
        } else if (cfm < 600) {
            compressorSize = 'Medium (GT30-GT35)';
            turbineAR = application === 'street' ? '0.73-0.86' : '0.86-1.01';
            spoolChar = 'Balanced spool and top end';
        } else {
            compressorSize = 'Large (GT40+)';
            turbineAR = application === 'street' ? '0.86-1.01' : '1.01-1.15';
            spoolChar = 'Slower spool, excellent top end';
        }

        result.value = {
            requiredCFM: Math.round(cfm),
            compressorSize,
            turbineAR,
            spoolChar,
        };

        calculatorRef.value?.onCalculationComplete();
    }, 3000);
};
</script>

<template>
    <CalculatorLayout
        ref="calculatorRef"
        title="Calculator"
        title-accent="Turbo Sizing"
        description="Match turbocharger size to your horsepower goals and engine displacement for optimal performance."
        :fields="fields"
        :faq-items="faqItems"
        calculate-button-text="Calculate Turbo Size"
        calculating-text="CALCULATING TURBO SIZE..."
        @calculate="onCalculate"
    >
        <!-- Results Slot -->
        <template #results>
            <CalculatorResults
                v-if="result"
                title="Recommended Turbo Specifications"
                :results="[
                    {
                        label: 'Required CFM',
                        value: result.requiredCFM,
                        unit: '',
                        highlight: true,
                    },
                    {
                        label: 'Compressor Size',
                        value: result.compressorSize,
                        unit: '',
                    },
                    {
                        label: 'Turbine A/R',
                        value: result.turbineAR,
                        unit: '',
                    },
                    {
                        label: 'Spool Characteristic',
                        value: result.spoolChar,
                        unit: '',
                    },
                ]"
                :recommendation="{
                    icon: '🌪️',
                    title: 'Note',
                    message:
                        'These recommendations provide a starting point. Consider your specific priorities (spool vs. peak power) and consult with turbo manufacturers for final sizing decisions.',
                }"
            />
        </template>

        <!-- Sidebar Slot -->
        <template #sidebar>
            <Card>
                <CardHeader>
                    <CardTitle class="flex items-center">
                        <Zap class="mr-2 h-5 w-5 text-accent" />
                        Turbo Sizing Guide
                    </CardTitle>
                </CardHeader>
                <CardContent class="space-y-3 text-sm text-muted-foreground">
                    <div>
                        <p class="mb-2 font-semibold text-foreground">A/R Ratio Impact:</p>
                        <ul class="list-inside list-disc space-y-1">
                            <li>Smaller A/R - Quicker spool, less top end</li>
                            <li>Larger A/R - Slower spool, more top end</li>
                        </ul>
                    </div>
                    <div>
                        <p class="mb-2 font-semibold text-foreground">CFM Requirements:</p>
                        <ul class="list-inside list-disc space-y-1">
                            <li>~2.5 CFM per HP for most engines</li>
                            <li>Higher for race applications</li>
                            <li>Account for altitude and temperature</li>
                        </ul>
                    </div>
                    <div>
                        <p class="mb-2 font-semibold text-foreground">Compressor Sizes:</p>
                        <ul class="list-inside list-disc space-y-1">
                            <li>GT25-GT28: 300-500 HP</li>
                            <li>GT30-GT35: 400-700 HP</li>
                            <li>GT40+: 600+ HP</li>
                        </ul>
                    </div>
                </CardContent>
            </Card>
        </template>
    </CalculatorLayout>
</template>
