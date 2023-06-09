const { src, dest, watch, parallel, series } = require('gulp');
const concat = require('gulp-concat');
const plumber = require('gulp-plumber');
const uglify = require('gulp-uglify');
const sass = require('gulp-dart-sass');
const autoprefixer = require('gulp-autoprefixer');
const rename = require('gulp-rename');
const babel = require('gulp-babel');
const browserSync = require('browser-sync').create();
var manifest = require('./manifest.json');
var config = manifest.config;

function compileSCSS() {
	return src(['assets/scss/*.scss'])
		.pipe(sass({ outputStyle: 'compressed' }))
		.pipe(autoprefixer())
		.pipe(dest('css'))
		.pipe(browserSync.stream());
}

function buildSiteJS() {
	return src([
		'assets/js/site.js',
		'assets/js/desktop-menu.js',
		'assets/js/mobile-menu.js',
		'assets/js/sticky-navigation.js'
	])
		.pipe(plumber())
		.pipe(concat('site.js'))
		.pipe(babel({
			presets: ['@babel/preset-env']
		}))
		.pipe(uglify())
		.pipe(dest('js'))
		.pipe(browserSync.reload({ stream: true }));
}

function buildPartialJS() {
	return src([
		'assets/js/*.js',
		'!assets/js/site.js',
		'!assets/js/desktop-menu.js',
		'!assets/js/mobile-menu.js',
		'!assets/js/sticky-navigation.js'
	])
		.pipe(plumber())
		.pipe(babel({
			presets: ['@babel/preset-env']
		}))
		.pipe(uglify())
		.pipe(dest('js'))
		.pipe(browserSync.reload({ stream: true }));
}

function serveBrowserSync(cb) {
	browserSync.init({
		proxy: config.url,
		ui: {
			port: 3070,
		},
		notify: true,
	});

	cb();
}

function reloadPage(cb) {
	browserSync.reload();
	cb();
}

function watchChanges(cb) {
	watch(['assets/js/site.js', 'assets/js/desktop-menu.js', 'assets/js/mobile-menu.js', 'assets/js/sticky-navigation.js'], parallel(buildSiteJS));
	watch(['assets/js/*.js', '!assets/js/site.js', '!assets/js/desktop-menu.js', '!assets/js/mobile-menu.js', '!assets/js/sticky-navigation.js'], parallel(buildPartialJS));
	watch(['assets/scss/*.scss', 'assets/scss/**/*.scss'], parallel(compileSCSS));

	watch(['**/*.php', 'assets/img/*'], parallel(reloadPage));

	cb();
}

function mainTasks(cb) {
	buildSiteJS();
	buildPartialJS();
	compileSCSS();

	cb();
}

exports.default = parallel(serveBrowserSync, mainTasks, watchChanges);