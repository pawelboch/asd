module.exports = function( grunt ) {

    // Load grunt tasks automatically
    require( 'load-grunt-tasks' )( grunt );

    // Time how long tasks take. Can help when optimizing build times
    require( 'time-grunt' )( grunt );

    var modulesScssPaths = (function resolveModulesScssPaths() {
        var paths = {};
        grunt.file.expandMapping(
            'pagebox/modules/**/scss/module.scss',
            '',
            { ext: '/../../css/module.css' }
        ).forEach( function( item ) {
            paths[ item.dest ] = item.src[0];
        });
        return paths;
    })();

    // Project configuration.
    grunt.initConfig( {
        pkg: grunt.file.readJSON( 'package.json' ),
        sass: {
            options: {
                compass: true,
                sourceMap: true,
                outputStyle: 'expanded', // nested, expanded, compact, compressed
                sourceComments: false,
                includePaths: [
                    'assets/stylesheets/scss'
                ]
            },
            bootstrap: {
                files: {
                    'assets/stylesheets/css/bootstrap.css': 'assets/stylesheets/scss/bootstrap.scss'
                }
            },
            style: {
                files: {
                    'assets/stylesheets/css/style.css': 'assets/stylesheets/scss/style.scss'
                }
            },
            fonts: {
                files: {
                    'assets/stylesheets/css/fonts.css': 'assets/stylesheets/scss/fonts.scss'
                }
            },
            modules: {
                files: modulesScssPaths
            }
        },
        watch: {
            options: {
                spawn: false
            },
            gruntfile: {
                files: 'Gruntfile.js',
                options: {
                    reload: true
                }
            },
            sass: {
                files: [
                    'assets/stylesheets/scss/style.scss',
                    'assets/stylesheets/scss/mixins/**/*.scss',
                    'assets/stylesheets/scss/partials/**/*.scss'
                ],
                tasks: [ 'sass:style' ]
            },
            sassBootstrap: {
                files: 'assets/stylesheets/scss/bootstrap.scss',
                tasks: [ 'sass:bootstrap' ]
            },
            sassFonts: {
                files: 'assets/stylesheets/scss/fonts.scss',
                tasks: [ 'sass:fonts' ]
            },
            sassModules: {
                files: 'pagebox/modules/**/scss/*.scss',
                tasks: [ 'sass:modules' ]
            },
            sassThemeConfig: {
                files: 'assets/stylesheets/scss/theme-config.scss',
                tasks: [ 'sass:style', 'sass:bootstrap' ]
            }
        },
        auto_install: {
            local: {
                options: {
                    stdout: true,
                    stderr: true,
                    failOnError: true,
                    npm: false
                }
            }
        },
        copy: {
            sassVendor: {
                files: [
                    {
                        expand: true,
                        cwd: 'assets/bower_components/bootstrap/scss/',
                        src: ['**'],
                        dest: 'assets/stylesheets/scss/vendor/bootstrap/'
                    },
                    {
                        expand: true,
                        cwd: 'assets/bower_components/compass-mixins/lib/',
                        src: ['**'],
                        dest: 'assets/stylesheets/scss/vendor/'
                    },
                    {
                        expand: true,
                        cwd: 'assets/bower_components/slick-carousel/slick/',
                        src: ['*.scss'],
                        dest: 'assets/stylesheets/scss/vendor/slick/'
                    }
                ]
            }
        },
        clean: {
            sassVendor: ["assets/stylesheets/scss/vendor/"]
        },
        concat: {
            css: {
                src: [
                    'assets/stylesheets/css/fonts.css',
                    'assets/stylesheets/css/bootstrap.css',
                    'assets/stylesheets/css/style.css',
                    'pagebox/modules/**/css/module.css'
                ],
                dest: 'assets/stylesheets/css/style.min.css'
            }
        },
        cssmin: {
            options: {
                processImport: false,
                shorthandCompacting: true,
                roundingPrecision: 10 // 10 is for bootstrap
            },
            target: {
                files: {
                    'assets/stylesheets/css/style.min.css': ['assets/stylesheets/css/style.min.css']
                }
            }
        }
    } );

    grunt.registerTask( 'install-sass-vendor', 'Install vendors from bower and copy to vendor folder', [
        'auto_install',
        'clean:sassVendor',
        'copy:sassVendor'
    ] );

    grunt.registerTask( 'compile', 'Compile scss files with compression', [
        'install-sass-vendor',
        'sass',
        'concat',
        'cssmin'
    ] );

    grunt.registerTask( 'default', 'Watch scss files and compile after change', [
        'watch'
    ] );

};