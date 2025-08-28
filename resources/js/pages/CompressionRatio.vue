<script setup lang="ts">
import CalculatorLayout from '@/components/shared/CalculatorLayout.vue';
import CalculatorResults from '@/components/shared/CalculatorResults.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Info } from 'lucide-vue-next';
import { ref } from 'vue';

interface CompressionResult {
    compressionRatio: number;
    displacement: number;
    clearanceVolume: number;
}

const result = ref<CompressionResult | null>(null);
const calculatorRef = ref();

const fields = [
    {
        key: 'bore',
        label: 'Bore Diameter',
        type: 'number' as const,
        step: '0.001',
        placeholder: 4.0,
        min: 2,
        max: 6,
        unit: 'inches',
    },
    {
        key: 'stroke',
        label: 'Stroke Length',
        type: 'number' as const,
        step: '0.001',
        placeholder: 3.48,
        min: 2,
        max: 6,
        unit: 'inches',
    },
    {
        key: 'pistonVolume',
        label: 'Piston Volume',
        type: 'number' as const,
        step: '0.1',
        placeholder: 10.5,
        min: 1,
        max: 50,
        unit: 'cc',
    },
    {
        key: 'gasketThickness',
        label: 'Head Gasket Thickness',
        type: 'number' as const,
        step: '0.001',
        placeholder: 0.045,
        min: 0.02,
        max: 0.2,
        unit: 'inches',
    },
];

const faqItems = [
    {
        question: "What's the optimal compression ratio for my application?",
        answer: 'Street engines typically run 9:1 to 10.5:1 for pump gas compatibility, while performance builds can push 11:1 to 12:1 with premium fuel and proper tuning. Race engines may exceed 15:1 with methanol or high-octane race fuels. Turbocharged engines usually run 8:1 to 9:1 to prevent detonation under boost.',
    },
    {
        question: 'What compression ratio can I run on pump gas?',
        answer: '87 octane regular gas typically limits you to 8.5:1 to 9.5:1 compression. Premium 91-93 octane allows 9.5:1 to 11:1, depending on engine design, combustion chamber shape, and tuning. Modern efficient combustion chambers can run higher ratios than older designs on the same octane.',
    },
    {
        question: 'How does deck height affect compression ratio?',
        answer: 'Zero-deck (piston flush with deck) or positive deck height (piston below deck) increases combustion chamber volume, lowering compression ratio. Negative deck height (piston above deck) reduces chamber volume, increasing compression. Every 0.010" of deck height change typically affects compression by 0.2-0.4 points.',
    },
    {
        question: 'How much does head gasket thickness affect compression?',
        answer: 'Head gasket thickness significantly impacts compression ratio. A thicker gasket increases combustion chamber volume, lowering compression, while a thinner gasket raises it. Typical gaskets range from 0.027" to 0.060", with each 0.010" change affecting compression by approximately 0.2-0.5 points depending on engine size.',
    },
    {
        question: "What's the difference between static and dynamic compression ratio?",
        answer: 'Static compression is the calculated ratio based on engine geometry. Dynamic compression considers when the intake valve actually closes during the compression stroke. Long-duration camshafts delay valve closing, reducing dynamic compression and allowing higher static ratios without detonation.',
    },
];

const onCalculate = (values: Record<string, string | number>) => {
    result.value = null;

    // Simulate 3 second calculation
    setTimeout(() => {
        const bore = Number(values.bore);
        const stroke = Number(values.stroke);
        const gasketThickness = Number(values.gasketThickness);
        const pistonVolume = Number(values.pistonVolume);

        // Convert bore and stroke to calculate displacement
        const cylinderVolume = Math.PI * Math.pow(bore / 2, 2) * stroke;
        const displacementCubicInches = cylinderVolume;

        // Convert to cc for clearance volume calculation
        const cylinderVolumeCC = cylinderVolume * 16.387; // cubic inches to cc
        const gasketVolumeCC = Math.PI * Math.pow(bore / 2, 2) * gasketThickness * 16.387;
        const clearanceVolume = pistonVolume + gasketVolumeCC;

        const compressionRatio = (cylinderVolumeCC + clearanceVolume) / clearanceVolume;

        result.value = {
            compressionRatio,
            displacement: displacementCubicInches,
            clearanceVolume,
        };

        calculatorRef.value?.onCalculationComplete();
    }, 3000);
};
</script>

<template>
    <CalculatorLayout
        ref="calculatorRef"
        title-accent="Compression Ratio"
        title="Calculator"
        description="Calculate your engine's compression ratio using piston volume, head gasket thickness, bore, and stroke measurements."
        :fields="fields"
        :faq-items="faqItems"
        calculate-button-text="Calculate Compression Ratio"
        calculating-text="CALCULATING COMPRESSION RATIO..."
        @calculate="onCalculate"
    >
        <!-- Results Slot -->
        <template #results>
            <CalculatorResults
                v-if="result"
                title="Results"
                :results="[
                    {
                        label: 'Compression Ratio',
                        value: result.compressionRatio.toFixed(2) + ':1',
                    },
                    {
                        label: 'Displacement',
                        value: result.displacement.toFixed(1),
                        unit: 'cubic inches',
                    },
                    {
                        label: 'Clearance Volume',
                        value: result.clearanceVolume.toFixed(1),
                        unit: 'cc',
                    },
                ]"
            />
        </template>

        <!-- Sidebar Slot -->
        <template #sidebar>
            <Card>
                <CardHeader>
                    <CardTitle class="flex items-center">
                        <Info class="mr-2 h-5 w-5 text-accent" />
                        About Compression Ratio
                    </CardTitle>
                </CardHeader>
                <CardContent class="space-y-3 text-sm text-muted-foreground">
                    <p class="leading-relaxed">
                        Compression ratio is one of the most fundamental specifications that determines your engine's power output, fuel requirements,
                        and overall character. Understanding and optimizing your engine's compression ratio is essential for maximizing performance
                        while maintaining reliability and choosing the correct octane fuel.
                    </p>
                    <p>
                        The compression ratio represents how much the air-fuel mixture is compressed before ignition. Higher compression ratios
                        extract more energy from each combustion event, resulting in increased power and efficiency. However, excessive compression
                        can lead to detonation (engine knock), which can cause catastrophic engine damage if left unchecked.
                    </p>
                    <div>
                        <p class="mb-2 font-semibold text-foreground">Typical Ranges:</p>
                        <ul class="list-inside list-disc space-y-1">
                            <li>Street engines: 8.5:1 to 10.5:1</li>
                            <li>Performance engines: 10:1 to 12:1</li>
                            <li>Race engines: 12:1 to 15:1+</li>
                        </ul>
                    </div>
                    <div>
                        <p class="mb-2 font-semibold text-foreground">Fuel Requirements:</p>
                        <ul class="list-inside list-disc space-y-1">
                            <li>8.5-9.5:1 - 87 octane pump gas</li>
                            <li>9.5-10.5:1 - 91-93 octane premium</li>
                            <li>10.5-12:1 - 100+ octane race fuel</li>
                            <li>12:1+ - Methanol or very high octane</li>
                        </ul>
                    </div>
                </CardContent>
            </Card>
        </template>
    </CalculatorLayout>
</template>
