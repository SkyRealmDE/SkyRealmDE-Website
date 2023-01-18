const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
                sono: ["Sono", ...defaultTheme.fontFamily.sans],
                fira: ["Fira Code", ...defaultTheme.fontFamily.mono],
            },
        },
        colors: {
            white: "#ffffff",
            gray: {
                100: "#6a6a6a",
                200: "#5a5a5a",
                300: "#3f3f3f",
                400: "#303030",
                500: "#2a2a2a",
                600: "#1f1f1f",
                700: "#181818",
                800: "#121212",
                900: "#0f0f0f",
            },
            transparent: "transparent",
            current: "currentColor",
            black: colors.black,
            emerald: colors.emerald,
            indigo: colors.indigo,
            yellow: colors.yellow,
            green: colors.green,
            orange: colors.orange,
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
