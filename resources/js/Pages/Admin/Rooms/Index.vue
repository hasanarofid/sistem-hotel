<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { BedDouble, Plus, Edit, Trash2, CheckCircle, XCircle, Sparkles } from 'lucide-vue-next';

const props = defineProps({
  rooms: Array
});

const isModalOpen = ref(false);
const editingRoom = ref(null);

const form = useForm({
  name: '',
  category: 'SUITE',
  badge: 'Signature Residence',
  description: '',
  price_per_night: 3500000,
  size_sqm: '180 m²',
  capacity: '2 Guests',
  bed_type: 'King Bed',
  image_url: '',
  total_units: 3,
  is_available: true,
});

const openCreateModal = () => {
  editingRoom.value = null;
  form.reset();
  isModalOpen.value = true;
};

const openEditModal = (room) => {
  editingRoom.value = room;
  form.name = room.name;
  form.category = room.category;
  form.badge = room.badge;
  form.description = room.description;
  form.price_per_night = room.price_per_night;
  form.size_sqm = room.size_sqm;
  form.capacity = room.capacity;
  form.bed_type = room.bed_type;
  form.image_url = room.image_url;
  form.total_units = room.total_units;
  form.is_available = room.is_available;
  isModalOpen.value = true;
};

const submitForm = () => {
  if (editingRoom.value) {
    form.patch(route('admin.rooms.update', editingRoom.value.id), {
      onSuccess: () => isModalOpen.value = false
    });
  } else {
    form.post(route('admin.rooms.store'), {
      onSuccess: () => isModalOpen.value = false
    });
  }
};

const deleteRoom = (room) => {
  if (confirm(`Apakah Anda yakin ingin menghapus kamar ${room.name}?`)) {
    form.delete(route('admin.rooms.destroy', room.id));
  }
};
</script>

<template>
  <AdminLayout>
    <Head title="Manajemen Kamar & Villa - Vije Boutique Resort" />

    <div class="space-y-6 text-left">
      <!-- Header Banner -->
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-[#1C2826] text-[#FAF8F5] p-6 rounded-3xl border border-[#2B3023]">
        <div class="space-y-1">
          <span class="text-[10px] font-mono tracking-widest text-[#C5A059] uppercase">Accommodations Inventory</span>
          <h2 class="font-serif text-2xl sm:text-3xl text-[#FAF8F5]">Manajemen Kamar & Villa</h2>
          <p class="text-xs text-[#FAF8F5]/70 font-light">Kelola tipe kamar, deskripsi editorial, harga per malam, dan ketersediaan unit.</p>
        </div>

        <button 
          @click="openCreateModal"
          class="px-4 py-3 bg-[#C5A059] hover:bg-[#b08d4b] text-[#1C2826] text-xs font-medium uppercase tracking-wider rounded-xl transition-all shadow flex items-center gap-2 cursor-pointer shrink-0"
        >
          <Plus class="w-4 h-4" />
          <span>Tambah Kamar Baru</span>
        </button>
      </div>

      <!-- Rooms Grid Showcase -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div 
          v-for="r in rooms" 
          :key="r.id"
          class="bg-[#FDFBF7] border border-[#E6DEC9] rounded-3xl overflow-hidden shadow-sm flex flex-col justify-between hover:border-[#C5A059] transition-all"
        >
          <div>
            <div class="relative h-48 bg-[#1C2826]/10 overflow-hidden">
              <img :src="r.image_url || 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80'" :alt="r.name" class="w-full h-full object-cover" />
              <div class="absolute top-3 left-3 bg-[#1C2826]/80 backdrop-blur-md px-2.5 py-1 rounded-full text-[10px] font-mono text-[#C5A059] uppercase tracking-wider border border-[#C5A059]/30">
                {{ r.category }}
              </div>
            </div>

            <div class="p-6 space-y-3">
              <div>
                <span class="text-[10px] font-mono text-[#C5A059] uppercase tracking-widest block">{{ r.badge }}</span>
                <h3 class="font-serif text-xl text-[#1C2826] font-medium leading-snug">{{ r.name }}</h3>
              </div>

              <p class="text-xs text-[#1C2826]/70 line-clamp-2 font-light leading-relaxed">{{ r.description }}</p>

              <div class="pt-3 border-t border-[#E6DEC9] grid grid-cols-2 gap-2 text-xs font-mono text-[#1C2826]/80">
                <div>Luas: {{ r.size_sqm }}</div>
                <div>Kapasitas: {{ r.capacity }}</div>
                <div>Kasur: {{ r.bed_type }}</div>
                <div>Unit: {{ r.total_units }} Unit</div>
              </div>
            </div>
          </div>

          <div class="p-6 pt-0 border-t border-[#E6DEC9] mt-4 flex items-center justify-between">
            <div>
              <span class="text-[10px] font-mono text-[#1C2826]/60 block uppercase">Harga / Malam</span>
              <span class="font-serif text-lg font-semibold text-[#1C2826]">Rp {{ Number(r.price_per_night).toLocaleString('id-ID') }}</span>
            </div>

            <div class="flex items-center gap-2">
              <button @click="openEditModal(r)" class="p-2 text-[#1C2826] hover:bg-[#F4EFE6] rounded-lg transition-colors cursor-pointer" title="Edit">
                <Edit class="w-4 h-4 text-[#C5A059]" />
              </button>
              <button @click="deleteRoom(r)" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus">
                <Trash2 class="w-4 h-4" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
