<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Menu, X, Calendar, Compass, UtensilsCrossed, Image as ImageIcon, MapPin, Info } from 'lucide-vue-next';

defineProps({
  user: Object
});

const isScrolled = ref(false);
const mobileMenuOpen = ref(false);

const handleScroll = () => {
  if (window.scrollY > 50) {
    isScrolled.value = true;
  } else {
    isScrolled.value = false;
  }
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});

const navLinks = [
  { name: 'Villas & Suites', href: '#villas', icon: Compass },
  { name: 'Experiences', href: '#experiences', icon: Compass },
  { name: 'Dining', href: '#dining', icon: UtensilsCrossed },
  { name: 'Gallery', href: '#gallery', icon: ImageIcon },
  { name: 'Location', href: '#location', icon: MapPin },
  { name: 'About', href: '#about', icon: Info },
];
</script>

<template>
  <header 
    :class="[
      'fixed top-0 left-0 right-0 z-50 transition-all duration-500 font-sans',
      isScrolled 
        ? 'bg-luxury-offwhite/95 backdrop-blur-md border-b border-luxury-sand/40 py-4 shadow-sm text-luxury-charcoal' 
        : 'bg-gradient-to-b from-black/60 via-black/20 to-transparent py-6 text-white'
    ]"
  >
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between">
      
      <!-- Brand Logo -->
      <a href="#" class="flex items-center space-x-3 group">
        <img src="/images/vije-logo.webp" alt="Vije Boutique Resort" class="h-10 lg:h-12 w-auto object-contain transition-transform group-hover:scale-105" />
        <div class="flex flex-col">
          <span class="font-serif text-xl lg:text-2xl font-light tracking-widest uppercase transition-colors" :class="isScrolled ? 'text-luxury-charcoal' : 'text-white'">
            Vije
          </span>
          <span class="text-[8px] lg:text-[9px] uppercase tracking-[0.3em] font-medium" :class="isScrolled ? 'text-luxury-gold' : 'text-luxury-sand'">
            Boutique Resort
          </span>
        </div>
      </a>

      <!-- Desktop Navigation Menu -->
      <nav class="hidden md:flex items-center space-x-8">
        <a 
          v-for="link in navLinks" 
          :key="link.name"
          :href="link.href"
          :class="[
            'text-xs uppercase tracking-[0.2em] font-medium transition-colors hover:text-luxury-gold relative py-1 group',
            isScrolled ? 'text-luxury-charcoal/90' : 'text-white/90'
          ]"
        >
          {{ link.name }}
          <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-luxury-gold transition-all duration-300 group-hover:w-full"></span>
        </a>
      </nav>

      <!-- Desktop Right Actions -->
      <div class="hidden md:flex items-center space-x-6">
        <template v-if="user">
          <Link 
            :href="route('dashboard')" 
            class="text-xs uppercase tracking-widest font-medium border-b border-luxury-gold pb-0.5 hover:text-luxury-gold transition-colors"
            :class="isScrolled ? 'text-luxury-charcoal' : 'text-white'"
          >
            Dashboard
          </Link>
        </template>
        
        <a 
          href="#booking"
          class="inline-flex items-center justify-center px-6 py-2.5 text-xs uppercase tracking-[0.2em] font-medium text-luxury-charcoal bg-luxury-gold hover:bg-luxury-bronze hover:text-white transition-all duration-300 shadow-sm"
        >
          Book Your Stay
        </a>
      </div>

      <!-- Mobile Hamburger Button -->
      <button 
        @click="mobileMenuOpen = !mobileMenuOpen"
        class="md:hidden p-2 rounded-lg focus:outline-none"
        :class="isScrolled ? 'text-luxury-charcoal' : 'text-white'"
        aria-label="Toggle menu"
      >
        <Menu v-if="!mobileMenuOpen" class="w-6 h-6" />
        <X v-else class="w-6 h-6" />
      </button>

    </div>

    <!-- Mobile Drawer Overlay -->
    <div 
      v-if="mobileMenuOpen"
      class="fixed inset-0 top-full bg-luxury-offwhite text-luxury-charcoal z-40 flex flex-col p-8 border-t border-luxury-sand/30 shadow-2xl md:hidden animate-fade-in"
    >
      <nav class="flex flex-col space-y-6">
        <a 
          v-for="link in navLinks" 
          :key="link.name"
          :href="link.href"
          @click="mobileMenuOpen = false"
          class="text-sm uppercase tracking-[0.25em] font-medium border-b border-luxury-sand/20 pb-3 hover:text-luxury-gold transition-colors flex items-center justify-between"
        >
          <span>{{ link.name }}</span>
          <component :is="link.icon" class="w-4 h-4 text-luxury-gold" />
        </a>
      </nav>

      <div class="mt-8 pt-6 border-t border-luxury-sand/40 flex flex-col space-y-4">
        <a 
          href="#booking"
          @click="mobileMenuOpen = false"
          class="w-full text-center py-3.5 bg-luxury-gold text-luxury-charcoal uppercase tracking-[0.2em] text-xs font-semibold hover:bg-luxury-bronze hover:text-white transition-all"
        >
          Book Your Stay
        </a>
        <div v-if="user" class="text-center">
          <Link :href="route('dashboard')" class="text-xs uppercase tracking-widest text-luxury-charcoal/70 hover:text-luxury-gold">
            Go to Account Dashboard
          </Link>
        </div>
      </div>
    </div>
  </header>
</template>
