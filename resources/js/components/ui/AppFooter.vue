<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import AdSlot from '@/components/shared/AdSlot.vue';

</script>

<template>
  <div class="mt-16">

  
 <footer class=" border-t border-border ">
      <!-- {/* Footer Ad Slot */}
      -->
      <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid md:grid-cols-4 gap-8">
          <AdSlot 
            type="leaderboard" 
            class="bg-muted border border-border py-4 px-4"
            label="ADSENSE FOOTER SLOT"
          />
          <div>
            <div class="flex items-center space-x-2 mb-4">
              <AppLogoIcon class="size-24 text-accent" />
            </div>
            <p class="text-muted-foreground text-sm">
              Professional automotive calculators for enthusiasts and professionals. 
              Accurate calculations for performance modifications.
            </p>
          </div>
          
          <div>
            <h4 class="font-semibold mb-4 text-accent">Calculators</h4>
            <ul class="space-y-2 text-sm text-muted-foreground">
              <li><Link href="/compression-ratio-calculator" class=" transition-colors">Compression Ratio</Link></li>
              <li><Link href="/injector-size-calculator" class=" transition-colors">Injector Size</Link></li>
              <li><Link href="/turbo-size-calculator" class=" transition-colors">Turbo Sizing</Link></li>
              <li><Link href="/trap-speed-calculator" class=" transition-colors">Trap Speed</Link></li>
            </ul>
          </div>
          
          <!-- <div>
            <h4 class="font-semibold mb-4">Resources</h4>
            <ul class="space-y-2 text-sm text-muted-foreground">
              <li><a href="#" class=" transition-colors">Technical Articles</a></li>
              <li><a href="#" class=" transition-colors">Tuning Guides</a></li>
              <li><a href="#" class=" transition-colors">Performance Tips</a></li>
              <li><a href="#" class=" transition-colors">FAQ</a></li>
            </ul>
          </div> -->
          
          <div>
            <h4 class="font-semibold mb-4 text-accent">Support</h4>
            <ul class="space-y-2 text-sm text-muted-foreground">
              <!-- <li><a href="#" class=" transition-colors">Contact Us</a></li> -->
              <li><Link href="/privacy-policy" class=" transition-colors">Privacy Policy</Link></li>
              <li><Link href="/terms-of-service" class=" transition-colors">Terms of Service</Link></li>
              <!-- <li><Link href="/about" class=" transition-colors">About</Link></li> -->
            </ul>
          </div>
        </div>
        
        <div class="border-t border-border mt-8 pt-4 text-center text-muted-foreground text-sm">
          <p>&copy; {{ new Date().getFullYear() }} TunerCalc. All rights reserved. Professional automotive calculation tools.</p>
        </div>
      </div>
    </footer>
  </div>
</template>