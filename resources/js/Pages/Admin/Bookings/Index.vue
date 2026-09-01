<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { CalendarCheck, Search, Filter, CheckCircle2, Clock, XCircle, ArrowUpRight } from 'lucide-vue-next';

const props = defineProps({
  bookings: Object,
  rooms: Array,
  filters: Object,
});

const search = ref(props.filters.search || '');
const status = ref(props.filters.status || '');

const filterBookings = () => {
  router.get(route('admin.bookings.index'), {
    search: search.value,
    status: status.value,
  }, { preserveState: true });
};

const updateStatus = (booking, newStatus) => {
  if (confirm(`Ubah status pemesanan ${booking.booking_code} menjadi ${newStatus.toUpperCase()}?`)) {
    router.patch(route('admin.bookings.status', booking.id), {
      payment_status: newStatus,
    });
  }
};

const getStatusBadge = (st) => {
  switch(st) {
    case 'paid':
      return { label: 'PAID', bg: 'bg-emerald-50 text-emerald-800 border-emerald-300' };
    case 'checked_in':
      return { label: 'CHECKED IN', bg: 'bg-amber-50 text-amber-900 border-amber-300' };
    case 'checked_out':
      return { label: 'CHECKED OUT', bg: 'bg-slate-100 text-slate-800 border-slate-300' };
    case 'pending':
      return { label: 'PENDING', bg: 'bg-orange-50 text-orange-800 border-orange-300' };
    case 'cancelled':
      return { label: 'CANCELLED', bg: 'bg-rose-50 text-rose-800 border-rose-300' };
    default:
      return { label: st, bg: 'bg-gray-50 text-gray-800 border-gray-300' };
  }
};
</script>

<template>
  <AdminLayout>
    <Head title="Manajemen Reservasi Tamu - Vije Boutique Resort" />

    <div class="space-y-6 text-left">
      <!-- Header -->
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-[#1C2826] text-[#FAF8F5] p-6 rounded-3xl border border-[#2B3023]">
        <div class="space-y-1">
          <span class="text-[10px] font-mono tracking-widest text-[#C5A059] uppercase">Direct Guest Reservations</span>
          <h2 class="font-serif text-2xl sm:text-3xl text-[#FAF8F5]">Manajemen Booking & Kalender</h2>
          <p class="text-xs text-[#FAF8F5]/70 font-light">Verifikasi pembayaran, konfirmasi tanggal menginap, dan proses status Check-In/Check-Out.</p>
        </div>
      </div>

      <!-- Filters & Search Bar -->
      <div class="bg-[#FDFBF7] border border-[#E6DEC9] p-4 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
        <div class="flex items-center gap-3 w-full sm:w-auto">
          <div class="relative flex-1 sm:w-72">
            <Search class="w-4 h-4 text-[#1C2826]/40 absolute left-3 top-3" />
            <input 
              v-model="search"
              @keyup.enter="filterBookings"
              type="text"
              placeholder="Cari nama tamu, email, kode..."
              class="w-full pl-9 pr-4 py-2 bg-[#FAF8F5] border border-[#E6DEC9] rounded-xl text-xs text-[#1C2826] focus:outline-none focus:border-[#C5A059]"
            />
          </div>

          <select 
            v-model="status" 
            @change="filterBookings"
            class="px-3 py-2 bg-[#FAF8F5] border border-[#E6DEC9] rounded-xl text-xs text-[#1C2826] focus:outline-none focus:border-[#C5A059]"
          >
            <option value="">Semua Status</option>
            <option value="pending">Pending Payment</option>
            <option value="paid">Paid / Confirmed</option>
            <option value="checked_in">Checked In</option>
            <option value="checked_out">Checked Out</option>
            <option value="cancelled">Cancelled</option>
          </select>
        </div>

        <button 
          @click="filterBookings"
          class="px-4 py-2 bg-[#1C2826] text-white text-xs font-medium uppercase tracking-wider rounded-xl hover:bg-[#2B3023] transition-all cursor-pointer shrink-0"
        >
          Terapkan Filter
        </button>
      </div>

      <!-- Reservations Table -->
      <div class="bg-[#FDFBF7] border border-[#E6DEC9] rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-[#F4EFE6] text-[#1C2826]/80 uppercase font-mono text-[10px] tracking-wider border-b border-[#E6DEC9]">
              <tr>
                <th class="py-3.5 px-4">Kode Booking</th>
                <th class="py-3.5 px-4">Data Tamu</th>
                <th class="py-3.5 px-4">Kamar / Villa</th>
                <th class="py-3.5 px-4">Check-In - Check-Out</th>
                <th class="py-3.5 px-4">Total Tarif</th>
                <th class="py-3.5 px-4">Status</th>
                <th class="py-3.5 px-4 text-right">Ubah Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-[#E6DEC9]/60 font-sans">
              <tr v-for="b in bookings.data" :key="b.id" class="hover:bg-[#F4EFE6]/50 transition-colors">
                <td class="py-4 px-4 font-mono font-medium text-[#1C2826]">{{ b.booking_code }}</td>
                <td class="py-4 px-4">
                  <div class="font-medium text-[#1C2826]">{{ b.guest_name }}</div>
                  <div class="text-[10px] text-[#1C2826]/60 font-mono">{{ b.guest_email }} • {{ b.guest_phone }}</div>
                </td>
                <td class="py-4 px-4 font-medium text-[#1C2826]">
                  {{ b.room ? b.room.name : 'Villa' }}
                </td>
                <td class="py-4 px-4 text-[#1C2826]/80 text-[11px] font-mono">
                  {{ b.check_in }} - {{ b.check_out }} ({{ b.nights_count }} Malam)
                </td>
                <td class="py-4 px-4 font-mono font-medium text-[#1C2826]">
                  Rp {{ Number(b.total_price).toLocaleString('id-ID') }}
                </td>
                <td class="py-4 px-4">
                  <span :class="[getStatusBadge(b.payment_status).bg, 'inline-flex px-2.5 py-1 rounded-full text-[10px] font-mono tracking-wider font-semibold border']">
                    {{ getStatusBadge(b.payment_status).label }}
                  </span>
                </td>
                <td class="py-4 px-4 text-right">
                  <select 
                    :value="b.payment_status"
                    @change="updateStatus(b, $event.target.value)"
                    class="px-2 py-1 bg-[#FAF8F5] border border-[#E6DEC9] rounded text-[11px] text-[#1C2826] focus:outline-none cursor-pointer"
                  >
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                    <option value="checked_in">Checked In</option>
                    <option value="checked_out">Checked Out</option>
                    <option value="cancelled">Cancelled</option>
                  </select>
                </td>
              </tr>
              <tr v-if="!bookings.data || bookings.data.length === 0">
                <td colspan="7" class="py-8 text-center text-xs text-[#1C2826]/50 font-light">Tidak ada data reservasi ditemukan.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
