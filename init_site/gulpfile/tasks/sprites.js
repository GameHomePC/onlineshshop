var config = require('../config');

if(!config.tasks.sprite) return;

var gulp = require('gulp'),
    spritesmith = require("gulp.spritesmith");


gulp.task('sprite', function () {

});

var spriteFunc = function() {
    var spriteData = gulp.src(config.tasks.sprite.rootSprite).pipe(spritesmith({
        imgName: 'sprite.png',
        cssName: '_sprite.styl',
        padding: 5,
        cssTemplate: 'handlebarsStr.css.handlebars'
    }));

    spriteData.img.pipe(gulp.dest(config.tasks.sprite.imagesSprite));
    spriteData.css.pipe(gulp.dest(config.tasks.sprite.cssSprite));
};

gulp.task('sprite:build', spriteFunc);
module.exports = spriteFunc;