'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
const cssnano = require('gulp-cssnano');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const clean = require('gulp-clean');
const rename = require('gulp-rename');
const concat =  require('gulp-concat');
const minify = require('gulp-minify');

gulp.task('clean', function() {
  return gulp.src('./assets/dist/**/*/', {read: false})
  .pipe(clean());
});

gulp.task('css', function(){
  return gulp.src('./assets/src/scss/*.scss') 
    .pipe(sass({outputStyle:"nested"}).on('error', sass.logError))
    .pipe(gulp.dest('./assets/dist/css'))
});

gulp.task('min-css', function () {
  return gulp.src('./assets/src/scss/*.scss')
  .pipe(sourcemaps.init())
  .pipe(sass(
    {
      outputStyle: "compressed",
      sourceComments: false
    }
  ).on('error', sass.logError))
  .pipe(autoprefixer({
  cascade: false
  }))
  .pipe(cssnano())
  .pipe(rename({suffix: ".min"}))
  .pipe(concat('style.min.css'))
  .pipe(sourcemaps.write('./', {addComment: false}))
  .pipe(gulp.dest('./assets/dist/css'))
});

gulp.task('js-mini', function() {
  return gulp.src('./assets/src/js/*.js')
    .pipe(minify())
    .pipe(gulp.dest('./assets/dist/js/'))
});

gulp.task('watch', function () {
  gulp.watch('./assets/src/**/*', gulp.series('css','min-css','js-mini'));
});

gulp.task('default', gulp.series('watch','css', 'min-css','js-mini'));

