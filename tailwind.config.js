/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode:'class',
  content: ["./others/**/*.{html,js,php}","./clients_area/**/*.{html,js,php}","./admin_area/**/*.{html,js,php}","./includes/**/*.{html,js,php}","./*.{html,js,php}"],
  theme: {
    extend: {
      colors:{
        'orange':'#F97316',
        'brown':'#683B21',
        'grey':'#DFE0DF',
        'black':'#000000',
        'white':'#FFFFFF',
        'blue':'#334155',
        'neutral':'#fafafa',
        'sky':'#22d3ee',
        'gree':'#22c55e'
      },
      fontFamily:{
        pop:['Poppins','sans-serif'],
      },
    },
  },
  plugins: [],
}