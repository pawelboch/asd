module.exports = function( grunt ) {

    // Load grunt tasks automatically
    require('load-grunt-tasks')(grunt);

    // Time how long tasks take. Can help when optimizing build times
    require('time-grunt')(grunt);

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            options: {
                outputStyle: 'expanded', // nested, expanded, compact, compressed
                sourceComments: true,
                includePaths: [
                    'assets/stylesheets/scss',
                    'assets/bower_components/compass-mixins/lib',
                    'assets/bower_components/bootstrap/scss'
                ]
            },
            bootstrap: {
                options: {
                    sourceMap: 'assets/stylesheets/map/bootstrap.css.map'
                },
                files: {
                    'assets/stylesheets/css/bootstrap.css': 'assets/stylesheets/scss/bootstrap.scss'
                }
            },
            style: {
                options: {
                    sourceMap: 'assets/stylesheets/map/style.css.map'
                },
                files: {
                    'assets/stylesheets/css/style.css': 'assets/stylesheets/scss/style.scss'
                }
            },
            minify: {
                options: {
                    sourceMap: false,
                    outputStyle: 'compressed',
                    sourceComments: false
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
                tasks: ['sass:style'],
                options: {
                    spawn: false
                }
            },
            sassBootstrap: {
                files: 'assets/stylesheets/scss/bootstrap.scss',
                tasks: ['sass:bootstrap'],
                options: {
                    spawn: false
                }
            },
            sassMain: {
                files: 'assets/stylesheets/scss/main.scss',
                tasks: ['sass:minify'],
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
                    bower: '--allow-root'
                }
            }
        }
    });

    grunt.registerTask( 'default', 'Watch scss files and compile after change', [
        'auto_install',
        'sass',
        'watch'
    ]);

    grunt.registerTask( 'compile', 'Compile scss files with compression', [
        'sass'
    ]);

};