<script setup>
import { ref } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import LuxuryNavbar from '@/Components/Hotel/LuxuryNavbar.vue';
import BookingBar from '@/Components/Hotel/BookingBar.vue';
import RoomCardEditorial from '@/Components/Hotel/RoomCardEditorial.vue';
import ExperienceShowcase from '@/Components/Hotel/ExperienceShowcase.vue';
import DiningEditorial from '@/Components/Hotel/DiningEditorial.vue';
import ImmersiveGallery from '@/Components/Hotel/ImmersiveGallery.vue';
import LuxuryFooter from '@/Components/Hotel/LuxuryFooter.vue';
import { ArrowDown, Quote, MapPin, Compass, ShieldCheck, Sparkles, Phone, Mail } from 'lucide-vue-next';

const props = defineProps({
  settings: Object,
  navigation: Array
});

const pageData = usePage();
const user = pageData.props.auth?.user;

const villasList = [
  {
    id: 1,
    name: 'Grand Ocean Pool Villa',
    category: 'BEACHFRONT SANCTUARY',
    badge: 'Signature Residence',
    description: 'Perched along the serene coast, this grand sanctuary features a private infinity plunge pool, open-air pavilion, and panoramic Indian Ocean views framed by native teak architecture.',
    size: '220 m²',
    capacity: '2-3 Guests',
    bed: 'Super King Bed',
    price: 4500000,
    image: 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1200&q=80',
    amenities: [
      'Private Infinity Plunge Pool',
      'Panoramic Ocean Sunset View',
      'Personal Butler Service 24/7',
      'Marble Bath & Outdoor Rain Shower',
      'Gourmet Daily Breakfast Included',
      'Complimentary High-Speed WiFi'
    ]
  },
  {
    id: 2,
    name: 'Sanctuary Garden Suite',
    category: 'BOTANICAL HIDEAWAY',
    badge: 'Intimate Luxury',
    description: 'Surrounded by fragrant frangipani trees and whispering lotus ponds, offering deep relaxation with a private outdoor terrazzo bathtub and expansive lounge veranda.',
    size: '140 m²',
    capacity: '2 Guests',
    bed: 'King Bed',
    price: 3200000,
    image: 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1200&q=80',
    amenities: [
      'Private Tropical Garden Patio',
      'Outdoor SunKEN Terrazzo Bathtub',
      'Artisan Espresso & Organic Tea Bar',
      'Handcrafted Teak Furniture',
      'Evening Aromatherapy Turndown',
      'Yoga Mat & Wellness Accessories'
    ]
  },
  {
    id: 3,
    name: 'Royal Two-Bedroom Residence',
    category: 'FAMILY & GROUP ESTATE',
    badge: 'Ultimate Haven',
    description: 'The pinnacle of boutique hospitality. Features two lavish master suites, an expansive 12-meter private swimming pool, and dedicated living and dining pavilions.',
    size: '380 m²',
    capacity: '4-5 Guests',
    bed: '2 Super King Beds',
    price: 7800000,
    image: 'https://images.unsplash.com/photo-1540541338287-41700207dee6?auto=format&fit=crop&w=1200&q=80',
    amenities: [
      '12-Meter Private Pool & Sun Deck',
      'Two Independent Master Suites',
      'Private Chef On Request',
      'Roundtrip Airport Transfer Included',
      'Spacious Open-Air Living Pavilion',
      'Exclusive Sunset Cocktail Hour'
    ]
  }
];

const testimonials = [
  {
    quote: "Vije Boutique Resort is the epitome of quiet luxury. From the breathtaking pool sunset to the impeccably warm butler service, every detail felt like a dream.",
    author: "Elena Rostova",
    location: "Zurich, Switzerland"
  },
  {
    quote: "If you appreciate slow living, organic architecture, and genuine Balinese hospitality, this is paradise. We left completely renewed.",
    author: "Julian & Marcus Vance",
    location: "London, United Kingdom"
  }
];
</script>

<template>
  <Head>
    <title>Vije Boutique Resort | Luxury Resort & Direct Booking System</title>
    <meta name="description" content="Experience quiet luxury and natural serenity at Vije Boutique Resort in Bali. Exclusive suites, private pool villas, fine dining, and direct booking." />
  </Head>

  <div class="min-h-screen bg-luxury-offwhite text-luxury-charcoal font-sans selection:bg-luxury-gold selection:text-luxury-charcoal">
    
    <!-- Quiet Luxury Navbar -->
    <LuxuryNavbar :user="user" />

    <!-- 1. Hero Section (Full-screen Immersive Photography) -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
      <!-- Hero Background Image with Subtle Zoom Animation -->
      <div class="absolute inset-0 z-0">
        <img 
          src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=2000&q=90" 
          alt="Vije Boutique Resort Infinity Pool" 
          class="w-full h-full object-cover object-center transform scale-105 animate-pulse duration-[10000ms]"
        />
        <!-- Elegant Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-luxury-charcoal/90 via-black/40 to-black/30"></div>
      </div>

      <!-- Hero Content -->
      <div class="relative z-10 text-center text-white max-w-4xl mx-auto px-6 pt-20">
        <span class="text-xs lg:text-sm uppercase tracking-[0.4em] text-luxury-sand font-medium block mb-4 animate-fade-in">
          BALI, INDONESIA
        </span>
        <h1 class="font-serif text-5xl md:text-7xl lg:text-8xl font-light tracking-wide leading-tight mb-6 text-white drop-shadow-sm">
          Where Luxury Meets Serenity
        </h1>
        <div class="w-20 h-[1px] bg-luxury-gold/70 mx-auto mb-8"></div>
        <p class="text-luxury-ivory/90 text-sm md:text-base lg:text-lg max-w-2xl mx-auto font-light leading-relaxed mb-10">
          An intimate sanctuary designed for travelers who appreciate the beauty of slow living, timeless elegance, and unhurried calm.
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a 
            href="#villas"
            class="px-8 py-3.5 bg-luxury-gold text-luxury-charcoal uppercase tracking-[0.25em] text-xs font-semibold hover:bg-luxury-bronze hover:text-white transition-all duration-300 shadow-lg"
          >
            Explore Residences
          </a>
          <a 
            href="#booking"
            class="px-8 py-3.5 border border-white/40 hover:border-luxury-gold text-white hover:text-luxury-gold uppercase tracking-[0.25em] text-xs font-semibold backdrop-blur-sm transition-all duration-300"
          >
            Book Your Stay
          </a>
        </div>
      </div>

      <!-- Scroll Indicator -->
      <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 flex flex-col items-center text-white/60 text-[10px] uppercase tracking-[0.3em] space-y-2">
        <span>Scroll</span>
        <ArrowDown class="w-4 h-4 animate-bounce text-luxury-gold" />
      </div>
    </section>

    <!-- Floating Booking Bar -->
    <div class="relative -mt-16 z-30">
      <BookingBar />
    </div>

    <!-- 2. Editorial Introduction Section -->
    <section class="py-28 bg-luxury-offwhite font-sans text-luxury-charcoal">
      <div class="max-w-5xl mx-auto px-6 text-center">
        <span class="text-xs uppercase tracking-[0.35em] text-luxury-gold font-medium block mb-4">
          THE VIJE PHILOSOPHY
        </span>
        <h2 class="font-serif text-3xl md:text-5xl font-light text-luxury-charcoal leading-snug mb-8">
          "An intimate retreat crafted for those who seek quiet elegance and meaningful connection with nature."
        </h2>
        <div class="w-16 h-[1px] bg-luxury-gold/50 mx-auto mb-8"></div>
        <p class="text-luxury-charcoal/70 text-sm md:text-base leading-relaxed font-light max-w-3xl mx-auto">
          Nestled amidst lush botanical gardens and facing the infinite horizon of the ocean, Vije Boutique Resort marries traditional Balinese craftsmanship with modern luxury. Here, time slows down, allowing you to immerse in pure stillness, epicurean gastronomy, and holistic renewal.
        </p>
      </div>
    </section>

    <!-- 3. Rooms & Villas Showcase Section -->
    <RoomCardEditorial :villas="villasList" />

    <!-- 4. Curated Experience Section -->
    <ExperienceShowcase />

    <!-- 5. Fine Dining & Culinary Experience Section -->
    <DiningEditorial />

    <!-- 6. Immersive Editorial Gallery Section -->
    <ImmersiveGallery />

    <!-- 7. Location & Storytelling Section -->
    <section id="location" class="py-24 bg-luxury-offwhite font-sans text-luxury-charcoal">
      <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          <div class="lg:col-span-5 space-y-6">
            <span class="text-xs uppercase tracking-[0.3em] text-luxury-gold font-medium block">
              PRISTINE LOCATION
            </span>
            <h2 class="font-serif text-4xl lg:text-5xl font-light text-luxury-charcoal tracking-wide">
              A Private Sanctuary By The Sea
            </h2>
            <div class="w-12 h-[1px] bg-luxury-gold"></div>
            <p class="text-luxury-charcoal/70 text-sm leading-relaxed font-light">
              Situated on Bali’s tranquil coast, Vije Boutique Resort is secluded from crowded tourist hubs while offering effortless access to cultural landmarks, sacred temples, and vibrant coastal villages.
            </p>

            <div class="space-y-4 pt-4 border-t border-luxury-sand/40 text-xs text-luxury-charcoal/80">
              <div class="flex items-center space-x-3">
                <MapPin class="w-4 h-4 text-luxury-gold shrink-0" />
                <span>45 minutes from Ngurah Rai International Airport (DPS)</span>
              </div>
              <div class="flex items-center space-x-3">
                <Compass class="w-4 h-4 text-luxury-gold shrink-0" />
                <span>15 minutes to Cultural Temples & Artisan Markets</span>
              </div>
            </div>
          </div>

          <div class="lg:col-span-7 relative shadow-xl overflow-hidden bg-luxury-sand/30 aspect-[16/10] border border-luxury-sand/50">
            <img 
              src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80" 
              alt="Bali Sanctuary Location" 
              class="w-full h-full object-cover"
              loading="lazy"
            />
            <div class="absolute bottom-6 right-6 bg-white/95 backdrop-blur-md p-4 text-xs font-serif border border-luxury-gold/40 max-w-xs shadow-md">
              <p class="italic text-luxury-charcoal">"Surrounded by emerald palms, sacred waters, and golden sunsets."</p>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- 8. Testimonials Section -->
    <section class="py-24 bg-luxury-cream/40 border-t border-luxury-sand/30 font-sans text-luxury-charcoal">
      <div class="max-w-4xl mx-auto px-6 text-center space-y-12">
        <Quote class="w-10 h-10 text-luxury-gold mx-auto opacity-70" />
        
        <div class="space-y-8">
          <div v-for="(item, i) in testimonials" :key="i" class="space-y-4">
            <p class="font-serif text-2xl md:text-3xl font-light italic text-luxury-charcoal leading-relaxed">
              "{{ item.quote }}"
            </p>
            <div class="text-xs uppercase tracking-[0.25em] text-luxury-gold font-semibold">
              {{ item.author }} — <span class="text-luxury-charcoal/60 font-normal">{{ item.location }}</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 9. Booking Conversion CTA Section -->
    <section class="relative py-28 overflow-hidden bg-luxury-charcoal text-white text-center">
      <div class="absolute inset-0 z-0">
        <img 
          src="https://images.unsplash.com/photo-1540541338287-41700207dee6?auto=format&fit=crop&w=1800&q=80" 
          alt="Resort Retreat Background" 
          class="w-full h-full object-cover opacity-30"
        />
      </div>

      <div class="relative z-10 max-w-3xl mx-auto px-6 space-y-8">
        <span class="text-xs uppercase tracking-[0.4em] text-luxury-gold font-medium block">
          RESERVE YOUR EXPERIENCE
        </span>
        <h2 class="font-serif text-4xl md:text-6xl font-light tracking-wide text-white">
          Your Private Escape Awaits
        </h2>
        <p class="text-luxury-ivory/80 text-sm md:text-base font-light max-w-xl mx-auto leading-relaxed">
          Book directly with us to enjoy exclusive best rate guarantees, complimentary breakfast, and personalized concierge planning.
        </p>

        <div class="pt-4">
          <a 
            href="#booking"
            class="inline-block px-10 py-4 bg-luxury-gold text-luxury-charcoal uppercase tracking-[0.25em] text-xs font-semibold hover:bg-luxury-bronze hover:text-white transition-all duration-300 shadow-2xl"
          >
            Book Your Stay Now
          </a>
        </div>
      </div>
    </section>

    <!-- Quiet Luxury Footer -->
    <LuxuryFooter />

  </div>
</template>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
  animation: fadeIn 0.8s ease-out forwards;
}
</style>
