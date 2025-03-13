/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "selector",
  content: ["./views/**/*.{html,js,php}", "./public/build/js/**/*.js"],
  theme: {
    fontFamily: {
      rubik: ["Rubik", "serif"],
    },
    extend: {
      colors: {
        "primary-base": "#2563eb",
        "primary-light": "#3b82f6",
        "primary-dark": "#1d4ed8",
        "primary-fulldark": "#5f0346",

        "secondary-base": "#0ea5e9",
        "secondary-light": "#38bdf8",
        "secondary-dark": "#0284c7",

        "accent-base": "#06b6d4",
        "accent-light": "#22d3ee",
        "accent-dark": "#0891b2",

        "neutral-base": "#64748b",
        "neutral-light": "#94a3b8",
        "neutral-dark": "#475569",

        "background-base": "#f8fafc",
        "background-light": "#ffffff",
        "background-dark": "#e2e8f0",

        "font-base": "#000000",
        "font-light": "#ffffff",

        "error-base": "#f00e1c",
        "link-base": "#5ab7ff",

        "subtitle-base": "#9ca3af",
        "subtitle-base-dark": "#374151",

        "alert-color": "#38485F",

        "dark-bg": "#111827",
        "dark-bg-container": "#1f2937",
        "dark-font": "#9ca3af",
        "dark-font-titles": "#a16207",
      },
    },
  },
  plugins: [require("tailwind-scrollbar")],
};
