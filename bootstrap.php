<?php

use App\Listeners\{GenerateSitemap, RedirectsFile, GenerateSearchCaches};
use App\{CustomMdParser, CustomMdHandler};
use Mni\FrontYAML\Markdown\MarkdownParser;
use TightenCo\Jigsaw\Handlers\MarkdownHandler;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */


/*
 * Replace the jigsaw's deafult markdown parser with our custom parser
 * which uses the php port of makdown-it (the library used by hackmd.io)
 * to parse markdown and does some extra processing as well.
 * 
 */
$container->bind(MarkdownParser::class, CustomMdParser::class);


/*
 * Replace the jigsaw's handler of markdown files with our custom handler
 * to do the further content processing which depends on metadata.
 * 
 * For now that is just generating Table of Contents (we do it only for
 * some of the collections, and slightly differently for each one, so it
 * is needed to check in metadata which collection the page we are
 * processing belongs to).
 * 
 */
$container->bind(MarkdownHandler::class, CustomMdHandler::class);


/*
 * Generate sitemap.xml for search engines
 */
$events->afterBuild(GenerateSitemap::class);

/*
 * Copy redirects info from the file with human readable name
 * to the file readable by netlify
 */
$events->afterBuild(RedirectsFile::class);


/*
 * Generate JSON caches used by search input
 */
$events->afterBuild(GenerateSearchCaches::class);