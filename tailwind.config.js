import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                // Tambahkan font kustom untuk Tema 3: Gold Classic
                'serif-classic': ['Playfair Display', 'Garamond', 'serif'], 
                // CATATAN: 'Playfair Display' dan 'Garamond' adalah contoh font klasik. 
                // Pastikan Anda sudah mengimpor font ini via CSS atau HTML (misalnya dari Google Fonts).
            },
        },
    },

    plugins: [forms],
};