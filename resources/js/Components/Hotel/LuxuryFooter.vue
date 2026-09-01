<script setup>
import { Link } from '@inertiajs/vue3';
import { MapPin, Phone, Mail, Instagram, Facebook, Globe, MessageSquare } from 'lucide-vue-next';
</script>

<template>
  <footer class="bg-luxury-charcoal text-luxury-ivory font-sans border-t border-luxury-sand/20 pt-20 pb-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 pb-16 border-b border-white/10">
        
        <!-- Brand & Slogan Column (5 Cols) -->
        <div class="lg:col-span-5 space-y-6">
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full border border-luxury-gold/50 flex items-center justify-center bg-luxury-gold/10">
              <span class="font-serif text-luxury-gold text-xl font-bold tracking-widest">V</span>
            </div>
            <div class="flex flex-col">
              <span class="font-serif text-2xl font-light tracking-widest uppercase text-white">
                Vije
              </span>
              <span class="text-[9px] uppercase tracking-[0.3em] font-medium text-luxury-gold">
                Boutique Resort
              </span>
            </div>
          </div>

          <p class="text-luxury-ivory/70 text-xs lg:text-sm leading-relaxed font-light max-w-md">
            An intimate retreat of timeless luxury and natural serenity in Bali. Designed for travelers who appreciate quiet elegance, epicurean dining, and holistic renewal.
          </p>

          <!-- Direct WhatsApp Concierge CTA -->
          <div class="pt-2">
            <a 
              href="https://Wa.me/628814959247" 
              target="_blank"
              class="inline-flex items-center space-x-2 px-5 py-2.5 bg-emerald-700/80 hover:bg-emerald-600 text-white text-xs uppercase tracking-widest font-medium transition-colors border border-emerald-500/30"
            >
              <MessageSquare class="w-4 h-4 text-emerald-300" />
              <span>WhatsApp Concierge</span>
            </a>
          </div>
        </div>

        <!-- Quick Navigation (3 Cols) -->
        <div class="lg:col-span-3 space-y-4">
          <h4 class="text-xs uppercase tracking-[0.25em] text-luxury-gold font-semibold">
            Navigation
          </h4>
          <ul class="space-y-2.5 text-xs text-luxury-ivory/80">
            <li><a href="#villas" class="hover:text-luxury-gold transition-colors">Villas & Suites</a></li>
            <li><a href="#experiences" class="hover:text-luxury-gold transition-colors">Curated Experiences</a></li>
            <li><a href="#dining" class="hover:text-luxury-gold transition-colors">Dining & Lounge</a></li>
            <li><a href="#gallery" class="hover:text-luxury-gold transition-colors">Resort Gallery</a></li>
            <li><a href="#location" class="hover:text-luxury-gold transition-colors">Location & Access</a></li>
            <li><a href="#booking" class="hover:text-luxury-gold transition-colors">Check Availability</a></li>
          </ul>
        </div>

        <!-- Contact & Location (4 Cols) -->
        <div class="lg:col-span-4 space-y-4">
          <h4 class="text-xs uppercase tracking-[0.25em] text-luxury-gold font-semibold">
            Resort Location & Contact
          </h4>
          <ul class="space-y-3 text-xs text-luxury-ivory/80">
            <li class="flex items-start space-x-3">
              <MapPin class="w-4 h-4 text-luxury-gold shrink-0 mt-0.5" />
              <span>Jl. Raya Vije Boutique Resort, Ubud / Seminyak Beachfront, Bali, Indonesia</span>
            </li>
            <li class="flex items-center space-x-3">
              <Phone class="w-4 h-4 text-luxury-gold shrink-0" />
              <span>+62 881-4959-247</span>
            </li>
            <li class="flex items-center space-x-3">
              <Mail class="w-4 h-4 text-luxury-gold shrink-0" />
              <span>reservation@vijeboutiqueresort.com</span>
            </li>
            <li class="flex items-center space-x-3">
              <Globe class="w-4 h-4 text-luxury-gold shrink-0" />
              <a href="https://hasanarofid.site" target="_blank" class="hover:text-luxury-gold transition-colors">hasanarofid.site</a>
            </li>
          </ul>
        </div>

      </div>

      <!-- Footer Bottom Legal & Copyright -->
      <div class="pt-8 flex flex-col md:flex-row items-center justify-between text-[11px] text-luxury-ivory/50 space-y-4 md:space-y-0">
        <div>
          &copy; {{ new Date().getFullYear() }} Vije Boutique Resort. Developed by <a href="https://hasanarofid.site" class="text-luxury-gold hover:underline">Hasan Arofid</a>. All Rights Reserved.
        </div>
        <div class="flex items-center space-x-6">
          <Link :href="route('privacy')" class="hover:text-luxury-gold transition-colors">Privacy Policy</Link>
          <Link :href="route('terms')" class="hover:text-luxury-gold transition-colors">Terms of Service</Link>
        </div>
      </div>

    </div>
  </footer>
</template>
