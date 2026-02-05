import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',

    // JS & Vue
    './resources/js/**/*.js',
    './resources/js/**/*.vue',

    // Inertia Pages
    './resources/js/Pages/**/*.vue',
    './resources/js/Pages/Admin/**/*.vue',
    './resources/js/Pages/Admin/Components/**/*.vue',
    './resources/js/Layouts/**/*.vue',

    // Flowbite
    './node_modules/flowbite/**/*.js',
],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require('flowbite/plugin')
        
    ],
};
