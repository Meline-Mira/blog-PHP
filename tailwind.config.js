/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./views/**/*.html.twig", "./views/**/*.svg"],
  theme: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/forms'),
  ],
}
