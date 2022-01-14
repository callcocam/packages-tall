const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: {
        content: [           
            // Tall-forms
            './config/tall-forms.php',
            './tall-forms/**/*.php'
        ],
        options: {
            defaultExtractor: (content) => content.match(/[^<>"'`\s]*[^<>"'`\s:]/g) || [],
            safeList: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },

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