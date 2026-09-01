<script setup>
import { ref } from 'vue';
import { Maximize2, X } from 'lucide-vue-next';

const galleryImages = [
  {
    id: 1,
    title: 'Infinity Ocean Pool at Dusk',
    category: 'Resort Grounds',
    src: 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=1200&q=80',
    aspect: 'col-span-1 lg:col-span-2 row-span-2'
  },
  {
    id: 2,
    title: 'Grand Villa Ocean Suite',
    category: 'Residences',
    src: 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80',
    aspect: 'col-span-1 row-span-1'
  },
  {
    id: 3,
    title: 'Botanical Spa Pavilion',
    category: 'Wellness',
    src: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80',
    aspect: 'col-span-1 row-span-1'
  },
  {
    id: 4,
    title: 'Candlelit Beachfront Sanctuary',
    category: 'Dining',
    src: 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80',
    aspect: 'col-span-1 lg:col-span-2 row-span-1'
  },
  {
    id: 5,
    title: 'Private Garden Plunge Pool',
    category: 'Residences',
    src: 'https://images.unsplash.com/photo-1540541338287-41700207dee6?auto=format&fit=crop&w=800&q=80',
    aspect: 'col-span-1 row-span-1'
  }
];

const selectedImage = ref(null);

const openLightbox = (img) => {
  selectedImage.value = img;
};

const closeLightbox = () => {
  selectedImage.value = null;
};
</script>

<template>
  <section id="gallery" class="py-24 bg-luxury-cream/30 font-sans text-luxury-charcoal border-t border-luxury-sand/30">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-16">
        <span class="text-xs uppercase tracking-[0.3em] text-luxury-gold font-medium block mb-3">
          EDITORIAL IMPRESSIONS
        </span>
        <h2 class="font-serif text-4xl lg:text-5xl font-light tracking-wide text-luxury-charcoal mb-4">
          Resort Gallery
        </h2>
        <div class="w-16 h-[1px] bg-luxury-gold/50 mx-auto"></div>
      </div>

      <!-- Editorial Masonry Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 auto-rows-[260px]">
        <div 
          v-for="img in galleryImages" 
          :key="img.id"
          :class="[
            'relative overflow-hidden group cursor-pointer bg-luxury-sand/30 shadow-sm',
            img.aspect
          ]"
          @click="openLightbox(img)"
        >
          <img 
            :src="img.src" 
            :alt="img.title" 
            class="w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-700 ease-out"
            loading="lazy"
          />
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-6 text-white">
            <span class="text-[9px] uppercase tracking-[0.25em] text-luxury-gold font-medium block mb-1">
              {{ img.category }}
            </span>
            <h4 class="font-serif text-xl font-light tracking-wide">
              {{ img.title }}
            </h4>
            <div class="mt-3 flex items-center space-x-2 text-[10px] uppercase tracking-widest text-white/80">
              <Maximize2 class="w-3.5 h-3.5 text-luxury-gold" />
              <span>Expand View</span>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Lightbox Modal -->
    <div 
      v-if="selectedImage"
      class="fixed inset-0 z-50 bg-black/95 flex items-center justify-center p-4 lg:p-12 animate-fade-in"
      @click.self="closeLightbox"
    >
      <button 
        @click="closeLightbox" 
        class="absolute top-6 right-6 text-white/80 hover:text-white p-2 rounded-full bg-white/10 hover:bg-white/20 transition-colors"
      >
        <X class="w-6 h-6" />
      </button>

      <div class="max-w-5xl max-h-[85vh] flex flex-col items-center">
        <img 
          :src="selectedImage.src" 
          :alt="selectedImage.title" 
          class="max-w-full max-h-[75vh] object-contain shadow-2xl border border-luxury-gold/30"
        />
        <div class="mt-4 text-center text-white">
          <span class="text-[10px] uppercase tracking-[0.25em] text-luxury-gold font-semibold block mb-1">
            {{ selectedImage.category }}
          </span>
          <h3 class="font-serif text-2xl font-light">
            {{ selectedImage.title }}
          </h3>
        </div>
      </div>
    </div>
  </section>
</template>
