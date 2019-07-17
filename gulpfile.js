var gulp = require('gulp');
var stringReplace = require('gulp-string-replace');
var config = {
	plugin: {
        name: 'Starter Kit Plugin',	// Change plugin name
		prefix: 'StarterKit',		// Change plugin prefix
		singleton: 'Starter_Kit',	// Change plugin main class
		textdomain: 'starter-kit',	// Change textdomain
		styles: 'starter-kit',		// Change CSS styles prefix
		author: 'SolidBunch',		// Change author
		plugin_uri: 'https://github.com/SolidBunch/Starter-Kit', 	// Change plugin URI
		author_uri: 'https://solidbunch.com',	// Change author URI
	}
};

// Project paths
var paths = {
	
	toReplace: {
		src: ['./**/*.php', './**/*.css', './**/*.scss', './**/*.js', '!vendor/**/*.*','!vendor-custom/**/*.*', '!node_modules/**/*.*', '!./gulpfile.js'],
	},
};

gulp.task('replaceNames', function () {

	return gulp.src(paths.toReplace.src)
		.pipe(stringReplace('StarterKit', config.plugin.prefix))
		.pipe(stringReplace('Starter_Kit', config.plugin.singleton))

		// Styles, classes, ID
		.pipe(stringReplace('class="starter-kit-', 'class = "' + config.plugin.styles + '-'))
		.pipe(stringReplace('class = "starter-kit-', 'class = "' + config.plugin.styles + '-'))
		.pipe(stringReplace('class="starter-kit_', 'class = "' + config.plugin.styles + '_'))
		.pipe(stringReplace('class = "starter-kit_', 'class = "' + config.plugin.styles + '_'))
		.pipe(stringReplace('#starter-kit-', '#' + config.plugin.styles + '-'))
		.pipe(stringReplace('id="starter-kit-', 'id = "' + config.plugin.styles + '-'))
		.pipe(stringReplace('id = "starter-kit-', 'id = "' + config.plugin.styles + '-'))
		.pipe(stringReplace('\'starter-kit_', '\'' + config.plugin.styles + '_'))
		.pipe(stringReplace('\\.starter-kit-', '.' + config.plugin.styles + '-'))
		.pipe(stringReplace('\\.starter-kit_', '.' + config.plugin.styles + '_'))

		// Textdomain
		.pipe(stringReplace('Text Domain: starter-kit', 'Text Domain: ' + config.plugin.textdomain))
		.pipe(stringReplace('\'starter-kit', '\'' + config.plugin.textdomain))
		.pipe(stringReplace('\"starter-kit', '"' + config.plugin.textdomain))

		.pipe(stringReplace('Starter Kit Plugin', config.plugin.name))

		.pipe(stringReplace('SolidBunch', config.plugin.author))
		.pipe(stringReplace('https://github.com/SolidBunch/Starter-Kit', config.plugin.plugin_uri))
		.pipe(stringReplace('https://solidbunch.com', config.plugin.author_uri))

		.pipe(gulp.dest(function (file) {
			return file.base;  // THE SAME DIR
		}));
});
