/** @type {import('tailwindcss').Config} */
export default {
  content: ["./views/**/*.{html,js,php}"],
  theme: {
    fontFamily: {
      poppins: ["Poppins", "monospace"],
    },
    extend: {
      colors: {
        "primary-base": "#2563eb",
        "primary-light": "#3b82f6",
        "primary-dark": "#1d4ed8",

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
      },
    },
  },
  plugins: [],
};
