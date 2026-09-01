<script setup>
import { Sparkles, Sun, Heart, Waves, Compass } from 'lucide-vue-next';

const experiences = [
  {
    id: 1,
    title: 'Holistic Spa & Botanical Wellness',
    category: 'RENEWAL & BALANCE',
    desc: 'Immerse in ancient Balinese healing rituals, organic botanical essential oils, and therapeutic massages beside whispering bamboo groves.',
    image: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80',
    icon: Heart
  },
  {
    id: 2,
    title: 'Private Beachfront & Candlelight Dining',
    category: 'CULINARY JOURNEY',
    desc: 'An intimate five-course epicurean experience under stars, accompanied by the gentle rhythm of ocean waves and personalized butler service.',
    image: 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80',
    icon: Sparkles
  },
  {
    id: 3,
    title: 'Sunset Infinity Lagoon Pool',
    category: 'LEISURE & CALM',
    desc: 'Unwind at our ocean-facing tiered pool featuring floating daybeds, artisan craft cocktails, and panoramic sunset views.',
    image: 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=1200&q=80',
    icon: Waves
  },
  {
    id: 4,
    title: 'Cultural Heritage & Island Excursions',
    category: 'LOCAL IMMERSION',
    desc: 'Guided private journeys to sacred temples, lush rice terraces, and hidden waterfalls with our resident cultural specialist.',
    image: 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
    icon: Compass
  }
];
</script>

<template>
  <section id="experiences" class="py-24 bg-luxury-cream/40 font-sans text-luxury-charcoal border-t border-luxury-sand/30">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
      
      <!-- Section Header -->
      <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-16 pb-8 border-b border-luxury-sand/40">
        <div class="max-w-2xl">
          <span class="text-xs uppercase tracking-[0.3em] text-luxury-gold font-medium block mb-3">
            BEYOND ACCOMMODATION
          </span>
          <h2 class="font-serif text-4xl lg:text-5xl font-light tracking-wide text-luxury-charcoal">
            Curated Resort Experiences
          </h2>
        </div>
        <p class="text-luxury-charcoal/70 text-sm max-w-md mt-4 lg:mt-0 leading-relaxed font-light">
          We invite you to experience the art of slow living through thoughtfully curated moments of luxury, wellness, and serenity.
        </p>
      </div>

      <!-- Experience Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
        <div 
          v-for="item in experiences" 
          :key="item.id"
          class="group bg-white border border-luxury-sand/40 overflow-hidden shadow-sm hover:shadow-md transition-all duration-500 flex flex-col"
        >
          <div class="relative aspect-[16/9] overflow-hidden bg-luxury-sand/30">
            <img 
              :src="item.image" 
              :alt="item.title" 
              class="w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-700 ease-out"
              loading="lazy"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-60"></div>
            <div class="absolute top-4 left-4 bg-luxury-gold/90 text-luxury-charcoal px-3 py-1 text-[9px] uppercase tracking-[0.25em] font-semibold">
              {{ item.category }}
            </div>
          </div>

          <div class="p-8 flex-1 flex flex-col justify-between space-y-4">
            <div>
              <h3 class="font-serif text-2xl text-luxury-charcoal font-light mb-3 group-hover:text-luxury-gold transition-colors">
                {{ item.title }}
              </h3>
              <p class="text-luxury-charcoal/70 text-xs leading-relaxed font-light">
                {{ item.desc }}
              </p>
            </div>

            <div class="pt-4 border-t border-luxury-sand/30 flex items-center justify-between">
              <span class="text-[10px] uppercase tracking-[0.2em] font-medium text-luxury-gold">
                Inquire Experience
              </span>
              <component :is="item.icon" class="w-4 h-4 text-luxury-gold" />
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>
</template>
