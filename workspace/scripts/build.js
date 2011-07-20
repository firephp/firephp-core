
var FILE = require("modules/file"),
	Q = require("modules/q"),
	SYSTEM = require("modules/system"),
	UTIL = require("modules/util"),
	JSON = require("modules/json");


var pkgPath = FILE.dirname(FILE.dirname(FILE.dirname(module.id))),
	buildPath = pkgPath + "/build",
	tplPath = pkgPath + "/workspace/tpl",
	version = false;

exports.getBuildPath = function()
{
	return buildPath;
}

exports.main = function()
{
	
	SYSTEM.exec("rm -Rf " + buildPath, function()
	{
		FILE.mkdirs(buildPath, 0775);
		
		SYSTEM.exec("git tag", function(stdout)
		{
			version = UTIL.trim(stdout).split("\n").pop().match(/^v(.*)$/)[1];

			// TODO: Compare against version in `../../program.json ~ version` (ensure =)

			module.print("\0cyan(Building version: " + version + "\0)\n");
			
			buildZipArchive(function()
			{
				buildPEARArchive(function()
				{
					done();
				});
			});
		});
	});

	function done()
	{
		module.print("\0green(Done\0)\n");
	}
}

function buildZipArchive(callback)
{
	var targetBasePath = buildPath + "/FirePHPCore-" + version;

	FILE.mkdirs(targetBasePath, 0775);

	SYSTEM.exec("cp -Rf " + pkgPath + "/lib " + targetBasePath, function()
	{
		SYSTEM.exec("cp -Rf " + pkgPath + "/examples " + targetBasePath, function()
		{
			next1();
		});
	});		
	
	function next1()
	{
		var content = FILE.read(tplPath + "/readme.tpl.md");
		content = content.replace(/%%VERSION%%/g, version);
		FILE.write(targetBasePath + "/README.md", content);

		var content = FILE.read(tplPath + "/license.tpl.md");
		FILE.write(targetBasePath + "/LICENSE.md", content);

		FILE.write(buildPath + "/info.json", JSON.encode({
			version: version
		}));

		next2();
	}

	function next2()
	{
		SYSTEM.exec("cd " + buildPath + " ; zip -vr FirePHPCore-" + version + ".zip FirePHPCore-" + version, function(stdout)
		{
			console.log(stdout);

			callback();
		});
	}
}

function buildPEARArchive(callback)
{
	var targetBasePath = buildPath + "/pear";

	FILE.mkdirs(targetBasePath, 0775);

	SYSTEM.exec("cp -Rf " + pkgPath + "/lib/FirePHPCore/* " + targetBasePath, function()
	{
		next1();
	});		

	function next1()
	{
		var content = FILE.read(tplPath + "/pear.package.tpl.xml");

		var date = new Date();
		content = content.replace(/%%DATE%%/g, date.getFullYear() + "-" + UTIL.padBegin(date.getMonth()+1, 2, "0") + "-" + date.getDate());
		content = content.replace(/%%VERSION%%/g, version);
		content = content.replace(/%%STABILITY%%/g, "stable");

		FILE.write(targetBasePath + "/package.xml", content);
		
		next2();
	}

	function next2()
	{
		SYSTEM.exec("pear channel-discover pear.firephp.org", function(stdout)
		{
			console.log(stdout);

			SYSTEM.exec("cd " + targetBasePath + "; pear package package.xml", function(stdout)
			{
				console.log(stdout);

				callback();
			});
		});		
	}
}
