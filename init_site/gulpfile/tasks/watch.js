var config = require('../config');

if(!config.tasks) return;

var gulp = require('gulp'),
    watch = require('gulp-watch');

var watchFunc = function() {
    watch([config.tasks.html.watch], function(event, cb) {
        gulp.start('html:build');
    });
    watch([config.tasks.css.watch], function(event, cb) {
        gulp.start('sass:build');
    });
    watch([config.tasks.images.watch], function(event, cb) {
        gulp.start('image:build');
    });
    watch([config.tasks.fonts.watch], function(event, cb) {
        gulp.start('fonts:build');
    });

    watch([config.tasks.sprite.rootSprite], function(event, cb) {
        gulp.start('sprite:build');
    });
};

gulp.task('watch', watchFunc);
module.exports = watchFunc;