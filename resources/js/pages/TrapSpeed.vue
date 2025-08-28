<script setup lang="ts">
import CalculatorLayout from '@/components/shared/CalculatorLayout.vue';
import CalculatorResults from '@/components/shared/CalculatorResults.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Link } from '@inertiajs/vue3';
import { Target } from 'lucide-vue-next';
import { ref } from 'vue';

interface TrapSpeedResult {
    trapSpeed: number;
    powerToWeight: number;
    estimatedET: number;
}

const result = ref<TrapSpeedResult | null>(null);
const calculatorRef = ref();

const fields = [
    {
        key: 'horsepower',
        label: 'Horsepower',
        type: 'number' as const,
        step: '1',
        placeholder: 400,
        min: 100,
        max: 2000,
        unit: 'HP',
    },
    {
        key: 'weight',
        label: 'Vehicle Weight',
        type: 'number' as const,
        step: '50',
        placeholder: 3200,
        min: 1500,
        max: 6000,
        unit: 'lbs',
    },
    {
        key: 'drivetrain',
        label: 'Drivetrain',
        type: 'select' as const,
        options: [
            { value: 'rwd', label: 'Rear Wheel Drive (RWD)' },
            { value: 'fwd', label: 'Front Wheel Drive (FWD)' },
            { value: 'awd', label: 'All Wheel Drive (AWD)' },
        ],
        defaultValue: 'rwd',
    },
    {
        key: 'transmission',
        label: 'Transmission',
        type: 'select' as const,
        options: [
            { value: 'manual', label: 'Manual' },
            { value: 'auto', label: 'Automatic' },
            { value: 'dct', label: 'Dual Clutch' },
        ],
        defaultValue: 'manual',
    },
    {
        key: 'tires',
        label: 'Tires',
        type: 'select' as const,
        options: [
            { value: 'street', label: 'Street Tires' },
            { value: 'drag', label: 'Drag Radials' },
            { value: 'slick', label: 'Slicks' },
        ],
        defaultValue: 'drag',
    },
    {
        key: 'driver',
        label: 'Driver Experience',
        type: 'select' as const,
        options: [
            { value: 'beginner', label: 'Beginner' },
            { value: 'experienced', label: 'Experienced' },
            { value: 'pro', label: 'Professional' },
        ],
        defaultValue: 'experienced',
    },
];

const faqItems = [
    {
        question: 'How important is power-to-weight ratio for trap speed?',
        answer: 'Power-to-weight ratio is the primary factor determining trap speed. Every pound of weight reduction has the same effect as adding horsepower. A 3000 lb car with 300 HP (10 lb/hp) will trap similarly to a 3600 lb car with 360 HP. Focus on both power gains and weight reduction for maximum improvement.',
    },
    {
        question: 'Why is trap speed more consistent than ET?',
        answer: 'Trap speed reflects the energy accumulated over the entire quarter-mile, making it less sensitive to launch variations. A bad launch might hurt your ET by 0.5+ seconds but only affect trap speed by 1-2 MPH. This makes trap speed a better indicator of actual horsepower than ET alone.',
    },
    {
        question: 'How do track conditions affect trap speed?',
        answer: 'Hot, humid, high-altitude conditions reduce air density and engine power, lowering trap speeds by 2-5 MPH. Cold, dry air at sea level provides optimal conditions. Professional tracks correct times to standard atmospheric conditions (DA - Density Altitude) for fair comparisons.',
    },
    {
        question: 'How much do drivetrain losses affect trap speed?',
        answer: 'Manual transmissions typically lose 12-15% of engine power, automatics 18-22%, and AWD systems 20-25%. However, automatics may trap higher due to consistent launches and optimal shift points, while manuals require more driver skill but can be more efficient when driven perfectly.',
    },
    {
        question: 'What modifications increase trap speed most effectively?',
        answer: 'Power adders (turbo, supercharger, nitrous) provide the biggest trap speed gains. Engine internals (cam, heads, exhaust) offer moderate improvements. Weight reduction is extremely effective - removing 100 lbs equals approximately 10-15 HP in trap speed improvement. Aerodynamic improvements help mainly above 120 MPH.',
    },
];

const onCalculate = (values: Record<string, number | string>) => {
    result.value = null;

    // Simulate 3 second calculation
    setTimeout(() => {
        const horsepower = Number(values.horsepower);
        const weight = Number(values.weight);
        const drivetrain = values.drivetrain as string;
        const transmission = values.transmission as string;
        const tires = values.tires as string;
        const driver = values.driver as string;

        // Calculate power-to-weight ratio
        const powerToWeight = weight / horsepower;

        // Base trap speed calculation using empirical formula
        // Trap Speed = 224 * (HP/Weight)^0.333
        const baseTrapSpeed = 224 * Math.pow(horsepower / weight, 1 / 3);

        // Apply modifiers based on configuration
        let modifier = 1.0;

        // Drivetrain losses
        switch (drivetrain) {
            case 'rwd':
                modifier *= 1.0; // baseline
                break;
            case 'fwd':
                modifier *= 1.02; // less drivetrain loss
                break;
            case 'awd':
                modifier *= 0.95; // more drivetrain loss
                break;
        }

        // Transmission efficiency
        switch (transmission) {
            case 'manual':
                modifier *= 1.0; // baseline
                break;
            case 'auto':
                modifier *= 0.98; // slight loss
                break;
            case 'dct':
                modifier *= 1.01; // slight gain
                break;
        }

        // Traction modifiers (affects launch more than trap speed)
        switch (tires) {
            case 'street':
                modifier *= 0.98;
                break;
            case 'drag':
                modifier *= 1.0;
                break;
            case 'slick':
                modifier *= 1.01;
                break;
        }

        // Driver experience (affects consistency more than peak)
        switch (driver) {
            case 'beginner':
                modifier *= 0.95;
                break;
            case 'experienced':
                modifier *= 1.0;
                break;
            case 'pro':
                modifier *= 1.02;
                break;
        }

        const trapSpeed = baseTrapSpeed * modifier;

        // Estimate ET using trap speed (rough approximation)
        const estimatedET = 5.825 * Math.pow(weight / horsepower, 0.333);

        result.value = {
            trapSpeed,
            powerToWeight,
            estimatedET,
        };

        calculatorRef.value?.onCalculationComplete();
    }, 3000);
};
</script>

<template>
    <CalculatorLayout
        ref="calculatorRef"
        title="Calculator"
        title-accent="HP to Trap Speed"
        description="Estimate quarter-mile trap speed based on horsepower, weight, and drivetrain configuration."
        :fields="fields"
        :faq-items="faqItems"
        calculate-button-text="Calculate Trap Speed"
        calculating-text="CALCULATING TRAP SPEED..."
        @calculate="onCalculate"
    >
        <!-- Results Slot -->
        <template #results>
            <CalculatorResults
                v-if="result"
                title="Estimated Performance"
                :results="[
                    {
                        label: 'Trap Speed',
                        value: result.trapSpeed.toFixed(1),
                        unit: 'MPH',
                        highlight: true,
                    },
                    {
                        label: 'Power-to-Weight',
                        value: result.powerToWeight.toFixed(2),
                        unit: 'lb/hp',
                    },
                    {
                        label: 'Estimated ET',
                        value: result.estimatedET.toFixed(2),
                        unit: 'seconds',
                    },
                ]"
                :recommendation="{
                    icon: '⚠️',
                    title: 'Note',
                    message:
                        'Results are estimates based on theoretical calculations. Actual performance may vary significantly based on track conditions, altitude, temperature, and vehicle setup.',
                }"
            />
        </template>

        <!-- Sidebar Slot -->
        <template #sidebar>
            <Card>
                <CardHeader>
                    <CardTitle class="flex items-center">
                        <Target class="mr-2 h-5 w-5 text-accent" />
                        Trap Speed Reference
                    </CardTitle>
                </CardHeader>
                <CardContent class="space-y-3 text-sm text-muted-foreground">
                    <div>
                        <p class="mb-2 font-semibold text-foreground">Performance Benchmarks:</p>
                        <ul class="list-inside list-disc space-y-1">
                            <li>100 MPH - ~200 HP (3000 lbs)</li>
                            <li>110 MPH - ~300 HP (3000 lbs)</li>
                            <li>120 MPH - ~450 HP (3000 lbs)</li>
                            <li>130 MPH - ~650 HP (3000 lbs)</li>
                        </ul>
                    </div>
                    <div>
                        <p class="mb-2 font-semibold text-foreground">Factors Affecting Speed:</p>
                        <ul class="list-inside list-disc space-y-1">
                            <li>Aerodynamics and drag coefficient</li>
                            <li>Launch and traction</li>
                            <li>Atmospheric conditions</li>
                            <li>Gear ratios and shift points</li>
                        </ul>
                    </div>
                    <div>
                        <p class="mb-2 font-semibold text-foreground">ET vs Trap Speed:</p>
                        <ul class="list-inside list-disc space-y-1">
                            <li>ET affected more by launch</li>
                            <li>Trap speed shows true power</li>
                            <li>Both important for complete picture</li>
                        </ul>
                    </div>
                    <div class="mt-6">
                        <ul class="space-y-2">
                            <li>
                                <Link href="/compression-ratio-calculator" class="hover:underline">
                                    Want to increase power? Check our
                                    <span class="font-medium text-accent">Compression Ratio Calculator</span>.
                                </Link>
                            </li>
                            <li>
                                <Link href="/injector-size-calculator" class="hover:underline">
                                    Need more fuel for higher HP? Try our <span class="font-medium text-accent">Fuel Injector Calculator</span>.
                                </Link>
                            </li>
                            <li>
                                <Link href="/turbo-size-calculator" class="hover:underline">
                                    Planning forced induction? Use our
                                    <span class="font-medium text-accent">Turbo Sizing Calculator</span>.
                                </Link>
                            </li>
                        </ul>
                    </div>
                </CardContent>
            </Card>
        </template>
    </CalculatorLayout>
</template>
