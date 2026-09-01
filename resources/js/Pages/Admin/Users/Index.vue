<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Users, Search, ShieldCheck, UserCheck, Sparkles } from 'lucide-vue-next';

const props = defineProps({
  users: Object,
  available_roles: Array,
  filters: Object,
});

const searchQuery = ref(props.filters.search || '');

const handleSearch = () => {
  router.get(route('admin.users.index'), { search: searchQuery.value }, { preserveState: true, replace: true });
};

const updateRole = (user, newRole) => {
  if (confirm(`Ubah peran akses ${user.name} menjadi ${newRole.toUpperCase().replace('_', ' ')}?`)) {
    router.post(route('admin.users.role', user.id), { role: newRole });
  }
};

const formatRoleLabel = (roleName) => {
  switch (roleName) {
    case 'super_admin': return 'SUPER ADMIN';
    case 'admin': return 'ADMINISTRATOR';
    case 'reservation_staff': return 'RESERVATION STAFF';
    case 'finance': return 'FINANCE & ACCOUNTING';
    case 'content_manager': return 'CONTENT MANAGER';
    default: return roleName ? roleName.toUpperCase() : 'USER';
  }
};

const getRoleBadgeClass = (roleName) => {
  switch (roleName) {
    case 'super_admin':
      return 'bg-[#C5A059]/20 text-[#C5A059] border-[#C5A059]/40';
    case 'admin':
      return 'bg-[#1C2826] text-[#FAF8F5] border-[#2B3023]';
    case 'reservation_staff':
      return 'bg-amber-50 text-amber-900 border-amber-300';
    case 'finance':
      return 'bg-emerald-50 text-emerald-900 border-emerald-300';
    case 'content_manager':
      return 'bg-indigo-50 text-indigo-900 border-indigo-300';
    default:
      return 'bg-[#F4EFE6] text-[#1C2826] border-[#E6DEC9]';
  }
};
</script>

<template>
  <AdminLayout>
    <Head title="Manajemen Staf & Peran (RBAC) - Vije Boutique Resort" />

    <div class="space-y-6 text-left">
      <!-- Header Banner & Search -->
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#1C2826] text-[#FAF8F5] p-6 sm:p-8 rounded-3xl border border-[#2B3023] shadow-lg">
        <div class="space-y-1">
          <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#C5A059]/20 rounded-full text-[#C5A059] text-[10px] font-mono tracking-wider border border-[#C5A059]/30">
            <Sparkles class="w-3.5 h-3.5 text-[#C5A059]" />
            Role-Based Access Control (RBAC)
          </div>
          <h1 class="font-serif text-2xl sm:text-3xl text-[#FAF8F5]">
            Manajemen Staf & Hak Akses
          </h1>
          <p class="text-xs text-[#FAF8F5]/70 font-light max-w-xl">
            Kelola daftar akun terdaftar, otorisasi peran operasional hotel (*Super Admin, Admin, Reservation Staff, Finance, & Content Manager*).
          </p>
        </div>

        <div class="relative w-full md:w-72">
          <Search class="w-4 h-4 text-[#FAF8F5]/40 absolute left-3.5 top-3.5" />
          <input
            type="text"
            v-model="searchQuery"
            @keyup.enter="handleSearch"
            placeholder="Cari nama, email..."
            class="w-full h-11 bg-[#121B19] border border-[#2B3023] rounded-xl pl-10 pr-4 text-xs text-[#FAF8F5] placeholder-[#FAF8F5]/30 focus:outline-none focus:border-[#C5A059] transition-all"
          />
        </div>
      </div>

      <!-- Users Table Card -->
      <div class="bg-[#FDFBF7] border border-[#E6DEC9] rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-[#F4EFE6] text-[#1C2826]/80 uppercase font-mono text-[10px] tracking-wider border-b border-[#E6DEC9]">
              <tr>
                <th class="py-4 px-6">Pengguna / Staf</th>
                <th class="py-4 px-6">Peran Akses (RBAC)</th>
                <th class="py-4 px-6">Tanggal Terdaftar</th>
                <th class="py-4 px-6 text-right">Ubah Peran Akses</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-[#E6DEC9]/60 font-sans">
              <tr v-for="user in users.data" :key="user.id" class="hover:bg-[#F4EFE6]/50 transition-colors">
                <td class="py-4 px-6">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#1C2826] text-[#C5A059] font-serif font-bold text-sm flex items-center justify-center border border-[#C5A059]/40 shrink-0">
                      {{ user.name ? user.name.charAt(0).toUpperCase() : 'U' }}
                    </div>
                    <div>
                      <div class="font-medium text-[#1C2826] text-sm">{{ user.name }}</div>
                      <div class="text-xs text-[#1C2826]/60 font-mono">{{ user.email }}</div>
                    </div>
                  </div>
                </td>

                <td class="py-4 px-6">
                  <span 
                    v-for="r in (user.roles || [])" 
                    :key="r.id"
                    :class="[getRoleBadgeClass(r.name), 'inline-flex px-3 py-1 rounded-full text-[10px] font-mono tracking-wider font-semibold border mr-1']"
                  >
                    {{ formatRoleLabel(r.name) }}
                  </span>
                  <span v-if="!user.roles || user.roles.length === 0" class="inline-flex px-3 py-1 rounded-full text-[10px] font-mono bg-[#F4EFE6] text-[#1C2826] border border-[#E6DEC9]">
                    USER
                  </span>
                </td>

                <td class="py-4 px-6 text-[#1C2826]/70 text-xs font-mono">
                  {{ new Date(user.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' }) }}
                </td>

                <td class="py-4 px-6 text-right">
                  <select
                    :value="user.roles && user.roles[0] ? user.roles[0].name : 'user'"
                    @change="updateRole(user, $event.target.value)"
                    class="px-3 py-1.5 bg-[#FAF8F5] border border-[#E6DEC9] rounded-xl text-xs text-[#1C2826] font-mono focus:outline-none focus:border-[#C5A059] cursor-pointer shadow-sm"
                  >
                    <option value="super_admin">Super Admin</option>
                    <option value="admin">Administrator</option>
                    <option value="reservation_staff">Reservation Staff</option>
                    <option value="finance">Finance Officer</option>
                    <option value="content_manager">Content Manager</option>
                    <option value="user">User / Tamu</option>
                  </select>
                </td>
              </tr>

              <tr v-if="!users.data || users.data.length === 0">
                <td colspan="4" class="py-12 text-center text-xs text-[#1C2826]/50 font-light">
                  Tidak ada pengguna ditemukan.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
