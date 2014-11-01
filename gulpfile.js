var cssDir  = 'public/assets/css/',
	jsDir   = 'public/assets/js/',
	lessDir = 'resources/less/';

var gulp      = require('gulp'),
	less      = require('gulp-less'),
	concat    = require('gulp-concat'),
	minifyCss = require('gulp-cleancss'),
	minifyJs  = require('gulp-uglify'),
	prefixer  = require('gulp-autoprefixer'),
	rename    = require('gulp-rename');

/**
 * Compiles LESS master file into a CSS file
 */
gulp.task('less', function () {
	var master = lessDir + 'master.less';

	gulp.src(master)
		.pipe(less())
		.pipe(prefixer())
		.pipe(gulp.dest(cssDir));
});

/**
 * Concatenates all JavaScript and CSS files into only one `united` file.
 */
gulp.task('unite', function () {
	// CSS
	gulp.src(cssDir + '**/*.css')
		.pipe(concat('united.css'))
		.pipe(gulp.dest(cssDir));

	// JS
	gulp.src(jsDir + '**/*.js')
		.pipe(concat('united.js'))
		.pipe(gulp.dest(jsDir));
});

/**
 * Minifies all JavaScript and CSS files and adds a `min` suffix.
 */
gulp.task('minify', function () {
	// CSS
	gulp.src(cssDir + '**/!(*.min.css).css')
		.pipe(minifyCss({
			processImport: true
		}))
		.pipe(rename(function (path) {
			path.extname = '.min.css'
		}))
		.pipe(gulp.dest(cssDir));

	// JS
	gulp.src(jsDir + '**/!(*.min.js).js')
		.pipe(minifyJs())
		.pipe(rename(function (path) {
			path.extname = '.min.js'
		}))
		.pipe(gulp.dest(jsDir));
});

gulp.task('default', ['less', 'unite', 'minify']);
