var gulp 		= require('gulp'),
	sass 		= require('gulp-sass'),
	browserSync = require('browser-sync'),
	concat 		= require('gulp-concat'),
	uglify		= require('gulp-uglifyjs'),
	cssnano		= require('gulp-cssnano'),
	rename		= require('gulp-rename'),
	del			= require('del'),
	imagemin 	= require('gulp-imagemin'),
	pngquant 	= require('imagemin-pngquant'),
	cache 		= require('gulp-cache'),
	autoprefixer= require('gulp-autoprefixer');


gulp.task('sass', function(){
	return gulp.src('app/sass/**/*.sass')
	.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
	.pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }))
	.pipe(gulp.dest('app/css'))
	.pipe(browserSync.reload({stream: true}))
});

gulp.task('scripts', function(){
	return gulp.src([
		'app/libs/jquery.magnific-popup.min.js',
		'app/libs/slick.min.js',
		'app/libs/jquery.maskedinput.min.js'
	])
	.pipe(concat('libs.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('app/js'));
});

gulp.task('csslibs', ['sass'], function(){
	gulp.src('app/css/libs.css')
	//.pipe(cssnano())
	.pipe(rename({suffix: '.min'}))
	.pipe(gulp.dest('app/css'));

    gulp.src([
        'app/css/style.css',
        'app/css/libs.min.css'
    ]).pipe(gulp.dest('dist/css'));
});

gulp.task('browser-sync', function(){
	browserSync({
		server: {
			baseDir: 'app'
		},
		notify:false
	});
});

gulp.task('clean', function(){
	return del.sync('dist');
});

gulp.task('clear', function(){
	return cache.clearAll();
});


gulp.task('img', function(){
	return gulp.src('app/img/**/*')
	.pipe(cache(imagemin({
		intarlaced: true,
		progressive: true,
		svgoPlugins: [{removeViewBox: false}],
		use: [pngquant()]
	})))
	.pipe(gulp.dest('dist/img'));
});

gulp.task('watch', ['build'], function(){
	gulp.watch('app/sass/**/*.sass', ['build']);
});

gulp.task('build', ['sass'], function(){
	var buildCss = gulp.src([
			'app/css/style.css',
			'app/css/libs.min.css',
		])
		.pipe(gulp.dest('dist/css'));
});
gulp.task('default', ['watch']);