const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    content: [    
        "./resources/**/*.blade.php",   
        "./resources/**/*.js",    
        "./resources/**/*.vue",  
    ],
    purge: false,
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors : {
                background: {
                    100   : '#1e2329',
                    200   : '#242831',
                    300   : '#282c35',
                    400   : '#f9f9f9',
                },
                primary : {
                    dark  : '#3857fe',
                    blue  : '#526cfe',
                    gray  : '#dfe5ee',
                    light : '#6f85fe',
                    low   : '#7486ec',
                    200   : '#dee5ef',
                    background : '#d1d5db'
                },
                secondary : {
                    dark : '#fe1f42',
                    red  : '#fe062d',
                    400  : '#FE3857',
                    light : '#fe062d',
                    gray : '#cfcfcf',
                },
            },

            maxWidth: {

               '1/4': '25%',

               '1/2': '50%',

               '3/4': '75%',

               '3.6/4': '90%',
            },
            boxShadow: {
                'right' : '0 2px 0 0 rgba(0, 0, 0, 0.05)'
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
