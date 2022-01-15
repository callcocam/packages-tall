const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
    content: [           
        // Tall-forms
        './tall-theme/resources/views/**/*.blade.php',
        './tall-table/resources/views/**/*.blade.php',
        './tall-forms/resources/views/**/*.blade.php',
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