/** @type {import('tailwindcss').Config} */
module.exports = {
  
    content: [
      "./resources/**/*. {blade.php, vue, js}",
      "./resources/js/Pages/**/*.vue",
      "./resources/js/Components/**/*.vue",
    ],
  
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
  ],
}