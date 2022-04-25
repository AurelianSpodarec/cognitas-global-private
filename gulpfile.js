const gulp = require('gulp'),
    sass = require("gulp-sass"),
    // browserSync = require('browser-sync').create(),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat');


var paths = {
    styles: {
        src: 'assets/src/scss/**/*.scss',
        dest: 'build/css/'
    },
    javaScript: {
        src: 'assets/src/js/*.js',
        dest: 'build/js/'
    }
};


// TODO: Add browsify for automatic hot-reloading

function scripts() {
    return gulp
        .src(paths.javaScript.src)
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(gulp.dest(paths.javaScript.dest))
}

function style() {
    return gulp
        .src(paths.styles.src)
        .pipe(sass())
        .on("error", sass.logError)
        .pipe(gulp.dest(paths.styles.dest));
}

function watch() {
    style();
    scripts();

    gulp.watch(paths.styles.src, style);
    gulp.watch(paths.javaScript.src, scripts);
}

exports.style = style;
exports.watch = watch