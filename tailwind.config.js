module.exports = {
  theme:{
    extend :{
      colors : {
        'gray' : {
          450 : '#ffa500',
          // 900 : '#faa61a',
          900 : '#f86f15',
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