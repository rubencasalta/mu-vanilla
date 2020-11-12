const	gulp = require('gulp'),
		sass = require('gulp-sass'),
		rename = require('gulp-rename');
		autoprefixer = require('gulp-autoprefixer');

gulp.task('sass', ()=>
	gulp.src('wp-content/themes/mu-vanilla/assets/scss/theme.scss')
	.pipe(rename('theme.min.css'))
	.pipe(sass({
		outputStyle: "compressed",
		sourceComments: false
	}))
	.pipe(autoprefixer({
		versions: ['last 2 browsers']
	}))
	.pipe(gulp.dest('wp-content/themes/mu-vanilla/assets/css/'))
);

gulp.task('default', ()=>{
	gulp.watch('wp-content/themes/mu-vanilla/mu-blocks/**/*.scss', gulp.series('sass'));
	gulp.watch('wp-content/themes/mu-vanilla/assets/scss/**/*.scss', gulp.series('sass'));
});