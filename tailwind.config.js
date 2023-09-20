module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.scss",
  ],
  theme: {
    extend: {
      colors: {
          'dcrr-green': '#70ad42',
          'dcrr-green-700': '#5b823d',
      },
      gridTemplateColumns: {
          '5bis' : 'repeat(5, 18px)',
      },
      gridTemplateRows: {
          '5bis' : 'repeat(5, 18px)',
      },
      transitionDuration: {
        '60000': '60000ms',
      }
    },
  },
  plugins: [],
}