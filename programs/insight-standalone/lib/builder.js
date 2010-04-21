

function dump(obj) { print(require('test/jsdump').jsDump.parse(obj)) };


var BUILDER = require("builder/program", "http://registry.pinf.org/cadorn.org/github/pinf/packages/common/");
var LOCATOR = require("package/locator", "http://registry.pinf.org/cadorn.org/github/pinf/packages/common/");
var PINF = require("pinf", "http://registry.pinf.org/cadorn.org/github/pinf/packages/common/");
var UTIL = require("util");
var OS = require("os");


var ProgramBuilder = exports.ProgramBuilder = function() {
    if (!(this instanceof exports.ProgramBuilder))
        return new exports.ProgramBuilder();
}

ProgramBuilder.prototype = BUILDER.ProgramBuilder();


ProgramBuilder.prototype.build = function(buildOptions) {

    var rawBuildPath = this.rawPackage.getPath(),
        targetBasePath = this.targetPackage.getPath(),
        sourcePath,
        targetPath,
        command;

    targetPath = targetBasePath.join("lib");
    targetPath.mkdirs();
    [
        "packages/insight/lib",
        "packages/lib-php/lib",
        "packages/wildfire/lib"
    ].forEach(function(path) {
        sourcePath = rawBuildPath.join(path);
        command = "rsync -r --copy-links --exclude \"- .DS_Store\" --exclude \"- .git/\" " + sourcePath + "/* " + targetPath;
        print(command);
        OS.command(command);
    });

    targetPath = targetBasePath.join("examples");
    targetPath.mkdirs();
    sourcePath = this.sourcePackage.getPath().join("examples");
    command = "rsync -r --copy-links --exclude \"- .DS_Store\" --exclude \"- .git/\" --exclude \"- .tmp_*/\" " + sourcePath + "/* " + targetPath;
    print(command);
    OS.command(command);
    
    rawBuildPath.join("package.json").copy(targetBasePath.join("package.json"));
}
