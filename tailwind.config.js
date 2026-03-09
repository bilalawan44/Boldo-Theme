/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php", "./resources/**/*.js", "./resources/**/*.html", "./index.html"],
  safelist: [
    'font-manrope',
    'font-opensans',
    {
      pattern: /font-(manrope|opensans)/,
    },
  ],
  theme: {
    extend: {
      fontFamily: {
        manrope: ['Manrope', 'sans-serif'],
        opensans: ['"Open Sans"', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
