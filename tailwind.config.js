import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
                serif: ['Cormorant Garamond', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                luxury: {
                    ivory: '#FAF8F5',
                    cream: '#F4EFE6',
                    sand: '#E6DEC9',
                    beige: '#D9CEB2',
                    gold: '#C5A059',
                    bronze: '#B89248',
                    forest: '#1C2826',
                    olive: '#2B3023',
                    charcoal: '#1A1A1A',
                    offwhite: '#FDFBF7',
                }
            }
        },
    },

    plugins: [forms],
};
