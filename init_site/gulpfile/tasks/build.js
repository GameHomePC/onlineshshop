var config = require('../config');

if(!config.tasks) return;

var gulp = require('gulp');

var buildFunc = [
    'html:build',
    'sass:build',
    'fonts:build',
    'sprite:build',
    'webpack'
];

gulp.task('build', buildFunc);
module.exports = buildFunc;