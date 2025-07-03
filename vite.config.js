import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import obfuscator from 'vite-plugin-javascript-obfuscator';

import { viteStaticCopy } from 'vite-plugin-static-copy'
export default defineConfig({
    build: {
        outDir: 'public/build',
        manifest: true,
        //rtl: true,        
        cssCodeSplit: true,
        minify: 'terser', // ⬅️ Esto fuerza la minificación
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    //if (assetInfo.name.split('.').pop() == 'css') {
                    if (assetInfo.name && assetInfo.name.endsWith('.css')) {
                        //return 'css/' + `[name]` + '.min.' + 'css';
                        return 'css/[name].min.css';
                    } else if (assetInfo.name && assetInfo.name.endsWith('.svg')) { //este else no iba
                        return 'icons/[name].[ext]';
                    
                    } else {
                        //return 'icons/' + assetInfo.name;
                        return 'assets/[name].[ext]';
                    }
                },
                //entryFileNames: 'js/' + `[name]` + `.js`,
                entryFileNames: 'js/[name].js',
            },
        },
        
    },
    plugins: [
        laravel({
            input: [
                'resources/scss/main.scss',
                //'resources/css/style.css', 
                'resources/js/app.js',
                /*
                'resources/js/appendscript.js',
                'resources/js/calculator.js',
                'resources/js/custom-select2.js',
                'resources/js/forms-pickers.js',
                'resources/js/ratings.js',
                'resources/js/script.js',
                'resources/js/sortable.js',
                'resources/js/swiper.js',
                'resources/js/theme-colorpicker.js',
                'resources/js/theme-script.js',
                'resources/js/validation.js',                
                */
               'resources/js/admin/menu.js',
               'resources/js/admin/menuSortable.js',
               'resources/js/admin/permission.js',
               'resources/js/admin/rol.js',
               'resources/js/admin/User.js'


            ],
            refresh: true,
        }),
        obfuscator({
            compact: true,
            controlFlowFlattening: true,
            deadCodeInjection: true,
            debugProtection: true,
            disableConsoleOutput: true
        }, [
            'js/*.js'
        ]),
        viteStaticCopy({
            targets: [
                { 
                    src: [
                        'resources/css/*',
                        '!resources/css/style.css',
                        '!resources/css/style.css.map',
                        '!resources/css/styles.css',
                        '!resources/css/styles.css.map',
                    ], 
                    dest: 'css' 
                },
                //{ src: 'resources/scss', dest: '' },
                { src: 'resources/fonts', dest: '' },
                { src: 'resources/img', dest: '' },
                { 
                    src: [
                        'resources/js/*',
                        '!resources/js/app.js',
                        '!resources/js/appendscript.js',
                        '!resources/js/calculator.js',
                        '!resources/js/custom-select2.js',
                        '!resources/js/forms-pickers.js',
                        '!resources/js/ratings.js',
                        '!resources/js/script.js',
                        '!resources/js/sortable.js',
                        '!resources/js/swiper.js',
                        '!resources/js/theme-colorpicker.js',
                        '!resources/js/theme-script.js',
                        '!resources/js/validation.js',
                        '!resources/js/admin/menu.js',
                        '!resources/js/admin/menuSortable.js',
                        '!resources/js/admin/permission.js',
                        '!resources/js/admin/rol.js',
                        '!resources/js/admin/User.js'

                    ],
                    dest: 'js'
                },
                { src: 'resources/plugins', dest: '' },
               
            ]
        }),
       
    ],
});
