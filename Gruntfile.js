module.exports = function(grunt) {
  var config = {};

  
  config.uglify = {
    options: {
      compress: true,
      sourceMap: true
    },
    app: {
      src: ['js/src/app.js'],
      dest: 'js/app.min.js'
    } 
  };
  

  
  config.sass = {
    options: {
      style: 'compressed'
    },
    app: {
      files: {
        'style.css': 'sass/style.scss'
      }
    }
  };
  

  config.watch = {
    
      sass: {
      files: ['sass/**/*.scss'],
      tasks: ['sass']
    },
    
    js: {
      files: ['js/src/**/*.js'],
      tasks: ['uglify']
    }
  };

  grunt.initConfig(config);
  
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks("grunt-contrib-uglify");
  grunt.loadNpmTasks('grunt-contrib-watch');

  var defaultTasks = [];
 
  defaultTasks.push('sass');
  defaultTasks.push('uglify');
  
  grunt.registerTask('default', defaultTasks);
};