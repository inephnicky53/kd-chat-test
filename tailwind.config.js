const withMT = require("@material-tailwind/react/utils/withMT");

module.exports = withMT({
    content: [
        './assets/**/*.{html,js,vue,jsx}',
        './templates/**/*.{html,js,vue,twig}',
    ],
    // purge: {
    //     enable: false, // purge tailwindcss on dev mode too
    //     content: ['./assets/**/*.{html,js,vue}', './templates/**/*.{html,js,vue,twig}'],
    //     safelist:[
    //     ]
    // },
    theme: {
        extend: {
            fontSize: {
                '0':'0'
            },
            colors: {
                'primary': '#03BD80',
                'secondary': '#03BD80',
                'purple':'#6f4ee7'
            },
        }
    },
    variants: {
        extend: {
            display: ['responsive', 'hover', 'focus', 'group-hover'],
            width: ['hover', 'focus', 'group-hover'],
            height: ['hover', 'focus', 'group-hover'],
            overflow: ['hover', 'focus', 'group-hover'],
            padding: ['hover', 'focus', 'group-hover'],
            margin: ['hover', 'focus', 'group-hover'],
            translate: ['active', 'group-hover', 'responsive'],
            maxHeight: ['hover', 'focus', 'group-hover'],
            borderWidth: ['hover', 'focus', 'group-hover'],
            order: ['hover', 'focus', 'responsive'],
            textColor: ['active','group-focus', 'focus-within'],
            backgroundColor: ['hover','responsive', 'active', 'odd', 'even', 'focus-within', 'group-hover', 'group-focus', 'focus', 'disabled'],
        },
    },
    plugins: [],
    prefix:'',
})