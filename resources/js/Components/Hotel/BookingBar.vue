<script setup>
import { ref } from 'vue';
import { Calendar, Users, Home, Search, ArrowRight } from 'lucide-vue-next';

const checkInDate = ref('');
const checkOutDate = ref('');
const guestsCount = ref('2 Adults');
const roomType = ref('All Suites & Villas');

// Set default dates (Tomorrow and +2 days)
const today = new Date();
const tomorrow = new Date(today);
tomorrow.setDate(tomorrow.getDate() + 1);
const nextDay = new Date(today);
nextDay.setDate(nextDay.getDate() + 3);

checkInDate.value = tomorrow.toISOString().split('T')[0];
checkOutDate.value = nextDay.toISOString().split('T')[0];

const handleSearch = () => {
  const target = document.getElementById('villas');
  if (target) {
    target.scrollIntoView({ behavior: 'smooth' });
  }
};
</script>

<template>
  <div id="booking" class="w-full max-w-6xl mx-auto px-4">
    <div class="bg-white/95 backdrop-blur-md border border-luxury-sand/60 p-4 lg:p-6 shadow-xl relative z-30 font-sans">
      <form @submit.prevent="handleSearch" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
        
        <!-- Check-in Date -->
        <div class="flex flex-col space-y-1.5 border-b md:border-b-0 md:border-r border-luxury-sand/40 pb-3 md:pb-0 md:pr-4">
          <label class="text-[10px] uppercase tracking-[0.2em] text-luxury-charcoal/70 font-semibold flex items-center space-x-1.5">
            <Calendar class="w-3.5 h-3.5 text-luxury-gold" />
            <span>Check In</span>
          </label>
          <input 
            type="date" 
            v-model="checkInDate"
            class="bg-transparent border-0 p-0 text-sm font-medium text-luxury-charcoal focus:ring-0 cursor-pointer"
          />
        </div>

        <!-- Check-out Date -->
        <div class="flex flex-col space-y-1.5 border-b md:border-b-0 md:border-r border-luxury-sand/40 pb-3 md:pb-0 md:pr-4">
          <label class="text-[10px] uppercase tracking-[0.2em] text-luxury-charcoal/70 font-semibold flex items-center space-x-1.5">
            <Calendar class="w-3.5 h-3.5 text-luxury-gold" />
            <span>Check Out</span>
          </label>
          <input 
            type="date" 
            v-model="checkOutDate"
            class="bg-transparent border-0 p-0 text-sm font-medium text-luxury-charcoal focus:ring-0 cursor-pointer"
          />
        </div>

        <!-- Guests Count -->
        <div class="flex flex-col space-y-1.5 border-b md:border-b-0 md:border-r border-luxury-sand/40 pb-3 md:pb-0 md:pr-4">
          <label class="text-[10px] uppercase tracking-[0.2em] text-luxury-charcoal/70 font-semibold flex items-center space-x-1.5">
            <Users class="w-3.5 h-3.5 text-luxury-gold" />
            <span>Guests</span>
          </label>
          <select 
            v-model="guestsCount"
            class="bg-transparent border-0 p-0 text-sm font-medium text-luxury-charcoal focus:ring-0 cursor-pointer"
          >
            <option value="1 Adult">1 Adult</option>
            <option value="2 Adults">2 Adults</option>
            <option value="2 Adults, 1 Child">2 Adults, 1 Child</option>
            <option value="4 Guests (Family)">4 Guests (Family)</option>
          </select>
        </div>

        <!-- Accommodation Type -->
        <div class="flex flex-col space-y-1.5 border-b lg:border-b-0 lg:border-r border-luxury-sand/40 pb-3 lg:pb-0 lg:pr-4">
          <label class="text-[10px] uppercase tracking-[0.2em] text-luxury-charcoal/70 font-semibold flex items-center space-x-1.5">
            <Home class="w-3.5 h-3.5 text-luxury-gold" />
            <span>Accommodation</span>
          </label>
          <select 
            v-model="roomType"
            class="bg-transparent border-0 p-0 text-sm font-medium text-luxury-charcoal focus:ring-0 cursor-pointer"
          >
            <option value="All Suites & Villas">All Suites & Villas</option>
            <option value="Luxury Ocean Suite">Luxury Ocean Suite</option>
            <option value="Private Pool Villa">Private Pool Villa</option>
            <option value="Grand Sanctuary Residence">Grand Sanctuary Residence</option>
          </select>
        </div>

        <!-- Submit CTA Button -->
        <div>
          <button 
            type="submit"
            class="w-full bg-luxury-charcoal hover:bg-luxury-gold text-white hover:text-luxury-charcoal py-3 px-4 transition-all duration-300 flex items-center justify-center space-x-2 text-xs uppercase tracking-[0.2em] font-semibold group shadow-md"
          >
            <span>Check Rates</span>
            <ArrowRight class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" />
          </button>
        </div>

      </form>
    </div>
  </div>
</template>
