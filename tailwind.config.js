const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    safelist: [
        'w-64',
        'w-1/2',
        'rounded-l-lg',
        'rounded-r-lg',
        'bg-gray-200',
        'grid-cols-4',
        'grid-cols-7',
        'h-6',
        'leading-6',
        'h-9',
        'leading-9',
        'shadow-lg',
        'bg-opacity-50',
        'dark:bg-opacity-80',
        'mt-16'
    ],
    darkMode: 'class',

    theme: {
        extend: {
            colors: {
                gray: colors.neutral,
                success: {
                    '50': '#FCFFF5',
                    '100': '#F8FFEB',
                    '200': '#E9FCCA',
                    '300': '#D9FAAA',
                    '400': '#AFF76A',
                    '500': '#7cf12e',
                    '600': '#6BDB25',
                    '700': '#50B519',
                    '800': '#399110',
                    '900': '#266E0A',
                    '950': '#154704'
                },
                primary: {
                    '50': '#FFFAF2',
                    '100': '#FFF5E6',
                    '200': '#FFE2BF',
                    '300': '#FFCA99',
                    '400': '#FF914D',
                    '500': '#ff4400',
                    '600': '#E63900',
                    '700': '#BF2D00',
                    '800': '#992100',
                    '900': '#731700',
                    '950': '#4A0C00'
                }
            },
            fontFamily: {
                'sans': ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'system-ui', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'sans-serif', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'],
                'body': ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'system-ui', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'sans-serif', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'],
                'mono': ['ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'Liberation Mono', 'Courier New', 'monospace']
            },
            transitionProperty: {
                'width': 'width'
            },
            textDecoration: ['active'],
            minWidth: {
                'kanban': '28rem'
            },
            transitionDuration: {
                '2000': '2000ms',
                '3000': '3000ms',
                '4000': '4000ms',
                '5000': '5000ms',
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('flowbite/plugin')
    ],
};
