import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./node_modules/preline/dist/*.js",
    ],

    theme: {
        extend: {
            colors: {
                first: "#82675c",
                second: "#93bc00",
                third: "#e5e1df",
            },
            fontFamily: {
                // sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                sans: ["Roboto", ...defaultTheme.fontFamily.sans],
                montserrat: ["Montserrat", "sans-serif"],
                alex: ["Alex Brush", "cursive"],
            },
        },
    },

    plugins: [forms, require("preline/plugin")],
};
