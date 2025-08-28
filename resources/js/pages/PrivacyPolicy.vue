<script setup lang="ts">
import AdSlot from '@/components/shared/AdSlot.vue';
import Stack from '@/components/stencil/Stack.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Privacy Policy" />
    <MainLayout>
        <div class="mx-auto max-w-4xl px-4 py-8">
            <Stack>
                <AdSlot type="leaderboard" label="Privacy Policy Sidebar" />
                <div class="prose prose-lg max-w-none">
                    <h1 class="mb-8 text-4xl font-bold">Privacy Policy</h1>
                    <p class="mb-8 text-muted-foreground">Last updated: August 27, 2025</p>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Introduction</h2>
                        <p class="mb-4">
                            AutoCalc Pro ("we", "our", or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect,
                            use, and safeguard your information when you use our automotive calculator application.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Information We Collect</h2>

                        <div class="mb-6">
                            <h3 class="mb-3 text-xl font-medium">Calculator Usage Data</h3>
                            <p>
                                We collect the input values you enter into our calculators (compression ratios, horsepower figures, engine
                                specifications) solely for the purpose of performing calculations. This data is processed locally in your browser and
                                is not stored on our servers.
                            </p>
                        </div>

                        <div class="mb-6">
                            <h3 class="mb-3 text-xl font-medium">Technical Information</h3>
                            <p>
                                We may collect technical information such as your browser type, device information, and usage analytics to improve our
                                service performance and user experience.
                            </p>
                        </div>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">How We Use Your Information</h2>
                        <ul class="ml-4 list-inside list-disc space-y-2">
                            <li>To provide accurate automotive calculations and results</li>
                            <li>To improve the functionality and performance of our calculators</li>
                            <li>To analyze usage patterns and optimize user experience</li>
                            <li>To ensure the security and reliability of our service</li>
                        </ul>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Data Storage and Security</h2>
                        <p>
                            Your calculation inputs are processed locally in your browser and are not transmitted to or stored on our servers. We
                            implement appropriate security measures to protect any technical data we do collect.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Third-Party Services</h2>
                        <p>
                            AutoCalc Pro may use third-party analytics services to help us understand how our application is used. These services may
                            collect information about your usage patterns in accordance with their own privacy policies.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Your Rights</h2>
                        <p>
                            Since we process calculation data locally and don't store personal information on our servers, there is no personal data
                            for us to delete or modify. You can clear your browser's local storage at any time to remove any locally stored
                            preferences.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Changes to This Policy</h2>
                        <p>
                            We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy
                            on this page and updating the "Last updated" date.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Contact Us</h2>
                        <p>
                            If you have any questions about this Privacy Policy or our data practices, please contact us through our support channels.
                        </p>
                    </section>
                </div>
            </Stack>
        </div>
    </MainLayout>
</template>
