<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { 
  BedDouble, 
  CalendarCheck, 
  CreditCard, 
  TrendingUp, 
  Sparkles, 
  Plus, 
  ArrowUpRight,
  Clock,
  CheckCircle2,
  AlertCircle,
  Users,
  Eye
} from 'lucide-vue-next';

const props = defineProps({
  stats: Object,
  recent_bookings: Array,
  rooms_overview: Array,
});

const getStatusBadge = (status) => {
  switch(status) {
    case 'paid':
      return { label: 'PAID / CONFIRMED', bg: 'bg-emerald-50 text-emerald-700 border-emerald-200' };
    case 'checked_in':
      return { label: 'CHECKED IN', bg: 'bg-amber-50 text-amber-800 border-amber-200' };
    case 'checked_out':
      return { label: 'CHECKED OUT', bg: 'bg-slate-100 text-slate-700 border-slate-200' };
    case 'pending':
      return { label: 'PENDING PAYMENT', bg: 'bg-orange-50 text-orange-700 border-orange-200' };
    case 'cancelled':
      return { label: 'CANCELLED', bg: 'bg-rose-50 text-rose-700 border-rose-200' };
    default:
      return { label: status, bg: 'bg-gray-50 text-gray-700 border-gray-200' };
  }
};
</script>

<template>
  <AdminLayout>
    <Head title="Resort Management Dashboard - Vije Boutique Resort" />

    <div class="space-y-8 text-left">
      <!-- Quiet Luxury Editorial Hero Banner -->
      <div class="relative overflow-hidden rounded-3xl bg-[#1C2826] text-[#FAF8F5] p-6 sm:p-10 border border-[#2B3023] shadow-xl">
        <div class="absolute -right-16 -bottom-16 w-80 h-80 rounded-full bg-[#C5A059]/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div class="space-y-3 max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#C5A059]/20 rounded-full text-[#C5A059] text-xs font-mono tracking-wider border border-[#C5A059]/30">
              <Sparkles class="w-3.5 h-3.5 text-[#C5A059]" />
              Hospitality Control & Booking Overview
            </div>
            <h2 class="font-serif text-2xl sm:text-4xl text-[#FAF8F5] font-light tracking-wide">
              Vije Boutique Resort Operations
            </h2>
            <p class="text-xs sm:text-sm text-[#FAF8F5]/70 font-light leading-relaxed">
              Ringkasan performa pemesanan langsung (*direct booking*), tingkat hunian kamar (*occupancy rate*), serta manajemen status tamu secara real-time.
            </p>
          </div>

          <div class="flex items-center gap-3 shrink-0">
            <Link 
              :href="route('admin.bookings.index')" 
              class="px-5 py-3 bg-[#C5A059] hover:bg-[#b08d4b] text-xs font-medium uppercase tracking-widest text-[#1C2826] rounded-xl transition-all shadow-md flex items-center gap-2"
            >
              <span>Semua Reservasi</span>
              <ArrowUpRight class="w-4 h-4" />
            </Link>
          </div>
        </div>
      </div>

      <!-- Key Metrics Stat Cards Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Occupancy Rate -->
        <div class="p-6 rounded-2xl bg-[#FDFBF7] border border-[#E6DEC9] shadow-sm flex flex-col justify-between space-y-4 hover:border-[#C5A059] transition-all">
          <div class="flex items-center justify-between">
            <span class="text-xs font-mono text-[#1C2826]/60 uppercase tracking-wider">Tingkat Okupansi</span>
            <div class="p-2.5 rounded-xl bg-[#1C2826]/5 text-[#1C2826]">
              <TrendingUp class="w-5 h-5 text-[#C5A059]" />
            </div>
          </div>
          <div>
            <p class="font-serif text-3xl text-[#1C2826] font-medium">{{ stats.occupancy_rate }}%</p>
            <p class="text-xs text-[#1C2826]/60 mt-1">Status Hunian Kamar Hari Ini</p>
          </div>
        </div>

        <!-- Total Revenue -->
        <div class="p-6 rounded-2xl bg-[#FDFBF7] border border-[#E6DEC9] shadow-sm flex flex-col justify-between space-y-4 hover:border-[#C5A059] transition-all">
          <div class="flex items-center justify-between">
            <span class="text-xs font-mono text-[#1C2826]/60 uppercase tracking-wider">Pendapatan Direct</span>
            <div class="p-2.5 rounded-xl bg-[#1C2826]/5 text-[#1C2826]">
              <CreditCard class="w-5 h-5 text-[#C5A059]" />
            </div>
          </div>
          <div>
            <p class="font-serif text-2xl text-[#1C2826] font-medium">Rp {{ Number(stats.total_revenue).toLocaleString('id-ID') }}</p>
            <p class="text-xs text-emerald-700 font-medium mt-1">Direct Booking Confirmation</p>
          </div>
        </div>

        <!-- Active Bookings -->
        <div class="p-6 rounded-2xl bg-[#FDFBF7] border border-[#E6DEC9] shadow-sm flex flex-col justify-between space-y-4 hover:border-[#C5A059] transition-all">
          <div class="flex items-center justify-between">
            <span class="text-xs font-mono text-[#1C2826]/60 uppercase tracking-wider">Total Reservasi</span>
            <div class="p-2.5 rounded-xl bg-[#1C2826]/5 text-[#1C2826]">
              <CalendarCheck class="w-5 h-5 text-[#C5A059]" />
            </div>
          </div>
          <div>
            <p class="font-serif text-3xl text-[#1C2826] font-medium">{{ stats.total_bookings }} Pesanan</p>
            <p class="text-xs text-[#1C2826]/60 mt-1">{{ stats.checked_in_guests }} Tamu Checked-In</p>
          </div>
        </div>

        <!-- Total Rooms & Units -->
        <div class="p-6 rounded-2xl bg-[#FDFBF7] border border-[#E6DEC9] shadow-sm flex flex-col justify-between space-y-4 hover:border-[#C5A059] transition-all">
          <div class="flex items-center justify-between">
            <span class="text-xs font-mono text-[#1C2826]/60 uppercase tracking-wider">Tipe & Unit Kamar</span>
            <div class="p-2.5 rounded-xl bg-[#1C2826]/5 text-[#1C2826]">
              <BedDouble class="w-5 h-5 text-[#C5A059]" />
            </div>
          </div>
          <div>
            <p class="font-serif text-3xl text-[#1C2826] font-medium">{{ stats.total_rooms }} Kategori</p>
            <p class="text-xs text-[#1C2826]/60 mt-1">Total {{ stats.total_units }} Unit Villa/Suite</p>
          </div>
        </div>
      </div>

      <!-- Recent Reservations Section -->
      <div class="bg-[#FDFBF7] border border-[#E6DEC9] rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-[#E6DEC9] pb-4">
          <div>
            <h3 class="font-serif text-xl text-[#1C2826]">Daftar Reservasi Terbaru</h3>
            <p class="text-xs text-[#1C2826]/60 font-light mt-0.5">Pemesanan kamar & villa langsung dari channel website</p>
          </div>
          <Link 
            :href="route('admin.bookings.index')" 
            class="text-xs font-medium text-[#C5A059] hover:underline flex items-center gap-1"
          >
            <span>Lihat Semua Reservasi</span>
            <ArrowUpRight class="w-3.5 h-3.5" />
          </Link>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-[#F4EFE6] text-[#1C2826]/80 uppercase font-mono text-[10px] tracking-wider border-y border-[#E6DEC9]">
              <tr>
                <th class="py-3.5 px-4 font-semibold">Kode Booking</th>
                <th class="py-3.5 px-4 font-semibold">Nama Tamu</th>
                <th class="py-3.5 px-4 font-semibold">Kamar / Villa</th>
                <th class="py-3.5 px-4 font-semibold">Check-In / Out</th>
                <th class="py-3.5 px-4 font-semibold">Total Tarif</th>
                <th class="py-3.5 px-4 font-semibold">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-[#E6DEC9]/60 font-sans">
              <tr v-for="b in recent_bookings" :key="b.id" class="hover:bg-[#F4EFE6]/50 transition-colors">
                <td class="py-4 px-4 font-mono font-medium text-[#1C2826]">{{ b.booking_code }}</td>
                <td class="py-4 px-4">
                  <div class="font-medium text-[#1C2826]">{{ b.guest_name }}</div>
                  <div class="text-[10px] text-[#1C2826]/60 font-mono">{{ b.guest_email }}</div>
                </td>
                <td class="py-4 px-4 font-medium text-[#1C2826]">{{ b.room ? b.room.name : 'Villa' }}</td>
                <td class="py-4 px-4 text-[#1C2826]/80 text-[11px]">
                  {{ b.check_in }} - {{ b.check_out }}
                </td>
                <td class="py-4 px-4 font-mono font-medium text-[#1C2826]">
                  Rp {{ Number(b.total_price).toLocaleString('id-ID') }}
                </td>
                <td class="py-4 px-4">
                  <span :class="[getStatusBadge(b.payment_status).bg, 'inline-flex px-2.5 py-1 rounded-full text-[10px] font-mono tracking-wider font-semibold border']">
                    {{ getStatusBadge(b.payment_status).label }}
                  </span>
                </td>
              </tr>
              <tr v-if="!recent_bookings || recent_bookings.length === 0">
                <td colspan="6" class="py-8 text-center text-xs text-[#1C2826]/50 font-light">Belum ada reservasi terbaru.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Rooms & Villa Overview Grid -->
      <div class="bg-[#FDFBF7] border border-[#E6DEC9] rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
        <div class="flex items-center justify-between border-b border-[#E6DEC9] pb-4">
          <div>
            <h3 class="font-serif text-xl text-[#1C2826]">Inventaris Kamar & Villa</h3>
            <p class="text-xs text-[#1C2826]/60 font-light mt-0.5">Status dan spesifikasi unit akomodasi Vije Boutique Resort</p>
          </div>
          <Link 
            :href="route('admin.rooms.index')" 
            class="px-4 py-2 bg-[#1C2826] hover:bg-[#2B3023] text-white text-xs font-medium uppercase tracking-wider rounded-xl transition-all"
          >
            Kelola Kamar →
          </Link>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
          <div v-for="rm in rooms_overview" :key="rm.id" class="p-5 rounded-2xl bg-[#FAF8F5] border border-[#E6DEC9] flex flex-col justify-between space-y-4">
            <div>
              <span class="text-[9px] font-mono uppercase tracking-widest text-[#C5A059] block mb-1">{{ rm.category }}</span>
              <h4 class="font-serif text-lg text-[#1C2826] font-medium leading-snug">{{ rm.name }}</h4>
              <p class="text-xs text-[#1C2826]/60 mt-1">{{ rm.size_sqm }} • {{ rm.capacity }}</p>
            </div>
            
            <div class="pt-3 border-t border-[#E6DEC9] flex items-center justify-between text-xs">
              <span class="font-serif text-sm font-semibold text-[#1C2826]">Rp {{ Number(rm.price_per_night).toLocaleString('id-ID') }} <span class="text-[10px] font-sans font-normal text-[#1C2826]/60">/ malam</span></span>
              <span class="px-2 py-0.5 bg-[#C5A059]/10 text-[#C5A059] rounded text-[10px] font-mono">{{ rm.total_units }} Unit</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
