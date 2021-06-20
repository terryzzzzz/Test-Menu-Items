module.exports = {
  mode: 'jit',
  purge: ['./storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {
      borderWidth: ['hover', 'focus'],
      display: ['hover', 'focus', 'group-focus'],
    },
  },
  plugins: [],
}
