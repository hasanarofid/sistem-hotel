<script setup>
import { 
  CheckCircle2, 
  X, 
  Calendar, 
  BedDouble, 
  CreditCard, 
  QrCode, 
  MessageSquare, 
  Copy, 
  Sparkles,
  ExternalLink
} from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps({
  isOpen: Boolean,
  booking: Object,
});

const emit = defineEmits(['close']);
const copied = ref(false);

const copyVA = (text) => {
  navigator.clipboard.writeText(text);
  copied.value = true;
  setTimeout(() => copied.value = false, 2000);
};
</script>

<template>
  <div v-if="isOpen && booking" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-md overflow-y-auto">
    <div class="relative w-full max-w-xl bg-[#FAF8F5] text-[#222222] rounded-3xl border border-[#C5A059]/40 shadow-2xl overflow-hidden my-8">
      
      <!-- Top Gold Accent Bar -->
      <div class="h-1.5 bg-gradient-to-r from-[#1C2826] via-[#C5A059] to-[#1C2826]"></div>

      <!-- Close Button -->
      <button 
        @click="emit('close')"
        class="absolute top-4 right-4 p-2 text-[#1C2826]/60 hover:text-[#1C2826] hover:bg-[#F4EFE6] rounded-full transition-colors cursor-pointer"
      >
        <X class="w-5 h-5" />
      </button>

      <div class="p-6 sm:p-8 space-y-6 text-left">
        <!-- Header Success Badge -->
        <div class="text-center space-y-2">
          <div class="inline-flex p-3 bg-[#C5A059]/15 text-[#C5A059] rounded-2xl border border-[#C5A059]/30">
            <CheckCircle2 class="w-8 h-8" />
          </div>
          <h2 class="font-serif text-2xl sm:text-3xl text-[#1C2826]">Reservasi Berhasil Dibuat</h2>
          <p class="text-xs text-[#1C2826]/70 font-light">
            Terima kasih, <strong class="text-[#1C2826]">{{ booking.guest_name }}</strong>! Permintaan reservasi langsung Anda telah tercatat.
          </p>
        </div>

        <!-- Booking Code & Essential Info Card -->
        <div class="bg-[#F4EFE6] border border-[#E6DEC9] rounded-2xl p-5 space-y-4">
          <div class="flex items-center justify-between border-b border-[#E6DEC9] pb-3">
            <span class="text-xs font-mono uppercase tracking-wider text-[#1C2826]/60">Kode Booking Unique</span>
            <span class="font-mono text-sm font-bold text-[#C5A059] bg-[#1C2826] px-3 py-1 rounded-lg">
              {{ booking.booking_code }}
            </span>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
            <div>
              <span class="text-[#1C2826]/60 font-mono text-[10px] uppercase block">Villa / Akomodasi</span>
              <span class="font-serif text-base font-semibold text-[#1C2826]">
                {{ booking.room ? booking.room.name : 'Villa Residence' }}
              </span>
            </div>

            <div>
              <span class="text-[#1C2826]/60 font-mono text-[10px] uppercase block">Total Tarif ({{ booking.nights_count }} Malam)</span>
              <span class="font-serif text-base font-bold text-[#1C2826]">
                Rp {{ Number(booking.total_price).toLocaleString('id-ID') }}
              </span>
            </div>

            <div>
              <span class="text-[#1C2826]/60 font-mono text-[10px] uppercase block">Check-In</span>
              <span class="font-mono text-xs font-medium text-[#1C2826]">{{ booking.check_in }}</span>
            </div>

            <div>
              <span class="text-[#1C2826]/60 font-mono text-[10px] uppercase block">Check-Out</span>
              <span class="font-mono text-xs font-medium text-[#1C2826]">{{ booking.check_out }}</span>
            </div>
          </div>
        </div>

        <!-- Payment Gateway Instructions -->
        <div class="bg-[#1C2826] text-[#FAF8F5] p-5 rounded-2xl border border-[#2B3023] space-y-4">
          <div class="flex items-center justify-between">
            <span class="text-xs font-mono uppercase text-[#C5A059] tracking-wider flex items-center gap-1.5">
              <CreditCard class="w-4 h-4 text-[#C5A059]" />
              <span>Instruksi Pembayaran ({{ booking.payment_method }})</span>
            </span>
            <span class="px-2.5 py-0.5 bg-[#C5A059]/20 text-[#C5A059] text-[10px] font-mono rounded-full border border-[#C5A059]/30">
              PENDING PAYMENT
            </span>
          </div>

          <!-- QRIS Option -->
          <div v-if="booking.payment_method === 'QRIS'" class="flex flex-col items-center justify-center space-y-3 pt-2 text-center">
            <div class="p-3 bg-white rounded-xl shadow-inner inline-block">
              <QrCode class="w-28 h-28 text-[#1C2826]" />
            </div>
            <p class="text-xs text-[#FAF8F5]/80 font-light max-w-xs">
              Pindai Kode QRIS di atas menggunakan BCA Mobile, Livin, GoPay, OVO, atau aplikasi e-wallet Anda.
            </p>
          </div>

          <!-- Virtual Account Option -->
          <div v-else-if="booking.payment_method && booking.payment_method.startsWith('VA')" class="space-y-3 pt-1">
            <p class="text-xs text-[#FAF8F5]/70 font-light">Silakan lakukan transfer ke nomor Virtual Account resmi resort:</p>
            <div class="flex items-center justify-between p-3 bg-[#121B19] border border-[#2B3023] rounded-xl font-mono text-sm">
              <span class="text-[#C5A059] font-bold">88149-59247-{{ booking.id }}</span>
              <button 
                @click="copyVA('88149-59247-' + booking.id)"
                class="px-2.5 py-1 bg-[#C5A059] text-[#1C2826] rounded text-[11px] font-medium hover:bg-[#b08d4b] transition-colors cursor-pointer flex items-center gap-1"
              >
                <Copy class="w-3 h-3" />
                <span>{{ copied ? 'Tersalin!' : 'Salin VA' }}</span>
              </button>
            </div>
          </div>

          <!-- Credit Card / Default Option -->
          <div v-else class="space-y-2 pt-1 text-xs text-[#FAF8F5]/80 font-light">
            <p>Sistem settlement otomatis sedang memproses link tagihan ke email <strong class="text-[#C5A059]">{{ booking.guest_email }}</strong>.</p>
          </div>
        </div>

        <!-- WhatsApp Notification Badge -->
        <div class="p-4 bg-emerald-950/40 border border-emerald-500/30 rounded-2xl flex items-center gap-3 text-xs text-emerald-200">
          <div class="p-2 bg-emerald-500/20 text-emerald-400 rounded-xl shrink-0">
            <MessageSquare class="w-4 h-4" />
          </div>
          <div>
            <span class="font-medium block text-emerald-300">Notifikasi WhatsApp Automatis</span>
            <span class="text-[11px] text-emerald-200/70 font-light">Rincian e-voucher & lokasi Google Maps telah dikirimkan ke <code class="font-mono text-emerald-300">{{ booking.guest_phone }}</code>.</span>
          </div>
        </div>

        <!-- Action Button -->
        <div class="pt-2">
          <button 
            @click="emit('close')"
            class="w-full py-3.5 bg-[#1C2826] hover:bg-[#2B3023] text-white text-xs uppercase tracking-widest font-medium rounded-xl transition-all shadow cursor-pointer"
          >
            Selesai & Tutup
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
