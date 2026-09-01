<script setup>
import { Check, ArrowRight, Maximize2, Users, BedDouble, Wifi, Sparkles } from 'lucide-vue-next';

defineProps({
  villas: {
    type: Array,
    default: () => []
  }
});
</script>

<template>
  <section id="villas" class="py-24 bg-luxury-offwhite font-sans text-luxury-charcoal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-20">
        <span class="text-xs uppercase tracking-[0.3em] text-luxury-gold font-medium block mb-3">
          SANCTUARIES OF TIMELINESS
        </span>
        <h2 class="font-serif text-4xl lg:text-5xl font-light tracking-wide text-luxury-charcoal mb-6">
          Suites & Private Villas
        </h2>
        <div class="w-16 h-[1px] bg-luxury-gold/50 mx-auto mb-6"></div>
        <p class="text-luxury-charcoal/70 text-sm lg:text-base leading-relaxed font-light">
          Each residence is crafted with organic stone, teak wood, and natural light — blending seamlessly into the lush greenery and calming ocean breezes of Bali.
        </p>
      </div>

      <!-- Alternating Editorial Villas List -->
      <div class="space-y-24">
        <div 
          v-for="(villa, index) in villas" 
          :key="villa.id"
          :class="[
            'grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center',
            index % 2 === 1 ? 'lg:flex-row-reverse' : ''
          ]"
        >
          
          <!-- Image Section (7 Columns) -->
          <div 
            :class="[
              'lg:col-span-7 relative group overflow-hidden shadow-lg',
              index % 2 === 1 ? 'lg:order-2' : 'lg:order-1'
            ]"
          >
            <div class="aspect-[16/10] overflow-hidden bg-luxury-sand/30">
              <img 
                :src="villa.image" 
                :alt="villa.name" 
                class="w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-700 ease-out"
                loading="lazy"
              />
            </div>
            <!-- Floating Badge -->
            <div class="absolute top-6 left-6 bg-luxury-charcoal/90 backdrop-blur-sm text-luxury-ivory px-4 py-1.5 text-[10px] uppercase tracking-[0.25em] font-medium">
              {{ villa.badge || 'Signature Residence' }}
            </div>
          </div>

          <!-- Content Section (5 Columns) -->
          <div 
            :class="[
              'lg:col-span-5 flex flex-col justify-center space-y-6',
              index % 2 === 1 ? 'lg:order-1 lg:pr-6' : 'lg:order-2 lg:pl-6'
            ]"
          >
            <div class="space-y-2">
              <span class="text-xs uppercase tracking-[0.25em] text-luxury-gold font-medium">
                {{ villa.category }}
              </span>
              <h3 class="font-serif text-3xl lg:text-4xl font-light text-luxury-charcoal tracking-wide">
                {{ villa.name }}
              </h3>
            </div>

            <p class="text-luxury-charcoal/70 text-sm leading-relaxed font-light">
              {{ villa.description }}
            </p>

            <!-- Key Specs Bar -->
            <div class="grid grid-cols-3 gap-4 py-4 border-y border-luxury-sand/40 text-xs text-luxury-charcoal/80">
              <div class="flex items-center space-x-2">
                <Maximize2 class="w-4 h-4 text-luxury-gold shrink-0" />
                <span>{{ villa.size }}</span>
              </div>
              <div class="flex items-center space-x-2">
                <Users class="w-4 h-4 text-luxury-gold shrink-0" />
                <span>{{ villa.capacity }}</span>
              </div>
              <div class="flex items-center space-x-2">
                <BedDouble class="w-4 h-4 text-luxury-gold shrink-0" />
                <span>{{ villa.bed }}</span>
              </div>
            </div>

            <!-- Amenities List -->
            <div class="grid grid-cols-2 gap-2 text-xs text-luxury-charcoal/70">
              <div v-for="amenity in villa.amenities" :key="amenity" class="flex items-center space-x-2">
                <Check class="w-3.5 h-3.5 text-luxury-gold shrink-0" />
                <span>{{ amenity }}</span>
              </div>
            </div>

            <!-- Price & CTA -->
            <div class="pt-4 flex items-center justify-between">
              <div>
                <span class="text-[10px] uppercase tracking-widest text-luxury-charcoal/60 block">Starting From</span>
                <span class="font-serif text-2xl text-luxury-charcoal font-medium">
                  IDR {{ Number(villa.price).toLocaleString('id-ID') }}
                </span>
                <span class="text-xs text-luxury-charcoal/60"> / night</span>
              </div>

              <a 
                :href="`#booking`"
                class="inline-flex items-center space-x-2 px-6 py-3 bg-luxury-charcoal hover:bg-luxury-gold text-white hover:text-luxury-charcoal transition-all duration-300 text-xs uppercase tracking-[0.2em] font-medium group"
              >
                <span>Reserve</span>
                <ArrowRight class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" />
              </a>
            </div>

          </div>

        </div>
      </div>

    </div>
  </section>
</template>
