<script setup>
import { ref, computed } from 'vue';
import { Calendar, Users, Home, Search, ArrowRight, User, Mail, Phone, CreditCard, Sparkles, MessageSquare } from 'lucide-vue-next';

const props = defineProps({
  rooms: {
    type: Array,
    default: () => [],
  }
});

const emit = defineEmits(['bookingSuccess']);

const checkInDate = ref('');
const checkOutDate = ref('');
const guestsCount = ref(2);
const selectedRoomId = ref('');
const guestName = ref('');
const guestEmail = ref('');
const guestPhone = ref('');
const paymentMethod = ref('QRIS');
const specialRequests = ref('');

const isSubmitting = ref(false);
const errorMessage = ref('');

// Default dates: Tomorrow & +3 days
const today = new Date();
const tomorrow = new Date(today);
tomorrow.setDate(tomorrow.getDate() + 1);
const nextDay = new Date(today);
nextDay.setDate(nextDay.getDate() + 4);

checkInDate.value = tomorrow.toISOString().split('T')[0];
checkOutDate.value = nextDay.toISOString().split('T')[0];

if (props.rooms && props.rooms.length > 0) {
  selectedRoomId.value = props.rooms[0].id;
}

const selectedRoom = computed(() => {
  return props.rooms.find(r => r.id === Number(selectedRoomId.value)) || props.rooms[0] || null;
});

const nightsCount = computed(() => {
  if (!checkInDate.value || !checkOutDate.value) return 1;
  const d1 = new Date(checkInDate.value);
  const d2 = new Date(checkOutDate.value);
  const diffTime = d2 - d1;
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
  return diffDays > 0 ? diffDays : 1;
});

const calculatedTotal = computed(() => {
  if (!selectedRoom.value) return 0;
  return nightsCount.value * Number(selectedRoom.value.price_per_night);
});

const handleBookingSubmit = async () => {
  errorMessage.value = '';
  isSubmitting.value = true;

  try {
    const res = await fetch(route('guest.bookings.store'), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        'Accept': 'application/json',
      },
      body: JSON.stringify({
        room_id: selectedRoomId.value,
        check_in: checkInDate.value,
        check_out: checkOutDate.value,
        guests_count: guestsCount.value,
        guest_name: guestName.value,
        guest_email: guestEmail.value,
        guest_phone: guestPhone.value,
        payment_method: paymentMethod.value,
        special_requests: specialRequests.value,
      }),
    });

    const data = await res.json();

    if (data.success) {
      emit('bookingSuccess', data.booking);
    } else {
      errorMessage.value = data.message || 'Terjadi kesalahan saat memproses reservasi.';
    }
  } catch (err) {
    console.error(err);
    errorMessage.value = 'Gagal terhubung ke server. Silakan coba beberapa saat lagi.';
  } finally {
    isSubmitting.value = false;
  }
};
</script>

<template>
  <div id="booking" class="w-full max-w-5xl mx-auto px-4 my-8">
    <div class="bg-[#FAF8F5] border border-[#E6DEC9] p-6 lg:p-10 shadow-2xl rounded-3xl relative z-30 font-sans text-left space-y-6">
      
      <!-- Section Header -->
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-[#E6DEC9] pb-5">
        <div>
          <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#C5A059]/15 text-[#C5A059] rounded-full text-[10px] font-mono tracking-widest uppercase mb-1">
            <Sparkles class="w-3.5 h-3.5" />
            <span>Direct Reservation Channel</span>
          </div>
          <h3 class="font-serif text-2xl lg:text-3xl text-[#1C2826]">Reservasi Langsung Resort</h3>
          <p class="text-xs text-[#1C2826]/70 font-light mt-0.5">Dapatkan jaminan tarif terbaik tanpa komisi pihak ketiga</p>
        </div>

        <div v-if="selectedRoom" class="text-left sm:text-right bg-[#F4EFE6] px-4 py-2.5 rounded-2xl border border-[#E6DEC9]">
          <span class="text-[10px] font-mono uppercase text-[#1C2826]/60 block">Estimasi Total ({{ nightsCount }} Malam)</span>
          <span class="font-serif text-xl font-bold text-[#1C2826]">Rp {{ Number(calculatedTotal).toLocaleString('id-ID') }}</span>
        </div>
      </div>

      <!-- Error Message Alert -->
      <div v-if="errorMessage" class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-xs font-medium">
        ⚠️ {{ errorMessage }}
      </div>

      <!-- Direct Booking Form -->
      <form @submit.prevent="handleBookingSubmit" class="space-y-6">
        <!-- Row 1: Dates & Villa Choice -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <!-- Check In -->
          <div class="flex flex-col space-y-1.5 p-3.5 bg-[#F4EFE6] rounded-2xl border border-[#E6DEC9]">
            <label class="text-[10px] uppercase tracking-wider text-[#1C2826]/70 font-mono flex items-center gap-1.5">
              <Calendar class="w-3.5 h-3.5 text-[#C5A059]" />
              <span>Check In</span>
            </label>
            <input 
              type="date" 
              v-model="checkInDate"
              required
              class="bg-transparent border-0 p-0 text-xs font-medium text-[#1C2826] focus:ring-0 cursor-pointer"
            />
          </div>

          <!-- Check Out -->
          <div class="flex flex-col space-y-1.5 p-3.5 bg-[#F4EFE6] rounded-2xl border border-[#E6DEC9]">
            <label class="text-[10px] uppercase tracking-wider text-[#1C2826]/70 font-mono flex items-center gap-1.5">
              <Calendar class="w-3.5 h-3.5 text-[#C5A059]" />
              <span>Check Out</span>
            </label>
            <input 
              type="date" 
              v-model="checkOutDate"
              required
              class="bg-transparent border-0 p-0 text-xs font-medium text-[#1C2826] focus:ring-0 cursor-pointer"
            />
          </div>

          <!-- Guests -->
          <div class="flex flex-col space-y-1.5 p-3.5 bg-[#F4EFE6] rounded-2xl border border-[#E6DEC9]">
            <label class="text-[10px] uppercase tracking-wider text-[#1C2826]/70 font-mono flex items-center gap-1.5">
              <Users class="w-3.5 h-3.5 text-[#C5A059]" />
              <span>Jumlah Tamu</span>
            </label>
            <select 
              v-model="guestsCount"
              class="bg-transparent border-0 p-0 text-xs font-medium text-[#1C2826] focus:ring-0 cursor-pointer"
            >
              <option :value="1">1 Tamu</option>
              <option :value="2">2 Tamu</option>
              <option :value="3">3 Tamu</option>
              <option :value="4">4-5 Tamu (Family)</option>
            </select>
          </div>

          <!-- Accommodation Selection -->
          <div class="flex flex-col space-y-1.5 p-3.5 bg-[#F4EFE6] rounded-2xl border border-[#E6DEC9]">
            <label class="text-[10px] uppercase tracking-wider text-[#1C2826]/70 font-mono flex items-center gap-1.5">
              <Home class="w-3.5 h-3.5 text-[#C5A059]" />
              <span>Pilih Kamar / Villa</span>
            </label>
            <select 
              v-model="selectedRoomId"
              required
              class="bg-transparent border-0 p-0 text-xs font-medium text-[#1C2826] focus:ring-0 cursor-pointer"
            >
              <option v-for="rm in rooms" :key="rm.id" :value="rm.id">
                {{ rm.name }} (Rp {{ Number(rm.price_per_night).toLocaleString('id-ID') }})
              </option>
            </select>
          </div>
        </div>

        <!-- Row 2: Guest Details -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2">
          <!-- Guest Name -->
          <div>
            <label class="block text-xs font-mono text-[#1C2826]/80 uppercase tracking-wider mb-1">Nama Lengkap Tamu *</label>
            <input 
              type="text" 
              v-model="guestName"
              required
              placeholder="Sesuai KTP / Paspor"
              class="w-full h-11 bg-white border border-[#E6DEC9] rounded-xl px-3.5 text-xs text-[#1C2826] placeholder-[#1C2826]/30 focus:outline-none focus:border-[#C5A059]"
            />
          </div>

          <!-- Guest Email -->
          <div>
            <label class="block text-xs font-mono text-[#1C2826]/80 uppercase tracking-wider mb-1">Alamat Email *</label>
            <input 
              type="email" 
              v-model="guestEmail"
              required
              placeholder="Untuk pengiriman E-Voucher"
              class="w-full h-11 bg-white border border-[#E6DEC9] rounded-xl px-3.5 text-xs text-[#1C2826] placeholder-[#1C2826]/30 focus:outline-none focus:border-[#C5A059]"
            />
          </div>

          <!-- Guest WhatsApp -->
          <div>
            <label class="block text-xs font-mono text-[#1C2826]/80 uppercase tracking-wider mb-1">Nomor WhatsApp *</label>
            <input 
              type="tel" 
              v-model="guestPhone"
              required
              placeholder="Nomor WA aktif (+62...)"
              class="w-full h-11 bg-white border border-[#E6DEC9] rounded-xl px-3.5 text-xs text-[#1C2826] placeholder-[#1C2826]/30 focus:outline-none focus:border-[#C5A059]"
            />
          </div>
        </div>

        <!-- Row 3: Special Requests & Payment Method -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- Special Requests -->
          <div>
            <label class="block text-xs font-mono text-[#1C2826]/80 uppercase tracking-wider mb-1">Permintaan Khusus (Opsional)</label>
            <textarea 
              v-model="specialRequests"
              rows="2"
              placeholder="Contoh: Honeymoon setup, penjemputan bandara, quiet room..."
              class="w-full bg-white border border-[#E6DEC9] rounded-xl p-3 text-xs text-[#1C2826] placeholder-[#1C2826]/30 focus:outline-none focus:border-[#C5A059]"
            ></textarea>
          </div>

          <!-- Payment Method Selection -->
          <div>
            <label class="block text-xs font-mono text-[#1C2826]/80 uppercase tracking-wider mb-1">Metode Pembayaran Online *</label>
            <div class="grid grid-cols-2 gap-2">
              <label :class="[paymentMethod === 'QRIS' ? 'border-[#C5A059] bg-[#C5A059]/10' : 'border-[#E6DEC9] bg-white', 'p-3 border rounded-xl flex items-center gap-2 cursor-pointer transition-all']">
                <input type="radio" v-model="paymentMethod" value="QRIS" class="text-[#C5A059] focus:ring-0 cursor-pointer" />
                <div class="text-left">
                  <span class="block text-xs font-semibold text-[#1C2826]">QRIS Instant</span>
                  <span class="block text-[9px] text-[#1C2826]/60">BCA, GoPay, OVO, QR</span>
                </div>
              </label>

              <label :class="[paymentMethod === 'VA_BCA' ? 'border-[#C5A059] bg-[#C5A059]/10' : 'border-[#E6DEC9] bg-white', 'p-3 border rounded-xl flex items-center gap-2 cursor-pointer transition-all']">
                <input type="radio" v-model="paymentMethod" value="VA_BCA" class="text-[#C5A059] focus:ring-0 cursor-pointer" />
                <div class="text-left">
                  <span class="block text-xs font-semibold text-[#1C2826]">Virtual Account</span>
                  <span class="block text-[9px] text-[#1C2826]/60">BCA / Mandiri / BRI</span>
                </div>
              </label>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
          <button 
            type="submit"
            :disabled="isSubmitting"
            class="w-full bg-[#1C2826] hover:bg-[#2B3023] text-white py-4 px-6 transition-all duration-300 flex items-center justify-center space-x-2 text-xs uppercase tracking-[0.2em] font-medium rounded-xl shadow-lg cursor-pointer disabled:opacity-50"
          >
            <span>{{ isSubmitting ? 'Memproses Reservasi...' : 'Konfirmasi & Bayar Reservasi Now' }}</span>
            <ArrowRight class="w-4 h-4" />
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
