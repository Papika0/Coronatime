/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      margin: {
        '5.5': '5.5%',
      },
      colors: {
        'gray-450': '#808189',
        'my-blue': '#2029F3',
      },
    },
  },
  plugins: [],
}