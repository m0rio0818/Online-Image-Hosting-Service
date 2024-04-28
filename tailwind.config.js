/** @type {import('tailwindcss').Config} */

module.exports = {
  purge: [
    // Add paths to your PHP files here to enable PurgeCSS
    './**/*.php',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}