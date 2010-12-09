
var EVENTS = require('insight-plugin-api/events');
var CONSOLE = require('insight-plugin-api/console');
var PLUGIN = require('insight-plugin-api/plugin');
var DOMPLATE = require("domplate/domplate");
var JQUERY = require('jquery/jquery').jQuery;

exports.main = function() {

    PLUGIN.addCss("style.css");

    CONSOLE.log("Hello World from PageControls1: " + new Date());

    // "content" is the root HTML element (body) to put markup into
    var html = [];
    html.push("<img src=\"" + PLUGIN.getImageUrl("img/devcomp_16.png") + "\"/>");
    html.push("Hello World from PageControls1: " + new Date() + " ");
    html.push("<a href=\"#\" id=\"ping-insight-link\">Ping Insight</a> ");
    html.push("<a href=\"#\" id=\"ping-server-link\">Ping Server</a> ");
    html.push("<a href=\"#\" id=\"show-plugin-link\">Show PageControls2</a> ");
    html.push("<a href=\"#\" id=\"remove-all-link\">Remove All</a> ");
    html.push("<a href=\"#\" id=\"toggle-height-link\">Toggle Height</a> ");
    html.push("<div id=\"domplate-container\"></div>");
    document.getElementById("content").innerHTML =  html.join("\n");

    // attach listeners for the test links
    document.getElementById("ping-insight-link").addEventListener("click", function() {
        CONSOLE.log(["ping", {"hello": "world"}, {"me": "too"}]);
        EVENTS.dispatchHostEvent('ping', {"hello": "world"}, {"me": "too"});
    }, false);
    document.getElementById("ping-server-link").addEventListener("click", function() {
        CONSOLE.log(["send", "First Message"]);
        CONSOLE.log(["send", {
            "Second": "Message"
        }]);
        PLUGIN.sendSimpleMessage("First Message");
        PLUGIN.sendSimpleMessage({
            "Second": "Message"
        });
    }, false);
    document.getElementById("show-plugin-link").addEventListener("click", function() {
        PLUGIN.sendSimpleMessage({
            "action": "showPlugin",
            "name": "PageControls2"
        });
    }, false);
    document.getElementById("remove-all-link").addEventListener("click", function() {
        PLUGIN.sendSimpleMessage({
            "action": "removeAll"
        });
    }, false);
    document.getElementById("toggle-height-link").addEventListener("click", function() {
        PLUGIN.getHeight(function(height) {
            if(height==50) {
                PLUGIN.setHeight(100);
            } else {
                PLUGIN.setHeight(50);
            }
        });
    }, false);

    // listen for insight events
    EVENTS.addListener("pong", function(arg1, arg2) {
        CONSOLE.log(["pong", arg1, arg2]);
    });
    PLUGIN.addListener("message", function(message) {
        CONSOLE.log(["message", message]);
    });


    // domplate
    var rep;
    with(DOMPLATE.tags) {
        rep = DOMPLATE.domplate({
            tag:
                DIV(
                    A({
                        "href": "#",
                        "onclick": "$test"
                    }, "Domplate")
                ),
            test: function(event) {
                CONSOLE.log("Hello Domplate!");
            }
        });
    }

    rep.tag.replace({}, document.getElementById("domplate-container"));

}
