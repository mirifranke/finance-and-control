const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            width: {
                '1/100': '1%',
                '2/100': '2%',
                '4/100': '4%',
                '9/100': '9%',
                '13/100': '13%',
                '14/100': '13%',
                '15/100': '15%',
                '1/5': '20%',
                '3/10': '30%',
                '33/100': '33%',
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
