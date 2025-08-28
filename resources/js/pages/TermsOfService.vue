<script setup lang="ts">
import AdSlot from '@/components/shared/AdSlot.vue';
import Stack from '@/components/stencil/Stack.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Terms of Service" />
    <MainLayout>
        <div class="mx-auto max-w-4xl px-4 py-8">
            <Stack>
                <AdSlot type="leaderboard" label="Privacy Policy Sidebar" />
                <div class="prose prose-lg max-w-none">
                    <h1 class="mb-8 text-4xl font-bold">Terms of Service</h1>
                    <p class="mb-8 text-muted-foreground">Last updated: August 27, 2025</p>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Acceptance of Terms</h2>
                        <p class="mb-4">
                            By accessing and using TunerCalc, you accept and agree to be bound by the terms and provision of this agreement. If you do
                            not agree to abide by the above, please do not use this service.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Service Description</h2>
                        <p class="mb-4">
                            TunerCalc provides automotive calculation tools including compression ratio calculators, fuel injector sizing, turbo
                            sizing, and horsepower-to-trap speed calculations. These tools are provided for educational and informational purposes to
                            assist automotive enthusiasts and professionals.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Use License</h2>
                        <p class="mb-4">
                            Permission is granted to temporarily access TunerCalc for personal, non-commercial transitory viewing only. This is the
                            grant of a license, not a transfer of title, and under this license you may not:
                        </p>
                        <ul class="ml-4 list-inside list-disc space-y-2">
                            <li>Modify or copy the materials</li>
                            <li>Use the materials for any commercial purpose or for any public display</li>
                            <li>Attempt to reverse engineer any software contained on TunerCalc</li>
                            <li>Remove any copyright or other proprietary notations from the materials</li>
                        </ul>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Accuracy Disclaimer</h2>
                        <div class="border-warning bg-warning/10 mb-4 rounded-lg border p-4">
                            <p class="text-warning font-semibold">Important:</p>
                            <p>
                                All calculations provided by TunerCalc are for reference purposes only. While we strive for accuracy, these
                                calculations should not be the sole basis for automotive modifications or engineering decisions. Always consult with
                                qualified automotive professionals and verify calculations independently before making any modifications to your
                                vehicle.
                            </p>
                        </div>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Limitation of Liability</h2>
                        <p class="mb-4">
                            In no event shall TunerCalc or its suppliers be liable for any damages (including, without limitation, damages for loss of
                            data or profit, or due to business interruption) arising out of the use or inability to use TunerCalc, even if TunerCalc
                            or an authorized representative has been notified orally or in writing of the possibility of such damage.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Vehicle Safety</h2>
                        <p class="mb-4">
                            Users acknowledge that automotive modifications can affect vehicle safety, emissions compliance, and warranty coverage.
                            TunerCalc calculations are provided as educational tools only. Users are solely responsible for ensuring that any
                            modifications comply with local laws and safety requirements.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Prohibited Uses</h2>
                        <p class="mb-4">You may not use TunerCalc:</p>
                        <ul class="ml-4 list-inside list-disc space-y-2">
                            <li>For any unlawful purpose or to solicit others to perform unlawful acts</li>
                            <li>To violate any international, federal, provincial, or state regulations, rules, laws, or local ordinances</li>
                            <li>To infringe upon or violate our intellectual property rights or the intellectual property rights of others</li>
                            <li>To harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate</li>
                            <li>To submit false or misleading information</li>
                        </ul>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Service Availability</h2>
                        <p class="mb-4">
                            We reserve the right to withdraw or amend our service, and any service or material we provide, in our sole discretion
                            without notice. We will not be liable if for any reason all or any part of TunerCalc is unavailable at any time or for any
                            period.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Modifications</h2>
                        <p class="mb-4">
                            TunerCalc may revise these Terms of Service at any time without notice. By using this application, you are agreeing to be
                            bound by the then current version of these Terms of Service.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Governing Law</h2>
                        <p class="mb-4">
                            These terms and conditions are governed by and construed in accordance with applicable local laws and you irrevocably
                            submit to the exclusive jurisdiction of the courts in that state or location.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="mb-4 text-2xl font-semibold">Contact Information</h2>
                        <p>If you have any questions about these Terms of Service, please contact us through our support channels.</p>
                    </section>
                </div>
            </Stack>
        </div>
    </MainLayout>
</template>
