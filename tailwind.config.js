/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.svelte",
    "./node_modules/flowbite/**/*.js",
    "./node_modules/flowbite-svelte/**/*.{html,js,svelte,ts}"
  ],
  theme: {
    extend: {
      width: {
        'w-35': '35%',
      }
    },
  },
  darkMode: 'class',
  plugins: [
    require('flowbite/plugin')
  ],
}

