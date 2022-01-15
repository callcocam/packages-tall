const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
    content: [           
        // Tall-forms
        './tall-theme/resources/**/*.blade.php',
        './tall-table/resources/**/*.blade.php',
        './tall-forms/resources/**/*.blade.php',
    ],
    theme: {
        extend: {},
    },
    variants: {
        extend: {
            opacity: ['responsive', 'hover', 'focus', 'disabled'],
        },
    },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
    ],
};