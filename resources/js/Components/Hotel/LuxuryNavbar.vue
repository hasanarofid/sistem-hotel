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
      'fixed top-0 left-0 right-0 z-50 transition-all duration-300 font-sans',
      (isScrolled || mobileMenuOpen)
        ? 'bg-[#FAF8F5] md:bg-luxury-offwhite/95 md:backdrop-blur-md border-b border-luxury-sand/50 py-3.5 sm:py-4 shadow-sm text-luxury-charcoal' 
        : 'bg-gradient-to-b from-black/70 via-black/30 to-transparent py-5 sm:py-6 text-white'
    ]"
  >
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-12 flex items-center justify-between">
      
      <!-- Brand Logo -->
      <a href="#" class="flex items-center space-x-2.5 sm:space-x-3 group">
        <img 
          src="/images/vije-logo.webp" 
          alt="Vije Boutique Resort" 
          class="h-9 sm:h-10 lg:h-12 w-auto object-contain transition-all duration-300 group-hover:scale-105"
          :class="(isScrolled || mobileMenuOpen) ? 'brightness-0 opacity-90' : 'brightness-100'"
        />
        <div class="flex flex-col">
          <span 
            class="font-serif text-lg sm:text-xl lg:text-2xl font-light tracking-widest uppercase transition-colors" 
            :class="(isScrolled || mobileMenuOpen) ? 'text-luxury-charcoal' : 'text-white'"
          >
            Vije
          </span>
          <span 
            class="text-[7.5px] sm:text-[8px] lg:text-[9px] uppercase tracking-[0.3em] font-medium transition-colors" 
            :class="(isScrolled || mobileMenuOpen) ? 'text-luxury-gold' : 'text-luxury-sand'"
          >
            Boutique Resort
          </span>
        </div>
      </a>

      <!-- Desktop Navigation Menu -->
      <nav class="hidden md:flex items-center space-x-7 lg:space-x-8">
        <a 
          v-for="link in navLinks" 
          :key="link.name"
          :href="link.href"
          :class="[
            'text-[11px] lg:text-xs uppercase tracking-[0.2em] font-medium transition-colors hover:text-luxury-gold relative py-1 group',
            isScrolled ? 'text-luxury-charcoal/90' : 'text-white/90'
          ]"
        >
          {{ link.name }}
          <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-luxury-gold transition-all duration-300 group-hover:w-full"></span>
        </a>
      </nav>

      <!-- Desktop Right Actions -->
      <div class="hidden md:flex items-center space-x-5 lg:space-x-6">
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
          class="inline-flex items-center justify-center px-5 lg:px-6 py-2.5 text-[11px] lg:text-xs uppercase tracking-[0.2em] font-semibold text-luxury-charcoal bg-luxury-gold hover:bg-luxury-bronze hover:text-white transition-all duration-300 shadow-sm"
        >
          Book Your Stay
        </a>
      </div>

      <!-- Mobile Hamburger Button -->
      <button 
        @click="mobileMenuOpen = !mobileMenuOpen"
        class="md:hidden p-2 -mr-1 rounded-lg focus:outline-none transition-colors"
        :class="(isScrolled || mobileMenuOpen) ? 'text-luxury-charcoal hover:text-luxury-gold' : 'text-white hover:text-luxury-sand'"
        aria-label="Toggle menu"
      >
        <Menu v-if="!mobileMenuOpen" class="w-6 h-6" />
        <X v-else class="w-6 h-6" />
      </button>

    </div>

    <!-- Mobile Drawer Fullscreen Overlay -->
    <transition
      enter-active-class="transition duration-300 ease-out"
      enter-from-class="opacity-0 -translate-y-2"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition duration-200 ease-in"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 -translate-y-2"
    >
      <div 
        v-if="mobileMenuOpen"
        class="fixed inset-x-0 top-[60px] sm:top-[68px] bottom-0 bg-[#FAF8F5] text-luxury-charcoal z-50 flex flex-col justify-between p-6 sm:p-8 overflow-y-auto border-t border-[#E6DEC9] shadow-2xl md:hidden"
        style="height: calc(100dvh - 60px);"
      >
        <div class="flex flex-col space-y-3">
          <div class="pb-2 flex items-center justify-between border-b border-[#E6DEC9]/60">
            <span class="text-[10px] uppercase tracking-[0.3em] text-luxury-gold font-mono font-medium">Navigasi Resort</span>
            <span class="text-[9px] uppercase tracking-wider text-luxury-charcoal/50">Bali, Indonesia</span>
          </div>

          <nav class="flex flex-col divide-y divide-[#E6DEC9]/50">
            <a 
              v-for="link in navLinks" 
              :key="link.name"
              :href="link.href"
              @click="mobileMenuOpen = false"
              class="py-3.5 text-xs sm:text-sm tracking-[0.2em] uppercase font-medium text-luxury-charcoal hover:text-luxury-gold transition-colors flex items-center justify-between group"
            >
              <span class="group-hover:translate-x-1 transition-transform">{{ link.name }}</span>
              <component :is="link.icon" class="w-4 h-4 text-luxury-gold/70 group-hover:text-luxury-gold transition-colors" />
            </a>
          </nav>
        </div>

        <div class="mt-8 pt-6 border-t border-[#E6DEC9] flex flex-col space-y-3 pb-6">
          <a 
            href="#booking"
            @click="mobileMenuOpen = false"
            class="w-full text-center py-3.5 bg-luxury-gold text-luxury-charcoal uppercase tracking-[0.2em] text-xs font-semibold hover:bg-luxury-bronze hover:text-white transition-all shadow-md"
          >
            Book Your Stay
          </a>
          <div v-if="user" class="text-center pt-1">
            <Link :href="route('dashboard')" class="text-xs uppercase tracking-widest text-luxury-charcoal/80 hover:text-luxury-gold font-medium">
              Buka Dashboard Akun →
            </Link>
          </div>
        </div>
      </div>
    </transition>
  </header>
</template>
