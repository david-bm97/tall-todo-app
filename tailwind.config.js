const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter var", ...defaultTheme.fontFamily.sans],
            },
        },
        container: {
            center: true,
            padding: {
                DEFAULT: "1rem",
                sm: "2rem",
                lg: "4rem",
                xl: "5rem",
                "2xl": "6rem",
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ["active"],
        },
    },
    purge: {
        content: [
            "./app/**/*.php",
            "./resources/**/*.html",
            "./resources/**/*.js",
            "./resources/**/*.jsx",
            "./resources/**/*.ts",
            "./resources/**/*.tsx",
            "./resources/**/*.php",
            "./resources/**/*.vue",
            "./resources/**/*.twig",
        ],
        options: {
            defaultExtractor: (content) =>
                content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
            safelist: [/data-theme$/],
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("daisyui"),
    ],
    daisyui: {
        themes: ["light", "dark"],
    },
};
