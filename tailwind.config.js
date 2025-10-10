import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
    // 🔆 Activa el modo oscuro controlado por la clase .dark
    darkMode: 'class',

    // 🔍 Rutas donde Tailwind debe buscar tus clases
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/js/**/*.vue',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // 🎨 Colores corporativos “Casa Maravillosa CRM”
                brand: {
                    light: '#C7D2FE',   // Azul claro
                    DEFAULT: '#4F46E5', // Azul institucional
                    dark: '#1E1B4B',    // Azul profundo
                },
            },
        },
    },

    plugins: [forms],
}
