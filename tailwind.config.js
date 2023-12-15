/** @type {import('tailwindcss').Config} */
export default {
  content: ["./resources/views/*/*.php", "./resources/views/*.php", "./public/css/*.css"],
  theme: {
    fontFamily: {
      'sans': ['Poppins'],
    },
    extend: {
    },
    backgroundImage: {
      
    },
  },
  plugins: [],
}

//npx tailwindcss -i ./public/css/input.css -o ./public/css/output.css --watch