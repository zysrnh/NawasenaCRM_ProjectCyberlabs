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
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                navy: {
                    DEFAULT: '#263145',
                    light: '#31415C',
                    dark: '#1a2332',
                },
                gold: {
                    DEFAULT: '#FAB95B',
                    light: '#fcd596',
                    dark: '#e5a040',
                },
                'nw-light': '#F3F7FF',
                'nw-body': '#7A7A7A',
            },
            borderRadius: {
                'none': '0',
                'sm': '4px',
                DEFAULT: '4px',
                'md': '4px',
                'lg': '4px',
                'xl': '4px',
                '2xl': '4px',
                '3xl': '4px',
                'full': '9999px', // allowed for avatars
            },
            boxShadow: {
                // Flat by default, only subtle shadows for hover/active/modals
                DEFAULT: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
                'md': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
                'lg': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                'xl': '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
                'inner': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
                'none': 'none',
            }
        },
    },

    plugins: [forms],
};
