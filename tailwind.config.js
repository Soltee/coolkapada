module.exports = {
  theme:{
    extend :{
      colors : {
        'yellow' : {
          450 : '#ffa500',
          650 : '#faa61a'
        },
        'blue' : {
          450 : '#5c2d91',
        }
      },
      backgroundColor:{
        'blue' : {
          450 : '#5c2d91',

        },
        'yellow' : {
          450 : '#ffa500',
          650 : '#faa61a'
        },
      }
    }
  },
  variants: {
    extend: {
     fontWeight: ['hover', 'focus'],
    }
  }
}