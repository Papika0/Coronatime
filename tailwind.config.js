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
        'my-green': '#0FBA68',
        'my-yellow': '#EAD621',
      },
      backgroundColor: {
        'blue-opacity-8': 'rgba(32, 41, 243, 0.08)',
        'green-opacity-8': 'rgba(15, 186, 104, 0.08)',
        'yellow-opacity-8': 'rgba(234, 214, 33, 0.08)',
      },
    },
  },
  plugins: [],
}