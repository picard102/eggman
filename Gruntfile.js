var timer = require("grunt-timer");
module.exports = function(grunt) {
  require('load-grunt-tasks')(grunt);
  timer.init(grunt);
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

  /*=============================================
  =            SASS                             =
  =============================================*/

  /*==========  grunt sass - LibSass compile  ==========*/
    sass: {
      build: {
        options: {
          sourceMap: false,
          outputStyle: 'compressed',
          sourceComments: false,
          includePaths: require('node-bourbon').includePaths
        },
        files: {'<%= pkg.path.buildpath %><%= pkg.name %>/style.css': '<%= pkg.path.srcpath %><%= pkg.path.scss %>/style.scss',
        '<%= pkg.path.buildpath %><%= pkg.name %>/admin.css': '<%= pkg.path.srcpath %><%= pkg.path.scss %>/admin.scss' }
      },
      dev: {
        options: {
          sourceMap: true,
          outputStyle: 'expanded',
          sourceComments: false,
          includePaths: require('node-bourbon').includePaths
        },
        files: {'<%= pkg.path.buildpath %><%= pkg.name %>/style.css': '<%= pkg.path.srcpath %><%= pkg.path.scss %>/style.scss',
        '<%= pkg.path.buildpath %><%= pkg.name %>/admin.css': '<%= pkg.path.srcpath %><%= pkg.path.scss %>/admin.scss' }
      }
    },

  /*==========  grunt scsslint - Linting via scss-lint gem  ==========*/
    scsslint: {
      newerFiles: ['<%= scsslintCurrentFile %>'],
      dev: {
        src: [ '<%= pkg.path.srcpath %><%= pkg.path.scss %>/**/*.scss', '!<%= pkg.path.srcpath %><%= pkg.path.scss %>/utils/_responsive.scss' ]
      },
        options: {
          config: '<%= pkg.path.srcpath %><%= pkg.path.scss %>/scss-lint.yml',
          colorizeOutput: true
        },

    },

  /*==========  grunt banner - Add theme info to css  ==========*/
    WPBuild: '/* \nTheme Name: <%= pkg.props.theme_name %>\n' +
        'Version: <%= pkg.version %>\n' +
        'Description: \n' +
        'Author: <%= pkg.props.author_name %>\n' +
        'Author URI: <%= pkg.props.author_url %>\n' +
        'Last Compiled: <%= grunt.template.today("yyyy-mm-dd") %>\n*/\n',

    WPDev: '/* \nTheme Name: <%= pkg.props.theme_name %> Dev\n' +
        'Version: <%= pkg.version %>\n' +
        'Description: \n' +
        'Author: <%= pkg.props.author_name %>\n' +
        'Author URI: <%= pkg.props.author_url %>\n' +
        'Last Compiled: <%= grunt.template.today("yyyy-mm-dd") %>\n*/\n',

    usebanner: {
      build: {
          options: {
            position: 'top',
            banner: '<%= WPBuild %>'
          },
          files: { src: [ '<%= pkg.path.buildpath %><%= pkg.name %>/style.css', '<%= pkg.path.buildpath %><%= pkg.name %>/admin.css' ]  }
      },
      dev: {
          options: {
            position: 'top',
            banner: '<%= WPDev %>'
          },
          files: { src: [ '<%= pkg.path.buildpath %><%= pkg.name %>/style.css', '<%= pkg.path.buildpath %><%= pkg.name %>/admin.css' ] }
      }
    },

  /*=============================================
  =            JS Functions                     =
  =============================================*/

  /*==========  JSHint - Check JS  ==========*/
    jshint: {
      options: {
        curly: true,
        eqeqeq: true,
        eqnull: true,
        browser: true,
        globals: { jQuery: true },
      },
      dev: ['<%= pkg.path.srcpath %><%= pkg.path.js %>/**/*.js', '!<%= pkg.path.srcpath %><%= pkg.path.js %>/vendor/**/*.js'],
      newerFiles: ['<%= jslintCurrentFile %>'],
    },

  /*==========  JSHint - Check JS  ==========*/
    concat: {
      options: {
        separator: ';',
        banner: '(function($) { $(function() {\n\n',
        footer: '\n\n}); })(jQuery);'
      },
     dist: {
        src: ['<%= pkg.path.srcpath %><%= pkg.path.js %>/frontend.js'],
        dest: '<%= pkg.path.buildpath %><%= pkg.name %>/built.js',
      },
      admin: {
        src: ['<%= pkg.path.srcpath %><%= pkg.path.js %>/admin.js'],
        dest: '<%= pkg.path.buildpath %><%= pkg.name %>/admin.js',
      },
    },

  /*==========  Uglify - compress JS  ==========*/
    uglify: {

      dev: {
        options: {
          sourceMap: true,
          sourceMapName: '<%= pkg.path.buildpath %><%= pkg.name %>/built.js.map',
          beautify: true,
          banner: '/*! <%= pkg.name %>_Dev - v<%= pkg.version %> - '+'<%= grunt.template.today("yyyy-mm-dd") %> */'
        },
        files: {
          '<%= pkg.path.buildpath %><%= pkg.name %>/built.js': ['<%= pkg.path.buildpath %><%= pkg.name %>/built.js']
        }
      },
      build: {
        options: {
          banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - '+'<%= grunt.template.today("yyyy-mm-dd") %> */',
          compress: { drop_console: true }
        },
        files: {
          '<%= pkg.path.buildpath %><%= pkg.name %>/built.js': ['<%= pkg.path.buildpath %><%= pkg.name %>/built.js']
        }
      },
      devadmin: {
        options: {
          sourceMap: true,
          sourceMapName: '<%= pkg.path.buildpath %><%= pkg.name %>/admin.js.map',
          beautify: true,
          banner: '/*! <%= pkg.name %>_Dev - v<%= pkg.version %> - '+'<%= grunt.template.today("yyyy-mm-dd") %> */'
        },
        files: {
          '<%= pkg.path.buildpath %><%= pkg.name %>/admin.js': ['<%= pkg.path.buildpath %><%= pkg.name %>/admin.js']
        }
      },
      buildadmin: {
        options: {
          banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - '+'<%= grunt.template.today("yyyy-mm-dd") %> */',
          compress: { drop_console: true }
        },
        files: {
          '<%= pkg.path.buildpath %><%= pkg.name %>/admin.js': ['<%= pkg.path.buildpath %><%= pkg.name %>/admin.js']
        }
      }

    },

  /*=============================================
  =            SVG                              =
  =============================================*/

  /*==========  SVGMin - cleanup and compress svg  ==========*/
    svgmin: {
      options: {
        plugins: [
        { removeViewBox: false },
        { removeUselessStrokeAndFill: true },
        { cleanupIDs: true }
        ]
      },
      dist: {
        expand: true,
        cwd: '<%= pkg.path.srcpath %><%= pkg.path.svg %>',
        src: ['*.svg', 'icons/*.svg'],
        dest: '<%= pkg.path.buildpath %><%= pkg.name %>/<%= pkg.path.svg %>/'
      }
    },

  /*==========  SVGStore - generate svg sprite  ==========*/
    svgstore: {
      options: {
        includedemo: false,
        cleanup: true,
      },
      default: {
        files: {'<%= pkg.path.buildpath %><%= pkg.name %>/<%= pkg.path.svg %>/svg-sprite.svg': ['<%= pkg.path.buildpath %><%= pkg.name %>/<%= pkg.path.svg %>/icons/*.svg']},
      }
    },

  /*=============================================
  =            Image                            =
  =============================================*/

  /*==========  ImageMin - compress raster files  ==========*/
    imagemin: {
      dynamic: {
        options: { optimizationLevel: 4},
        files: [{
          expand: true,
          cwd: '<%= pkg.path.srcpath %><%= pkg.path.img %>',
          src: ['*.{png,jpg,gif}'],
          dest: '<%= pkg.path.buildpath %><%= pkg.name %>/<%= pkg.path.img%>'
        }]
      }
    },

  /*==========  ImageOptim - compress raster files again  ==========*/
    imageoptim: {
      myTask: {
        src: ['<%= pkg.path.buildpath %><%= pkg.name %>/<%= pkg.path.img%>/*.{png,jpg,gif}']
      }
    },

  /*=============================================
  =            Code Validation                  =
  =============================================*/

  /*==========  PHP Lint  ==========*/
    phplint: {
      newerFiles: ['<%= phplintCurrentFile %>'],
      all: {
        src: [  '<%= pkg.path.srcpath %>**/*.php', '!<%= pkg.path.srcpath %>includes/vendor/**/*.php' ]
      },

    },

  /*==========  PHP CS  ==========*/
    phpcs: {
      newerFiles: ['<%= phplintCurrentFile %>'],
      all: {
        src: [  '<%= pkg.path.srcpath %>/**/*.php', '!<%= pkg.path.srcpath %>includes/vendor/**/*.php' ]
      },
      options: {
        standard: 'Wordpress',
        errorSeverity: 5,
        warningSeverity: 6,
      }
    },

  /*=============================================
  =            Version Bump                     =
  =============================================*/
    bump: {
      options: {
        files: ['package.json'],
        updateConfigs: ['pkg'],
        commit: true,
        commitMessage: 'Release v%VERSION%',
        commitFiles: ['package.json'],
        createTag: true,
        tagName: 'v%VERSION%',
        tagMessage: 'Version %VERSION%',
        push: false,
      }
    },

  /*=============================================
  =            Moves                            =
  =============================================*/

  /*==========  Clean - clean up folders for copying  ==========*/
    clean: {
      build: ['<%= pkg.path.buildpath %><%= pkg.name %>/*'],
      img: ['<%= pkg.path.buildpath %><%= pkg.name %>/<%= pkg.path.img%>/*'],
      svg: ['<%= pkg.path.buildpath %><%= pkg.name %>/<%= pkg.path.svg%>/*'],
      release: ['deploy/*']
    },

  /*==========  Copy - Copy files to build deploy folder  ==========*/
    copy: {
      build: {
        expand: true,
        cwd: '<%= pkg.path.srcpath %>',
        src: ['**', '!**/img/**', '!**/svg/**', '!**/scss/**', '!**/js/**', 'includes/vendor/*/**', 'assets/js/vendor/*/**',  'assets/js/vendor/**', 'assets/video/*/**'],
        dest: '<%= pkg.path.buildpath %><%= pkg.name %>/'
      },
      tgm: {
        expand: true,
        cwd: 'vendor/copy/tgm-plugin-activation/',
        src: ['**'],
        dest: '<%= pkg.path.buildpath %><%= pkg.name %>/includes/vendor/tgm-plugin'
      },
      cmb: {
        expand: true,
        cwd: 'vendor/copy/cmb2/',
        src: ['**'],
        dest: '<%= pkg.path.buildpath %><%= pkg.name %>/includes/vendor/cmb2'
      },
      img: {
        expand: true,
        cwd: 'src/assets/img/',
        src: ['*.{png,jpg,gif}'],
        dest: '<%= pkg.path.buildpath %><%= pkg.name %>/<%= pkg.path.img%>/'
      },
      deploy: {
        expand: true,
        cwd: '<%= pkg.path.srcpath %>',
        src: ['**', '!**/img/**', '!**/svg/**', '!**/scss/**', '!**/js/**'],
        dest: 'deploy/'
      }
    },




  /*=============================================
  =            Cache Busters                    =
  =============================================*/

  replace: {

    package_v: {
      src: ['<%= pkg.path.buildpath %><%= pkg.name %>/**/*.php'],
      overwrite: true,
      replacements: [{
        from: '@package_version@',
        to: "<%= pkg.version %>"
      }]
    },

    hash: {
      src: ['<%= pkg.path.buildpath %><%= pkg.name %>/**/*.php'],
      overwrite: true,
      replacements: [{
        from: '@hash@',
        to: '<%= pkg.version %>'+'<%= grunt.template.today("yyyymmddHHMMss") %>-' + '<%= (Math.floor((Math.random()*100)+1).toString()) %>'
      }]
    },

    package: {
      src: ['<%= pkg.path.buildpath %><%= pkg.name %>/**/*.php'],
      overwrite: true,
      replacements: [{
        from: '@theme_folder@',
        to: "<%= pkg.name %>"
      }]
    },

    git_link: {
      src: ['<%= pkg.path.buildpath %><%= pkg.name %>/**/*.php'],
      overwrite: true,
      replacements: [{
        from: '@git_link@',
        to: "<%= pkg.props.git_link %>"
      }]
    },

    author_name: {
      src: ['<%= pkg.path.buildpath %><%= pkg.name %>/**/*.php'],
      overwrite: true,
      replacements: [{
        from: '@author_name@',
        to: "<%= pkg.props.author_name %>"
      }]
    },

    author_email: {
      src: ['<%= pkg.path.buildpath %><%= pkg.name %>/**/*.php'],
      overwrite: true,
      replacements: [{
        from: '@author_email@',
        to: "<%= pkg.props.author_email %>"
      }]
    },

    author_url: {
      src: ['<%= pkg.path.buildpath %><%= pkg.name %>/**/*.php'],
      overwrite: true,
      replacements: [{
        from: '@author_url@',
        to: "<%= pkg.props.author_url %>"
      }]
    },

  },

  /*=============================================
  =            Watch Task                      =
  =============================================*/
    watch: {

      options: {
        livereload: 25710,
      },

      grunt: {
        files: ['Gruntfile.js']
      },
      scripts: {
        files: ['<%= pkg.path.srcpath %><%= pkg.path.js %>/**/*.js'],
        tasks: ['jshint:newerFiles','concat','uglify:dev','uglify:devadmin','replace:hash'],
        options: {
          spawn: false,
        }
      },
      images: {
        files: ['<%= pkg.path.srcpath %><%= pkg.path.img %>/*.{png,jpg,gif}'],
        tasks: ['newer:copy:img'],
      },
      svg: {
        files: ['<%= pkg.path.srcpath %><%= pkg.path.svg %>/*.svg'],
        tasks: ['newer:svgmin'],
      },
      svgicons: {
        files: ['<%= pkg.path.srcpath %><%= pkg.path.svg %>/icons/*.svg'],
        tasks: ['newer:svgmin', 'svgstore'],
      },
      sass: {
        files: ['<%= pkg.path.srcpath %><%= pkg.path.scss %>/**/*.scss', '!<%= pkg.path.srcpath %><%= pkg.path.scss %>/style.scss'],
        tasks: ['scsslint:newerFiles','sass:dev','usebanner:dev', 'replace:hash'],
        options: {
          spawn: false,
        }
      },
      php: {
        files: ['<%= pkg.path.srcpath %>**/*.php'],
        tasks: ['copy:build','replace'],
        options: {
          spawn: false,
        }
      },
    }
  });




grunt.event.on('watch', function(action, filepath) {
    // Determine task based on filepath
    var get_ext = function(path) {
        var ret = '';
        var i = path.lastIndexOf('.');
        if ( -1 !== i && i <= path.length ) {
            ret = path.substr(i + 1);
        }
        return ret;
    };

    switch ( get_ext(filepath) ) {
        // SCSS
        case 'scss' :
          grunt.config.set('scsslintCurrentFile', filepath);
          //grunt.task.run('scsslint:newerFiles:[' + filepath + ']');
          break;

        // PHP
        case 'php' :
          grunt.config.set('phplintCurrentFile', filepath);
          break;

        // JS
        case 'js' :
          grunt.config.set('jslintCurrentFile', filepath);
          break;
    }
});


  grunt.registerTask('style', ['scsslint:dev','sass:dev','usebanner:dev']);
  grunt.registerTask('script', ['jshint:dev', 'concat', 'uglify:dev', 'uglify:devadmin']);
  grunt.registerTask('svg', ['svgmin', 'svgstore']);
  grunt.registerTask('img', ['imagemin', 'imageoptim']);
  grunt.registerTask('devwatch', ['watch']);
  grunt.registerTask('init', ['phplint:all','scsslint:dev','jshint:dev','bump-only:patch','clean:build','sass:dev','usebanner:dev','concat','uglify:dev','uglify:devadmin','svgmin','svgstore','copy:img','copy:build','copy:cmb','copy:tgm','replace']);
  grunt.registerTask('dev', ['phplint:all','scsslint:dev','jshint:dev','bump-only:prepatch','clean:build','sass:dev','usebanner:dev','concat','uglify:dev','uglify:devadmin','svgmin','svgstore','copy:img','copy:build','copy:cmb','copy:tgm','replace']);
  grunt.registerTask('build', ['phplint:all','phpcs:all','scsslint:dev','jshint:dev','bump-only:minor','clean:build','sass:build','usebanner:build','concat','uglify:build','uglify:buildadmin','svgmin','svgstore','imagemin','imageoptim','copy:build','copy:cmb','copy:tgm','replace','bump-commit']);


};
