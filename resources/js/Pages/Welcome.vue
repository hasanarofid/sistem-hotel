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
import BookingConfirmationModal from '@/Components/Hotel/BookingConfirmationModal.vue';
import { ArrowDown, Quote, MapPin, Compass, ShieldCheck, Sparkles, Phone, Mail } from 'lucide-vue-next';

const props = defineProps({
  settings: Object,
  rooms: {
    type: Array,
    default: () => [],
  },
  navigation: Array
});

const pageData = usePage();
const user = pageData.props.auth?.user;

const isConfirmationModalOpen = ref(false);
const confirmedBooking = ref(null);

const handleBookingSuccess = (bookingData) => {
  confirmedBooking.value = bookingData;
  isConfirmationModalOpen.value = true;
};

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

    <!-- Floating Direct Booking Reservation Section (#booking) -->
    <div class="relative -mt-16 z-30">
      <BookingBar 
        :rooms="props.rooms" 
        @bookingSuccess="handleBookingSuccess" 
      />
    </div>

    <!-- 2. Editorial Introduction Section -->
    <section id="about" class="py-24 lg:py-32 px-6 lg:px-12 max-w-6xl mx-auto text-center">
      <span class="text-xs uppercase tracking-[0.35em] text-luxury-bronze font-medium block mb-3">
        SANCTUARY OF CALM
      </span>
      <h2 class="font-serif text-3xl md:text-5xl lg:text-6xl text-luxury-charcoal font-light leading-tight mb-8">
        An intimate retreat designed for those who appreciate the beauty of slow living.
      </h2>
      <div class="w-16 h-[1px] bg-luxury-gold/50 mx-auto mb-10"></div>
      <p class="text-luxury-charcoal/80 text-sm md:text-base lg:text-lg max-w-3xl mx-auto font-light leading-relaxed mb-16">
        Nestled along Bali’s tranquil coast, Vije Boutique Resort marries traditional Balinese craftsmanship with understated contemporary luxury. Every suite and villa is oriented toward nature, offering sweeping sea vistas, lush tropical gardens, and complete privacy.
      </p>

      <!-- Grid Highlights -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
        <div class="p-8 border border-luxury-sand/60 bg-white/50 backdrop-blur-sm space-y-3">
          <div class="w-10 h-10 rounded-full bg-luxury-ivory border border-luxury-sand flex items-center justify-center text-luxury-gold font-serif text-lg">01</div>
          <h3 class="font-serif text-xl text-luxury-charcoal font-medium">Bespoke Butler Service</h3>
          <p class="text-xs text-luxury-charcoal/70 leading-relaxed font-light">Dedicated 24-hour personal butler attending to your every preference with quiet discretion.</p>
        </div>

        <div class="p-8 border border-luxury-sand/60 bg-white/50 backdrop-blur-sm space-y-3">
          <div class="w-10 h-10 rounded-full bg-luxury-ivory border border-luxury-sand flex items-center justify-center text-luxury-gold font-serif text-lg">02</div>
          <h3 class="font-serif text-xl text-luxury-charcoal font-medium">Private Ocean Plunge Pools</h3>
          <p class="text-xs text-luxury-charcoal/70 leading-relaxed font-light">Each sanctuary features an exclusive infinity plunge pool gazing onto sunset horizon.</p>
        </div>

        <div class="p-8 border border-luxury-sand/60 bg-white/50 backdrop-blur-sm space-y-3">
          <div class="w-10 h-10 rounded-full bg-luxury-ivory border border-luxury-sand flex items-center justify-center text-luxury-gold font-serif text-lg">03</div>
          <h3 class="font-serif text-xl text-luxury-charcoal font-medium">Organic Architecture</h3>
          <p class="text-xs text-luxury-charcoal/70 leading-relaxed font-light">Hand-carved teak, local volcanic stone, and open-air pavilions in harmony with nature.</p>
        </div>
      </div>
    </section>

    <!-- 3. Rooms & Villas Showcase Section -->
    <section id="villas" class="py-20 bg-[#FAF8F5] border-y border-luxury-sand/50">
      <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16">
          <div class="space-y-3">
            <span class="text-xs uppercase tracking-[0.35em] text-luxury-bronze font-medium block">
              ACCOMMODATIONS
            </span>
            <h2 class="font-serif text-4xl md:text-5xl text-luxury-charcoal font-light">
              Suites & Private Villas
            </h2>
          </div>
          <p class="text-xs lg:text-sm text-luxury-charcoal/70 max-w-md font-light mt-4 md:mt-0">
            Thoughtfully crafted residences where indoor comfort flows effortlessly into lush outdoor tropical greenery.
          </p>
        </div>

        <div class="space-y-16">
          <RoomCardEditorial 
            v-for="(villa, index) in (props.rooms && props.rooms.length > 0 ? props.rooms : [])" 
            :key="villa.id"
            :room="villa"
            :isReversed="index % 2 !== 0"
          />
        </div>
      </div>
    </section>

    <!-- 4. Experience & Wellness Section -->
    <ExperienceShowcase />

    <!-- 5. Fine Dining Showcase Section -->
    <DiningEditorial />

    <!-- 6. Immersive Photo Gallery -->
    <ImmersiveGallery />

    <!-- 7. Guest Testimonials Section -->
    <section class="py-24 bg-white border-t border-luxury-sand/50">
      <div class="max-w-4xl mx-auto px-6 text-center space-y-12">
        <Quote class="w-12 h-12 text-luxury-gold/40 mx-auto" />
        
        <div class="space-y-6">
          <p class="font-serif text-2xl md:text-3xl text-luxury-charcoal font-light italic leading-relaxed">
            "{{ testimonials[0].quote }}"
          </p>
          <div>
            <span class="font-serif text-lg text-luxury-charcoal font-medium block">{{ testimonials[0].author }}</span>
            <span class="text-xs uppercase tracking-[0.2em] text-luxury-bronze font-light">{{ testimonials[0].location }}</span>
          </div>
        </div>
      </div>
    </section>

    <!-- 8. Conversion Section CTA -->
    <section class="relative py-28 bg-luxury-forest text-white overflow-hidden text-center">
      <div class="absolute inset-0 opacity-20 pointer-events-none">
        <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?auto=format&fit=crop&w=2000&q=80" alt="Resort Background" class="w-full h-full object-cover" />
      </div>

      <div class="relative z-10 max-w-3xl mx-auto px-6 space-y-8">
        <span class="text-xs uppercase tracking-[0.4em] text-luxury-sand font-medium block">
          YOUR PRIVATE ESCAPE AWAITS
        </span>
        <h2 class="font-serif text-4xl md:text-6xl font-light text-white leading-tight">
          Reserve Your Stay at Vije Boutique Resort
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

    <!-- Direct Booking Confirmation E-Voucher Modal -->
    <BookingConfirmationModal 
      :isOpen="isConfirmationModalOpen"
      :booking="confirmedBooking"
      @close="isConfirmationModalOpen = false"
    />

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
