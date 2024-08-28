/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php}"],
  theme: {
    extend: {
      backgroundImage: {
        'oma': "url('./images/omaWallpaper.png')",
        'login': 'linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%)',
      },
    },
  },
  plugins: [],
}