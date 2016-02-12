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
            minify: {
                options: {
                    sourceMap: false,
                    outputStyle: 'compressed'
                },
                files: {
                    'assets/stylesheets/css/main.min.css': 'assets/stylesheets/scss/main.scss'
                }
            },
            modules: {
                options: {
                    outputStyle: 'compressed'
                },
                files: modulesScssPaths
            }
        },
        watch: {
            sass: {
                files: [
                    'assets/stylesheets/scss/**/*.scss',
                    '!assets/stylesheets/vendor/',
                    '!assets/stylesheets/scss/main.scss',
                    '!assets/stylesheets/scss/bootstrap.scss'
                ],
                tasks: [ 'sass:style', 'comments:cssStyle' ],
                options: {
                    spawn: false
                }
            },
            sassBootstrap: {
                files: 'assets/stylesheets/scss/bootstrap.scss',
                tasks: [ 'sass:bootstrap' ],
                options: {
                    spawn: false
                }
            },
            sassMain: {
                files: 'assets/stylesheets/scss/main.scss',
                tasks: [ 'sass:minify' ],
                options: {
                    spawn: false
                }
            },
            sassModules: {
                files: 'pagebox/modules/**/scss/*.scss',
                tasks: [ 'sass:modules' ],
                options: {
                    spawn: false
                }
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
        comments: {
            cssStyle: {
                options: {
                    singleline: true,
                    multiline: true
                },
                src: [ 'assets/stylesheets/css/style.css' ]
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
                    }
                ]
            }
        },
        clean: {
            sassVendor: ["assets/stylesheets/scss/vendor/"]
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
        'comments'
    ] );

    grunt.registerTask( 'default', 'Watch scss files and compile after change', [
        'compile',
        'watch'
    ] );

};