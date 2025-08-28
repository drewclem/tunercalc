<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Activity, Droplet, Gauge, Zap } from 'lucide-vue-next';

import AdSlot from '@/components/shared/AdSlot.vue';
import Stack from '@/components/stencil/Stack.vue';

interface CalculatorCard {
    title: string;
    description: string;
    icon: any; // Vue component type
    path: string;
    specs: string[];
}

const cards: CalculatorCard[] = [
    {
        title: 'Compression Ratio Calculator',
        description: "Calculate your engine's compression ratio using piston volume, head gasket thickness, bore, and stroke measurements.",
        icon: Activity,
        path: 'compression-ratio-calculator',
        specs: ['Bore & Stroke', 'Piston Volume', 'Head Gasket', 'Clearance Volume'],
    },
    {
        title: 'Fuel Injector Size Calculator',
        description: 'Calculate required injector size based on target horsepower and desired duty cycle for optimal fuel delivery.',
        icon: Droplet,
        path: 'injector-size-calculator',
        specs: ['Target HP', 'Duty Cycle', 'BSFC Rating', 'Injector Count'],
    },
    {
        title: 'Turbo Sizing Calculator',
        description: 'Match turbocharger size to your horsepower goals and engine displacement for optimal performance.',
        icon: Zap,
        path: 'turbo-size-calculator',
        specs: ['Target HP', 'Engine Size', 'Boost Level', 'Application'],
    },
    {
        title: 'HP to Trap Speed Calculator',
        description: 'Estimate quarter-mile trap speed based on horsepower, weight, and drivetrain configuration.',
        icon: Gauge,
        path: 'trap-speed-calculator',
        specs: ['Horsepower', 'Vehicle Weight', 'Drivetrain', 'Tire Setup'],
    },
];
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <MainLayout>
        <Stack space="xlarge" class="py-16">
            <div class="mb-16 px-6 text-center lg:px-0">
                <Stack>
                    <Stack space="medium">
                        <h1 class="text-4xl leading-8 font-bold text-accent md:text-6xl">
                            <span>T<span class="inline-block origin-bottom-left -translate-y-0.5 scale-75 transform">UNER</span></span>
                            <span class="-ml-6 lg:-ml-12">
                                C<span class="inline-block origin-bottom-left -translate-y-0.5 scale-75 transform">ALC:</span>
                            </span>
                            <br /><span class="text-3xl text-primary dark:text-primary-foreground"
                                >Car Performance Calculators for Tuners & Enthusiasts</span
                            >
                        </h1>

                        <p class="text-lg text-muted-foreground lg:mx-auto lg:max-w-2xl">
                            Professional automotive calculators for enthusiasts and professionals. Accurate calculations for performance modifications
                            and engine tuning.
                        </p>
                    </Stack>

                    <div class="flex flex-wrap justify-center gap-4">
                        <div
                            class="heist-glow border border-primary px-4 py-2 text-sm font-medium text-primary uppercase dark:border-accent dark:text-accent"
                        >
                            Compression Ratio
                        </div>
                        <div
                            class="heist-glow border border-primary px-4 py-2 text-sm font-medium text-primary uppercase dark:border-accent dark:text-accent"
                        >
                            Injector Sizing
                        </div>
                        <div
                            class="heist-glow border border-primary px-4 py-2 text-sm font-medium text-primary uppercase dark:border-accent dark:text-accent"
                        >
                            Turbo Matching
                        </div>
                        <div
                            class="heist-glow border border-primary px-4 py-2 text-sm font-medium text-primary uppercase dark:border-accent dark:text-accent"
                        >
                            Trap Speed
                        </div>
                    </div>
                </Stack>
            </div>

            <div class="grid gap-6 px-6 md:grid-cols-2 lg:px-0">
                <div
                    v-for="card in cards"
                    :key="card.title"
                    class="heist-glow group relative overflow-hidden border border-primary bg-card p-6 transition-all dark:border-sidebar-border"
                >
                    <Stack space="medium">
                        <div class="flex items-center gap-3">
                            <component :is="card.icon" class="h-8 w-8 text-accent" />
                            <h3 class="text-xl font-semibold">{{ card.title }}</h3>
                        </div>
                        <p class="text-sm text-muted-foreground">{{ card.description }}</p>
                        <div class="grid grid-cols-2 gap-2">
                            <div v-for="spec in card.specs" :key="spec" class="bg-muted px-2 py-1 text-sm">{{ spec }}</div>
                        </div>

                        <Link
                            :href="card.path"
                            class="border border-transparent bg-primary px-3 py-1 text-center font-medium text-primary-foreground uppercase dark:border-primary-foreground/50 dark:bg-sidebar-accent dark:text-sidebar-accent-foreground"
                            >Open Calculator</Link
                        >
                    </Stack>
                </div>
            </div>

            <AdSlot type="leaderboard" label="Welcome Sidebar" />

            <div class="mt-16 grid gap-8 px-6 md:grid-cols-3 lg:px-0">
                <div class="text-center">
                    <div class="heist-glow mx-auto mb-4 flex h-16 w-16 items-center justify-center border border-accent">
                        <Activity class="h-8 w-8 text-accent" />
                    </div>
                    <h3 class="mb-2 text-lg font-bold">Precision Calculations</h3>
                    <p class="text-sm text-muted-foreground">
                        Industry-standard formulas and calculations used by professional engine builders and tuners.
                    </p>
                </div>
                <div class="text-center">
                    <div class="heist-glow mx-auto mb-4 flex h-16 w-16 items-center justify-center border border-accent">
                        <Zap class="h-8 w-8 text-accent" />
                    </div>
                    <h3 class="mb-2 text-lg font-bold">Performance Focused</h3>
                    <p class="text-sm text-muted-foreground">Built specifically for automotive performance applications with real-world accuracy.</p>
                </div>
                <div class="text-center">
                    <div class="heist-glow mx-auto mb-4 flex h-16 w-16 items-center justify-center border border-accent">
                        <Gauge class="h-8 w-8 text-accent" />
                    </div>
                    <h3 class="mb-2 text-lg font-bold">Professional Grade</h3>
                    <p class="text-sm text-muted-foreground">Trusted by engine builders, tuners, and automotive professionals worldwide.</p>
                </div>
            </div>
        </Stack>
    </MainLayout>
</template>
