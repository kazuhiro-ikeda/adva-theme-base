var gulp = require('gulp');
var sass = require('gulp-sass');
var sassGlob = require("gulp-sass-glob");
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var through2 = require('through2');

gulp.task('sass', function() {
  return gulp.src('./css/**/*.scss')
	.pipe(plumber({
            errorHandler: notify.onError("Error: <%= error.message %>")
        }))
    .pipe(sassGlob())
    .pipe(sass({ outputStyle: 'expanded' }))
    // タイムスタンプを書き換える
    .pipe(through2.obj((chunk, enc, callback)=>{
      const date = new Date();
      chunk.stat.atime = date;
      chunk.stat.mtime = date;
      callback(null, chunk);
    }))
    .pipe(gulp.dest('./css'));
});

gulp.task('sass:watch', function() {
  gulp.watch('./css/**/*.scss', gulp.task('sass'));
});
