/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./html/**/*.{html,php,js}"],
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        charcoal: "#333333",
        deepblue: "#1a365d",
      },
      fontFamily: {
        sans: ["Pretendard", "sans-serif"],
        serif: ["Merriweather", "serif"],
      },
      typography: {
        DEFAULT: {
          css: {
            p: { margin: 0 },
            h1: { margin: 0 },
            h2: { margin: 0 },
            h3: { margin: 0 },
            h4: { margin: 0 },
            h5: { margin: 0 },
            h6: { margin: 0 },
            ul: { margin: 0 },
            ol: { margin: 0 },
            li: { margin: 0 },
            blockquote: { margin: 0 },
            pre: { margin: 0 },
            figure: { margin: 0 },
          },
        },
      },
    },
  },
  plugins: [require("@tailwindcss/typography")],
};
