/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./src/**/*.php",
        "./public/**/*.html",
        "./assets/**/*.js"
    ],
    theme: {
        extend: {
            colors: {
                'yii-primary': '#40b3d8',
                'yii-secondary': '#83c933',
                'yii-dark': '#062730',
                'yii-orange': '#f18a2a',
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [],
}
