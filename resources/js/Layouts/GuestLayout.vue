<script setup>
import { Link } from '@inertiajs/vue3';
import { Sparkles, BedDouble, ShieldCheck, CalendarCheck, Compass, ArrowLeft } from 'lucide-vue-next';
</script>

<template>
  <div class="min-h-screen bg-[#1C2826] text-[#FAF8F5] font-sans antialiased selection:bg-[#C5A059] selection:text-white flex flex-col justify-between relative overflow-x-hidden">
    <!-- Quiet Luxury Background Gradients -->
    <div class="fixed inset-0 pointer-events-none z-0 bg-[radial-gradient(circle_at_70%_20%,_rgba(197,160,89,0.12)_0%,_transparent_50%),_linear-gradient(135deg,_#1C2826_0%,_#121B19_50%,_#0A1110_100%)]"></div>

    <!-- Top Gold Accent Line -->
    <div class="h-1 bg-gradient-to-r from-[#1C2826] via-[#C5A059] to-[#1C2826] relative z-20"></div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 min-h-screen">
      <!-- Left Hero Showcase Section (Quiet Luxury Branding) -->
      <div class="hidden lg:flex lg:col-span-7 relative p-12 lg:p-16 flex-col justify-between text-left">
        <!-- Brand Header -->
        <Link href="/" class="flex items-center gap-3 group z-10">
          <img src="/images/vije-logo.webp" alt="Vije Boutique Resort" class="h-10 w-auto object-contain transition-transform group-hover:scale-105" />
          <div class="flex flex-col">
            <span class="font-serif text-xl tracking-widest text-[#FAF8F5] uppercase">
              Vije Boutique
            </span>
            <span class="text-[9px] tracking-[0.25em] text-[#C5A059] uppercase font-sans">Resort & Management</span>
          </div>
        </Link>

        <!-- Hero Content in Left Panel -->
        <div class="space-y-6 max-w-xl my-auto z-10">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#C5A059]/15 border border-[#C5A059]/30 text-[#C5A059] text-xs font-mono tracking-wider">
            <Compass class="w-4 h-4 text-[#C5A059]" />
            <span>Hospitality Control & Booking Console</span>
          </div>

          <h1 class="font-serif text-4xl lg:text-5xl text-[#FAF8F5] leading-tight font-light tracking-wide">
            Where Luxury Meets Serenity
          </h1>

          <p class="text-sm text-[#FAF8F5]/70 font-light leading-relaxed">
            Selamat datang di Portal Manajemen & Access Control Vije Boutique Resort. Sistem reservasi langsung (*direct booking engine*) berbasis akurasi server-side dan pengelolaan kamar real-time.
          </p>

          <div class="grid grid-cols-2 gap-4 pt-2">
            <div class="p-5 rounded-2xl bg-[#2B3023]/60 border border-[#C5A059]/20 backdrop-blur space-y-1.5">
              <div class="flex items-center gap-2 text-[#C5A059] font-medium text-xs font-mono uppercase tracking-wider">
                <BedDouble class="w-4 h-4" />
                <span>Rooms & Villas</span>
              </div>
              <p class="text-[11px] text-[#FAF8F5]/60 font-light">Direct booking tanpa komisi OTA</p>
            </div>

            <div class="p-5 rounded-2xl bg-[#2B3023]/60 border border-[#C5A059]/20 backdrop-blur space-y-1.5">
              <div class="flex items-center gap-2 text-[#C5A059] font-medium text-xs font-mono uppercase tracking-wider">
                <ShieldCheck class="w-4 h-4" />
                <span>Instant Settlement</span>
              </div>
              <p class="text-[11px] text-[#FAF8F5]/60 font-light">Payment Gateway & WhatsApp E-Voucher</p>
            </div>
          </div>
        </div>

        <!-- Footer Note -->
        <div class="z-10 text-xs text-[#FAF8F5]/50 font-light flex items-center justify-between">
          <Link href="/" class="hover:text-[#C5A059] flex items-center gap-1.5 transition-colors">
            <ArrowLeft class="w-3.5 h-3.5" />
            <span>Kembali ke Website Resort</span>
          </Link>
          <span>&copy; {{ new Date().getFullYear() }} Vije Boutique Resort</span>
        </div>
      </div>

      <!-- Right Form Section -->
      <div class="col-span-1 lg:col-span-5 relative flex items-center justify-center p-4 sm:p-8 my-auto">
        <div class="w-full max-w-md relative z-10">
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>
