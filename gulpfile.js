const { src, dest, parallel, watch } = require("gulp");
const autoprefixer = require("autoprefixer");
const browserify = require("browserify");
const buffer = require("vinyl-buffer");
const concat = require("gulp-concat");
const gettextParser = require("gettext-parser");
const minifyCSS = require("gulp-csso");
const minimist = require("minimist");
const package = require("./package.json");
const postcss = require("gulp-postcss");
const rename = require("gulp-rename");
const replace = require('gulp-replace');
const sass = require("gulp-sass");
const source = require("vinyl-source-stream");
const sourcemaps = require("gulp-sourcemaps");
const through = require("through2");
const uglify = require("gulp-uglify");

const argv = minimist(process.argv.slice(2));
const env = argv.env || "development";
const writeSourcemap = env === "development";
const destDir = argv.dest || "dist";

const cssSources = [
    "style/**/*.scss",
    "!style/admin/**/*.scss"
];

const jsSources = [
    "js/**/*.js",
    "!js/admin/**/*.js"
];

const phpSources = [
    "src/**/*.php"
];

const assetSources = [
    "assets/**/*.*"
];

const translationSources = [
    "translations/**/*.po"
];

function css() {
    let stream = src("style/style.scss");

    if (writeSourcemap)
        stream = stream.pipe(sourcemaps.init());

    stream = stream
        .pipe(sass())
        .pipe(concat("style.css"))
        .pipe(postcss([ autoprefixer() ]))
        .pipe(minifyCSS())
        .pipe(replace("{{version}}", package.version));

    if (writeSourcemap)
        stream = stream.pipe(sourcemaps.write("./"));

    return stream.pipe(dest(destDir));
}

function js() {
    const b = browserify({
        entries: "./js/index.js",
        debug: env === "development"
    });

    let stream = b.bundle()
        .pipe(source("index.js"))
        .pipe(buffer());

    if (writeSourcemap)
        stream = stream.pipe(sourcemaps.init());

    stream = stream.pipe(uglify());

    if (writeSourcemap)
        stream = stream.pipe(sourcemaps.write("./"));

    return stream.pipe(dest(destDir));
}

function php() {
    return src(phpSources)
        .pipe(replace("{{version}}", package.version))
        .pipe(dest(destDir));
}

function assets() {
    return src(assetSources)
        .pipe(dest(destDir));
}

function translations() {
    return src(translationSources)
        .pipe(through.obj((chunk, _enc, cb) => {
            const po = gettextParser.po.parse(chunk.contents);
            chunk.contents = gettextParser.mo.compile(po);
            cb(null, chunk);
        }))
        .pipe(rename(function (path) {
            path.extname = ".mo";
        }))
        .pipe(dest(destDir));
}

const tasks = [
    { task: css, source: cssSources },
    { task: js, source: jsSources },
    { task: php, source: phpSources },
    { task: assets, source: assetSources },
    { task: translations, source: translationSources }
];

// Export tasks and build global task
const taskFunctions = [];
const watchTaskFunctions = [];

for (let task of tasks) {
    exports[task.task.name] = task.task;
    taskFunctions.push(task.task);

    const watchTask = function () {
        return watch(task.source, task.task);
    };

    Object.defineProperty(watchTask, "name", { value: task.task.name + ":watch" });
    exports[task.task.name + ":watch"] = watchTask;
    watchTaskFunctions.push(watchTask);
}

exports.default = parallel.apply(null, taskFunctions);
exports.watch = parallel.apply(null, watchTaskFunctions);
