<script setup>
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Mail, Lock, Eye, EyeOff, ArrowRight, Sparkles, ArrowLeft } from 'lucide-vue-next';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: true,
});

const showPassword = ref(false);

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Masuk Akun - Vije Boutique Resort" />

        <div class="relative z-10 w-full p-6 sm:p-10 rounded-3xl border border-[#C5A059]/30 bg-[#16201E]/90 shadow-2xl shadow-black/50 backdrop-blur-xl flex flex-col justify-between">
            <!-- Header Branding -->
            <div class="text-center space-y-2 mb-6">
                <div class="inline-flex p-3 bg-[#C5A059]/20 border border-[#C5A059]/40 rounded-2xl mb-1 text-[#C5A059]">
                    <Sparkles class="w-6 h-6" />
                </div>
                <h1 class="font-serif text-2xl text-[#FAF8F5] tracking-wide uppercase font-light">
                    Vije Boutique Resort
                </h1>
                <p class="text-xs font-mono text-[#C5A059] uppercase tracking-widest">
                    Control Panel & Staff Access
                </p>
            </div>

            <!-- Status Alert -->
            <div v-if="status" class="mb-5 p-3 rounded-xl bg-emerald-950/60 border border-emerald-500/30 text-xs font-medium text-emerald-300 text-center">
                {{ status }}
            </div>

            <!-- Flash Error Alert -->
            <div v-if="$page.props.flash?.error" class="mb-5 p-3.5 rounded-xl bg-rose-950/60 border border-rose-500/40 text-xs font-medium text-rose-200 text-center shadow-lg">
                ⚠️ {{ $page.props.flash.error }}
            </div>

            <!-- Login Form (Email/Password Manual) -->
            <form @submit.prevent="submit" class="space-y-4 text-left">
                <!-- Email Field -->
                <div>
                    <label for="email" class="flex items-center gap-1.5 mb-1.5 text-xs font-mono text-[#FAF8F5]/80 uppercase tracking-wider">
                        <Mail class="w-3.5 h-3.5 text-[#C5A059]" />
                        <span>Alamat Email</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#FAF8F5]/40">
                            <Mail class="w-4 h-4" />
                        </div>
                        <input
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="admin@vijeboutiqueresort.com"
                            class="w-full h-11 bg-[#121B19] border border-[#2B3023] rounded-xl pl-10 pr-4 text-xs font-sans text-[#FAF8F5] placeholder-[#FAF8F5]/30 focus:outline-none focus:border-[#C5A059] transition-all"
                        />
                    </div>
                    <InputError class="mt-1 text-xs text-rose-400" :message="form.errors.email" />
                </div>

                <!-- Password Field -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="flex items-center gap-1.5 text-xs font-mono text-[#FAF8F5]/80 uppercase tracking-wider">
                            <Lock class="w-3.5 h-3.5 text-[#C5A059]" />
                            <span>Kata Sandi</span>
                        </label>
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-xxs text-[#C5A059] hover:underline"
                        >
                            Lupa kata sandi?
                        </Link>
                    </div>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#FAF8F5]/40">
                            <Lock class="w-4 h-4" />
                        </div>
                        <input
                            id="password"
                            :type="showPassword ? 'text' : 'password'"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan kata sandi"
                            class="w-full h-11 bg-[#121B19] border border-[#2B3023] rounded-xl pl-10 pr-10 text-xs font-sans text-[#FAF8F5] placeholder-[#FAF8F5]/30 focus:outline-none focus:border-[#C5A059] transition-all"
                        />
                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#FAF8F5]/40 hover:text-[#FAF8F5] cursor-pointer"
                        >
                            <Eye v-if="!showPassword" class="w-4 h-4" />
                            <EyeOff v-else class="w-4 h-4" />
                        </button>
                    </div>
                    <InputError class="mt-1 text-xs text-rose-400" :message="form.errors.password" />
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="checkbox"
                            v-model="form.remember"
                            class="rounded border-[#2B3023] bg-[#121B19] text-[#C5A059] focus:ring-0 cursor-pointer"
                        />
                        <span class="text-xs text-[#FAF8F5]/70 font-light">Ingat sesi saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full h-12 mt-2 bg-[#C5A059] hover:bg-[#b08d4b] active:scale-[0.99] text-[#1C2826] text-xs uppercase tracking-widest font-medium rounded-xl transition-all shadow-md flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50"
                >
                    <span>Masuk Ke Control Panel</span>
                    <ArrowRight class="w-4 h-4" />
                </button>
            </form>

            <!-- Footer Links -->
            <div class="mt-6 pt-5 border-t border-[#2B3023] text-center space-y-3">
                <p class="text-xs text-[#FAF8F5]/60 font-light">
                    Belum memiliki akun?
                    <Link :href="route('register')" class="text-[#C5A059] font-medium hover:underline ml-1">
                        Daftar Akun Baru
                    </Link>
                </p>
                
                <Link href="/" class="inline-flex items-center gap-1.5 text-xs text-[#FAF8F5]/40 hover:text-[#FAF8F5] transition-colors pt-2">
                    <ArrowLeft class="w-3.5 h-3.5" />
                    <span>Kembali ke Website Resort</span>
                </Link>
            </div>
        </div>
    </GuestLayout>
</template>
