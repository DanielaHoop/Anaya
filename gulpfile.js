var gulp        = require('gulp'),
    pug         = require('gulp-pug'),
    stylus      = require('gulp-stylus'),
    uglify      = require('gulp-uglify'),
    browserSync = require('browser-sync').create(),
    reload      = browserSync.reload,
    include     = require("gulp-include"),
    plumber     = require('gulp-plumber');

//- Task

gulp.task('serve',serve);
gulp.task('compileAllPug',compileAllPug);
gulp.task('compileStyle',compileStyle);
gulp.task('watch',watch);

gulp.task('default',['serve','watch']);
gulp.task('dist',['compileAllPug','compileStyle','compileScripts']);
//- fn

function compilePug(path){
  gulp.src(path)
  .pipe(plumber())
  .pipe(pug({
    pretty: true 
  }))
  .pipe(gulp.dest('./dist'))
  .pipe(reload({stream:true}));
}

function compileAllPug(){
  gulp.src('source/pug/sections/*.pug')
  .pipe(plumber())
  .pipe(pug({
    pretty: true 
  }))
  .pipe(gulp.dest('./dist'))
  .pipe(reload({stream:true}));
}

function compileStyle(){
  gulp.src(['source/styl/style.styl'])
  .pipe(plumber())
  .pipe(stylus())
  .pipe(gulp.dest('./dist/css'))
  .pipe(reload({stream:true}));
}

function compileScripts(path){
  gulp.src(path
    )
  .pipe(plumber())
  .pipe(include())
  .pipe(uglify())
  .pipe(gulp.dest('./dist/js'))
  .pipe(reload({stream:true}));
}

function watch(){
  gulp.watch('source/styl/**/*.styl', ['compileStyle']);
  gulp.watch('source/pug/templates/*.pug', ['compileAllPug']);
  gulp.watch('source/pug/sections/*.pug', function(event){
    compilePug(event.path);
  });
  gulp.watch('source/js/*.js', function(event){
    compileScripts(event.path);
  });
}

function serve(){
  browserSync.init({
        server: "./dist"
    });
};