module.exports =  function(grunt) {
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-copy');

	grunt.initConfig({
		copy: {
			main: {
				expand: true,
				src: ['*.php', 'css/*.css'],
				dest: '/Applications/MAMP/htdocs/wp-content/plugins/celulas-cfer/',
			},
			dist: {
				expand: true,
				src: ['*.php', 'css/*.css', 'readme.md'],
				dest: 'dist/',
			}
		},
		watch: {
			files: ['*.*', 'css/*.css'],
			tasks: ['copy:main'],
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
	grunt.registerTask('dist', ['copy:dist']);
};
