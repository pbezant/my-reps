//initialize all of our variables
var app, base, concat, directory, gulp, gutil, hostname, path, refresh, sass, uglify, imagemin, minifyCSS, del, browserSync, autoprefixer, gulpSequence, shell, sourceMaps, plumber;

var autoPrefixBrowserList = ['last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'];

//load all of our dependencies
//add more here if you want to include more libraries
gulp        = require('gulp');
gutil       = require('gulp-util');
concat      = require('gulp-concat');
uglify      = require('gulp-uglify');
sass        = require('gulp-sass');
sourceMaps  = require('gulp-sourcemaps');
imagemin    = require('gulp-imagemin');
minifyCSS   = require('gulp-minify-css');
// browserSync = require('browser-sync');
autoprefixer = require('gulp-autoprefixer');
gulpSequence = require('gulp-sequence').use(gulp);
shell       = require('gulp-shell');
plumber     = require('gulp-plumber');

var replace = require('gulp-replace');
var rename = require('gulp-rename');
var ssi = require("gulp-ssi");
var connect = require('gulp-connect');

var APP_NAME ="rep_lookup";

//compressing images & handle SVG files
gulp.task('images', function(tmp) {
    gulp.src(['app/images/*.jpg', 'app/images/*.png'])
        //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        .pipe(imagemin({ optimizationLevel: 5, progressive: true, interlaced: true }))
        .pipe(gulp.dest('app/images'));
});

//compressing images & handle SVG files
gulp.task('images-deploy', function() {
    gulp.src(['app/images/**/*', '!app/images/README'])
        //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        .pipe(gulp.dest('dist/images'));

    
});



var vendor_scripts = [
    
    'app/scripts/src/_includes/modernizr-2.6.2.min.js',
    'app/scripts/src/_includes/bootstrap/dist/js/bootstrap.bundle.min.js',
    'app/scripts/src/_includes/jquery.dataTables.min.js',
    'app/scripts/src/_includes/jquery.dataTables.sorting.js',
    'app/scripts/src/_includes/jquery.address.js',
    'app/scripts/src/_includes/dataTables.bootstrap.js',
    'app/scripts/src/_includes/spin.min.js',
    'app/scripts/src/_includes/jquery.spin.js',
    'app/scripts/src/_includes/ejs_production.js',
    'app/scripts/src/lookup_tool.js'

];
gulp.task('scripts', function() {
    //this is where our dev JS scripts are
    // return gulp.src(['app/scripts/src/_includes/**/*.js', 'app/scripts/src/**/*.js'])
    return gulp.src(vendor_scripts)
               
         //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        //this is the filename of the compressed version of our JS
        .pipe(concat('rep_lookup.js'))
        //compress :D
        // .pipe(uglify())
        //catch errors
        .on('error', gutil.log)
        //where we will store our finalized, compressed script
        .pipe(gulp.dest('app/scripts'))
});



//compiling our Javascripts for deployment
gulp.task('scripts-deploy', function() {
    //this is where our dev JS scripts are
    return gulp.src(['app/scripts/rep_lookup.js'])
        //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        //this is the filename of the compressed version of our JS
        .pipe(concat('rep_lookup.js'))
        //compress :D
        .pipe(uglify())
        //where we will store our finalized, compressed script
        .pipe(gulp.dest('dist/scripts'));

   
});
gulp.task('build-wp-plugin', function(){
    gulp.src('dist/**/*',{base:'./'})
        //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())   
        .pipe(gulp.dest('wp_rep_lookup'));

});


//compiling our SCSS files
gulp.task('styles', function() {
    //the initializer / master SCSS file, which will just be a file that imports everything
    return gulp.src('app/styles/scss/init.scss')
                //prevent pipe breaking caused by errors from gulp plugins
                .pipe(plumber({
                  errorHandler: function (err) {
                    console.log(err);
                    this.emit('end');
                  }
                }))
                //get sourceMaps ready
                .pipe(sourceMaps.init())
                //include SCSS and list every "include" folder
                .pipe(sass({
                      errLogToConsole: true,
                      includePaths: [
                          'app/styles/scss/'
                      ]
                }))
                .pipe(autoprefixer({
                   browsers: autoPrefixBrowserList,
                   cascade:  true
                }))
                //catch errors
                .on('error', gutil.log)
                //the final filename of our combined css file
                .pipe(concat(APP_NAME+'.css'))
                //get our sources via sourceMaps
                .pipe(sourceMaps.write())
                //where to save our final, compressed css file
                .pipe(gulp.dest('app/styles'))
                //notify browserSync to refresh
                .pipe(connect.reload());
});

//compiling our SCSS files for deployment
gulp.task('styles-deploy', function() {
    //the initializer / master SCSS file, which will just be a file that imports everything
    return gulp.src('app/styles/scss/init.scss')
    .pipe(plumber())
    //include SCSS includes folder
    .pipe(sass({
          includePaths: [
              'app/styles/scss',
          ]
    }))
    .pipe(autoprefixer({
      browsers: autoPrefixBrowserList,
      cascade:  true
    }))
    //the final filename of our combined css file
    .pipe(concat(APP_NAME+'.css'))
    .pipe(minifyCSS())
    //where to save our final, compressed css file
    .pipe(gulp.dest('dist/styles'));
});


 
gulp.task('connect', function() {
  connect.server({
    root: 'dist',
    livereload: true
  });
});
 
gulp.task('html', function () {
  gulp.src('app/**/*.html')
    .pipe(ssi())
    .pipe(gulp.dest('dist'))
    .pipe(connect.reload());
});
 
 

//basically just keeping an eye on all HTML files

//migrating over all HTML files for deployment
gulp.task('html-deploy', function() {
    //grab everything, which should include htaccess, robots, etc
    gulp.src('app/**/*.html')
        //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        .pipe(ssi())
        .pipe(gulp.dest('dist'));

    gulp.src('app/*')
        //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        .pipe(ssi())
        .pipe(gulp.dest('dist'));

    //grab any hidden files too
    gulp.src('app/.*')
        //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        .pipe(gulp.dest('dist'));

    gulp.src('app/fonts/**/*')
        //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        .pipe(gulp.dest('dist/fonts'));

    //grab all of the styles
    gulp.src(['app/styles/*.css', '!app/styles/styles.css'])
        //prevent pipe breaking caused by errors from gulp plugins
        .pipe(plumber())
        .pipe(gulp.dest('dist/styles'));
});

//cleans our dist directory in case things got deleted
gulp.task('clean', function() {
    return shell.task([
      'rm -rf dist'
    ]);
});

//create folders using shell
gulp.task('scaffold', function() {
  return shell.task([
      'mkdir dist',
      'mkdir dist/fonts',
      'mkdir dist/images',
      'mkdir dist/scripts',
      'mkdir dist/styles'
    ]
  );
});

//this is our master task when you run `gulp` in CLI / Terminal
//this is the main watcher to use when in active development
//  this will:
//  startup the web server,
//  start up browserSync
//  compress all scripts and SCSS files
gulp.task('default', ['connect','html','scripts', 'styles'], function() {
    //a list of watchers, so it will watch all of the following files waiting for changes
    gulp.watch('app/scripts/src/**', ['scripts']);
    gulp.watch('app/styles/scss/**', ['styles']);
    gulp.watch('app/images/**', ['images']);
    gulp.watch('app/**/*.html', ['html']);
});

//this is our deployment task, it will set everything for deployment-ready files
gulp.task('deploy', ['clean', 'scaffold', 'html', 'html-deploy', 'scripts', 'scripts-deploy', 'styles-deploy', 'images-deploy']);
