<script setup>
import { Utensils, Coffee, Wine, Clock } from 'lucide-vue-next';

const diningVenues = [
  {
    id: 1,
    name: 'Les Palmes Restaurant',
    tagline: 'Contemporary Balinese & European Fine Dining',
    desc: 'Celebrating fresh ocean catch, heritage spices, and seasonal organic harvests prepared by international master chefs.',
    hours: '07:00 AM – 11:00 PM',
    image: 'https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?auto=format&fit=crop&w=1000&q=80',
    icon: Utensils
  },
  {
    id: 2,
    name: 'Bamboo Sunset Lounge & Bar',
    tagline: 'Artisan Mixology & Tapas By The Sea',
    desc: 'Handcrafted tropical cocktails, rare vintage wines, and light bites served alongside breathtaking evening ocean sunsets.',
    hours: '12:00 PM – 12:00 AM',
    image: 'https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?auto=format&fit=crop&w=1000&q=80',
    icon: Wine
  }
];
</script>

<template>
  <section id="dining" class="py-24 bg-luxury-offwhite font-sans text-luxury-charcoal">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-20">
        <span class="text-xs uppercase tracking-[0.3em] text-luxury-gold font-medium block mb-3">
          EPICUREAN EXCELLENCE
        </span>
        <h2 class="font-serif text-4xl lg:text-5xl font-light tracking-wide text-luxury-charcoal mb-6">
          Culinary Experiences
        </h2>
        <div class="w-16 h-[1px] bg-luxury-gold/50 mx-auto mb-6"></div>
        <p class="text-luxury-charcoal/70 text-sm lg:text-base leading-relaxed font-light">
          From sunrise floating breakfasts to beachfront candlelit dinners, savor exceptional flavors inspired by Bali’s rich soil and ocean bounty.
        </p>
      </div>

      <!-- Dining Cards Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div 
          v-for="venue in diningVenues" 
          :key="venue.id"
          class="bg-white border border-luxury-sand/40 overflow-hidden shadow-sm group hover:shadow-md transition-all duration-500 flex flex-col"
        >
          <div class="aspect-[16/10] overflow-hidden bg-luxury-sand/30 relative">
            <img 
              :src="venue.image" 
              :alt="venue.name" 
              class="w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-700 ease-out"
              loading="lazy"
            />
            <div class="absolute inset-0 bg-black/20"></div>
          </div>

          <div class="p-8 lg:p-10 flex-1 flex flex-col justify-between space-y-6">
            <div>
              <span class="text-[10px] uppercase tracking-[0.25em] text-luxury-gold font-semibold block mb-1">
                {{ venue.tagline }}
              </span>
              <h3 class="font-serif text-3xl font-light text-luxury-charcoal mb-4">
                {{ venue.name }}
              </h3>
              <p class="text-luxury-charcoal/70 text-xs lg:text-sm leading-relaxed font-light">
                {{ venue.desc }}
              </p>
            </div>

            <div class="pt-4 border-t border-luxury-sand/40 flex items-center justify-between text-xs text-luxury-charcoal/80">
              <div class="flex items-center space-x-2">
                <Clock class="w-4 h-4 text-luxury-gold" />
                <span>{{ venue.hours }}</span>
              </div>
              <a 
                href="#booking"
                class="text-[10px] uppercase tracking-[0.2em] font-semibold text-luxury-charcoal hover:text-luxury-gold transition-colors border-b border-luxury-gold pb-0.5"
              >
                Reserve Table
              </a>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>
</template>
