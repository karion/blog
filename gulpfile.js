'use strict';

const path = require('path');
const gulp = require('gulp');
const sass = require('gulp-sass');

const sourcePath = path.resolve(__dirname, 'source');

gulp.task('sass', function () {
  gulp.src(`${sourcePath}/scss/main.scss`)
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest(`${sourcePath}/css`))
  ;
});

gulp.task('sass:watch', function () {
  gulp.start('sass');
  gulp.watch(`${sourcePath}/scss/**/*.scss`, ['sass']);
});

gulp.task('default', ['sass']);
gulp.task('watch', ['sass:watch']);