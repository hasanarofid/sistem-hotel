<script setup>
import { ref, computed } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { 
  LayoutDashboard, 
  BedDouble, 
  CalendarCheck, 
  Users, 
  Settings, 
  LogOut, 
  ExternalLink, 
  Menu, 
  X,
  ChevronRight,
  ShieldCheck,
  Compass,
  Sparkles,
  Bell
} from 'lucide-vue-next';

const page = usePage();
const currentUser = computed(() => page.props.auth?.user || { name: 'Administrator', email: 'admin@vijeboutiqueresort.com' });

const isMobileSidebarOpen = ref(false);

const navigation = computed(() => [
  { name: 'Overview', href: route('admin.dashboard'), icon: LayoutDashboard, current: route().current('admin.dashboard') },
  { name: 'Rooms & Villas', href: route('admin.rooms.index'), icon: BedDouble, current: route().current('admin.rooms.index') },
  { name: 'Reservations', href: route('admin.bookings.index'), icon: CalendarCheck, current: route().current('admin.bookings.index') },
  { name: 'User & Roles', href: route('admin.users.index'), icon: Users, current: route().current('admin.users.index') },
]);

const logout = () => {
  router.post(route('logout'));
};
</script>

<template>
  <div class="min-h-screen bg-[#FAF8F5] text-[#222222] font-sans flex flex-col selection:bg-[#C5A059] selection:text-white">
    <!-- Top Quiet Luxury Accent Bar -->
    <div class="h-1 bg-gradient-to-r from-[#1C2826] via-[#C5A059] to-[#1C2826]"></div>

    <div class="flex-1 flex overflow-hidden">
      <!-- Desktop Sidebar -->
      <aside class="hidden lg:flex lg:flex-col w-72 bg-[#1C2826] text-[#FAF8F5] border-r border-[#2B3023] z-30 shrink-0">
        <!-- Brand Header -->
        <div class="p-6 border-b border-[#2B3023] flex items-center justify-between">
          <Link :href="route('admin.dashboard')" class="flex flex-col">
            <span class="font-serif text-lg tracking-widest text-[#FAF8F5] font-light uppercase">Vije Boutique</span>
            <span class="text-[9px] tracking-[0.25em] text-[#C5A059] uppercase font-sans">Resort & Management</span>
          </Link>
          <span class="inline-flex p-1.5 rounded-full bg-[#C5A059]/20 text-[#C5A059] text-xs">
            <Sparkles class="w-3.5 h-3.5" />
          </span>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">
          <div class="px-3 py-2 text-[10px] tracking-[0.2em] font-mono text-[#C5A059]/70 uppercase">Management</div>
          
          <Link
            v-for="item in navigation"
            :key="item.name"
            :href="item.href"
            :class="[
              item.current 
                ? 'bg-[#2B3023] text-[#C5A059] font-medium border-l-2 border-[#C5A059]' 
                : 'text-[#FAF8F5]/70 hover:bg-[#2B3023]/60 hover:text-[#FAF8F5]',
              'flex items-center gap-3.5 px-3.5 py-3 rounded-r-xl text-xs transition-all duration-200 group'
            ]"
          >
            <component :is="item.icon" :class="[item.current ? 'text-[#C5A059]' : 'text-[#FAF8F5]/50 group-hover:text-[#FAF8F5]', 'w-4 h-4 shrink-0']" />
            <span class="tracking-wide">{{ item.name }}</span>
          </Link>

          <div class="pt-6 px-3 py-2 text-[10px] tracking-[0.2em] font-mono text-[#C5A059]/70 uppercase">Public Resort</div>
          <Link
            :href="route('home')"
            target="_blank"
            class="flex items-center justify-between px-3.5 py-3 rounded-xl text-xs text-[#FAF8F5]/70 hover:bg-[#2B3023]/60 hover:text-[#FAF8F5] transition-all"
          >
            <span class="flex items-center gap-3.5">
              <Compass class="w-4 h-4 text-[#C5A059]" />
              <span>Live Resort Website</span>
            </span>
            <ExternalLink class="w-3.5 h-3.5 text-[#C5A059]/70" />
          </Link>
        </nav>

        <!-- User Profile Footer -->
        <div class="p-4 border-t border-[#2B3023] bg-[#16201E]">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3 min-w-0">
              <div class="w-9 h-9 rounded-full bg-[#C5A059]/20 border border-[#C5A059]/40 flex items-center justify-center text-[#C5A059] font-serif font-bold text-sm shrink-0">
                {{ currentUser.name ? currentUser.name.charAt(0) : 'A' }}
              </div>
              <div class="truncate">
                <p class="text-xs font-medium text-[#FAF8F5] truncate">{{ currentUser.name }}</p>
                <p class="text-[10px] text-[#C5A059] uppercase tracking-wider font-mono">Administrator</p>
              </div>
            </div>

            <button 
              @click="logout" 
              title="Logout"
              class="p-2 text-[#FAF8F5]/50 hover:text-rose-300 hover:bg-rose-950/30 rounded-lg transition-colors cursor-pointer"
            >
              <LogOut class="w-4 h-4" />
            </button>
          </div>
        </div>
      </aside>

      <!-- Mobile Topbar -->
      <div class="lg:hidden flex flex-col w-full">
        <header class="bg-[#1C2826] text-[#FAF8F5] border-b border-[#2B3023] h-16 px-4 flex items-center justify-between sticky top-0 z-40">
          <Link :href="route('admin.dashboard')" class="flex flex-col">
            <span class="font-serif text-base tracking-widest text-[#FAF8F5] uppercase">Vije Boutique</span>
            <span class="text-[8px] tracking-[0.2em] text-[#C5A059] uppercase font-sans">Admin Panel</span>
          </Link>

          <button 
            @click="isMobileSidebarOpen = !isMobileSidebarOpen"
            class="p-2 text-[#FAF8F5] hover:bg-[#2B3023] rounded-lg cursor-pointer"
          >
            <Menu v-if="!isMobileSidebarOpen" class="w-6 h-6" />
            <X v-else class="w-6 h-6" />
          </button>
        </header>

        <!-- Mobile Drawer -->
        <div 
          v-if="isMobileSidebarOpen"
          class="bg-[#1C2826] border-b border-[#2B3023] p-4 space-y-2 z-30"
        >
          <Link
            v-for="item in navigation"
            :key="item.name"
            :href="item.href"
            @click="isMobileSidebarOpen = false"
            :class="[
              item.current ? 'bg-[#2B3023] text-[#C5A059]' : 'text-[#FAF8F5]/80',
              'flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium'
            ]"
          >
            <component :is="item.icon" class="w-5 h-5 text-[#C5A059]" />
            <span>{{ item.name }}</span>
          </Link>
          <div class="pt-4 border-t border-[#2B3023] flex items-center justify-between">
            <span class="text-xs text-[#FAF8F5]/70">{{ currentUser.email }}</span>
            <button @click="logout" class="px-3 py-1.5 bg-rose-900/40 text-rose-200 text-xs rounded-lg">Logout</button>
          </div>
        </div>
      </div>

      <!-- Main Content Container -->
      <main class="flex-1 overflow-y-auto bg-[#FAF8F5] p-4 sm:p-8 lg:p-10">
        <!-- Top Quiet Header Bar -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-[#E6DEC9] pb-6">
          <div>
            <div class="flex items-center gap-2 text-xs text-[#1C2826]/70 uppercase tracking-widest font-mono mb-1">
              <span>Vije Boutique Resort</span>
              <span>•</span>
              <span class="text-[#C5A059]">Direct Booking Engine</span>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl text-[#1C2826] tracking-wide">
              Boutique Hospitality Control
            </h1>
          </div>

          <div class="flex items-center gap-3">
            <span class="px-3 py-1.5 bg-[#F4EFE6] border border-[#E6DEC9] rounded-full text-xs text-[#1C2826] font-mono">
              📅 {{ new Date().toLocaleDateString('id-ID', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' }) }}
            </span>
            <Link :href="route('home')" target="_blank" class="px-4 py-2 bg-[#1C2826] hover:bg-[#2B3023] text-white text-xs tracking-wider uppercase font-medium rounded-xl transition-all shadow-sm flex items-center gap-2">
              <span>Live Site</span>
              <ExternalLink class="w-3.5 h-3.5 text-[#C5A059]" />
            </Link>
          </div>
        </div>

        <slot />
      </main>
    </div>
  </div>
</template>
