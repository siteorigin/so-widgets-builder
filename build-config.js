module.exports = {
    slug: 'so-widgets-builder',
    jsMinSuffix: '.min',
    version: {
        src: [
            'so-widgets-builder.php',
            'readme.txt'
        ]
    },
    copy: {
        src: [
            '**',                               // Everything
            '!{build,build/**}',                // Ignore build/ and contents
            '!{tests,tests/**}',                // Ignore tests/ and contents
            '!{tmp,tmp/**,dist,dist/**}',       // Ignore tmp/ and contents
            '!phpunit.xml',                     // Not the unit tests configuration file.
            '!so-widgets-builder.php',          // Not the base plugin file. It is copied by the 'version' task.
            '!readme.txt',                      // Not the readme.txt file. It is copied by the 'version' task.
            '!readme.md',                       // Ignore the readme.md file. It is for the github repo.
            '!build-config.js',                       // Ignore the readme.md file. It is for the github repo.
            '!.editorconfig',                   // Ignore .editorconfig file. Only for development.
        ]
    }
};