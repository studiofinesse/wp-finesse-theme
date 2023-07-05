import path from 'path';
import plugins from 'gulp-load-plugins';

const $ = plugins({
	config: path.resolve( './package.json' ),
	pattern: [ '*' ],
	postRequireTransforms: {
		sass: sass => sass( $.nodeSass )
	}
});

const IS_DEV = process.argv.includes( '--dev' );

/**
 * @task css
 */
export function css() {
	return $.gulp.src( 'src/css/*.scss' ).pipe( $.plumber() )

	.pipe( ! IS_DEV ? $.through2.obj() : $.sourcemaps.init({ largeFile: true }) )

	.pipe( $.sass({
		importer    : $.nodeSassMagicImporter(),
		includePaths: [ './src/css' ]
	}))

	.pipe( $.postcss([
		$.autoprefixer(),
		$.postcssEasings(),
		$.postcssInlineSvg({
			paths: [ './' ]
		}),
		$.postcssUrl({
			url: url => url.pathname === url.relativePath ? `../${url.url}` : url.url
		}),
		$.postcssSortMediaQueries(),
		$.postcssReporter()
	]))

	.pipe( ! IS_DEV ? $.cleanCss({ level: 2 }) : $.sourcemaps.write( '.', {
		includeContent: false,
		sourceRoot: '../src/css'
	}) )

	.pipe( $.gulp.dest( 'dist' ) )

	.pipe( $.touchFd() );
}

/**
 * @task js
 */
export function js() {
	return $.gulp.src( 'src/js/*.js' ).pipe( $.plumber() )

	.pipe( ! IS_DEV ? $.through2.obj() : $.sourcemaps.init({ largeFile: true }) )

	.pipe( $.include({
		extensions: 'js',
		includePaths: './src/js'
	}))

	.pipe( ! IS_DEV ?
		$.terser({
			compress: {
				drop_console: true,
				drop_debugger: true
			},
			format: {
				comments: false,
			}
		})
		:
		$.sourcemaps.write( '.', {
			includeContent: false,
			sourceRoot: '../src/js'
		})
	)

	.pipe( $.gulp.dest( 'dist' ) )

	.pipe( $.touchFd() );
}

/**
 * @task watch
 */
export function watch() {
	$.gulp.watch( 'src/css/**/*.scss', css );

	$.gulp.watch( 'src/js/**/*.js', js );
}

/**
 * @task sync
 */
export function sync() {
	if ( ! $.fsExtra.existsSync( './browsersync.json' ) ) {
		return Promise.resolve();
	}

	$.browserSync.init( $.fsExtra.readJsonSync( './browsersync.json' ) );

	$.gulp.watch( [ 'dist/*.css', 'dist/*.js', '**/*.php' ] ).on( 'change', file => {
		$.browserSync.reload( file );
	});
}

/**
 * @task clean
 */
export function clean() {
	return $.fsExtra.emptyDir( 'dist' );
}

/**
 * @task build
 */
export const build = $.gulp.series(
	clean,
	$.gulp.parallel( css, js )
);

/**
 * @task default
 */
export default $.gulp.parallel(
	css,
	js,
	watch,
	sync
);
