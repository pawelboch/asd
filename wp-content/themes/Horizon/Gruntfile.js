module.exports = function( grunt ) {

    // Load grunt tasks automatically
    require( 'load-grunt-tasks' )( grunt );

    // Time how long tasks take. Can help when optimizing build times
    require( 'time-grunt' )( grunt );

    // Project configuration.
    grunt.initConfig( {
        pkg: grunt.file.readJSON( 'package.json' ),
        sass: {
            options: {
                sourceMap: true,
                outputStyle: 'expanded', // nested, expanded, compact, compressed
                sourceComments: false,
                includePaths: [
                    'assets/stylesheets/scss',
                    'assets/bower_components/compass-mixins/lib',
                    'assets/bower_components/bootstrap/scss'
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
            }
        },
        watch: {
            sass: {
                files: [
                    'assets/stylesheets/scss/**/*.scss',
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
        }
    } );

    grunt.registerTask( 'default', 'Watch scss files and compile after change', [
        'auto_install',
        'sass',
        'comments',
        'watch'
    ] );

    grunt.registerTask( 'compile', 'Compile scss files with compression', [
        'auto_install',
        'sass',
        'comments'
    ] );

};