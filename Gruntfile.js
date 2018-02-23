module.exports =  function(grunt) {
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-copy');

	grunt.initConfig({
		copy: {
			main: {
				expand: true,
				src: ['*.php', 'views/*.*', 'css/*.css'],
				dest: '/Applications/MAMP/htdocs/wp-content/plugins/celulas-cfer/',
			},
		},
		watch: {
			files: ['*.*', 'views/*.*', 'css/*.css'],
			tasks: ['copy'],
			options: {
				event: ['all'],
				dateFormat: function(time) {
					grunt.log.writeln(('The watch finished in ' + time + 'ms')['cyan']);
					grunt.log.writeln('Waiting for more changes...'['green']);
				},
			},
		},
	});

	grunt.registerTask('default', ['watch']);
};
