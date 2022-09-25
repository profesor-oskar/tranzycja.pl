<?php

namespace App\Markdown;

use Kaoken\MarkdownIt\MarkdownIt;

class Spoiler extends Alert
{
    public function plugin(MarkdownIt $md, string $name, $options = null)
    {
        parent::plugin($md, $name, $options);
        $this->md = $md;
    }

    function validateDefault($params/*, markup*/) {
        return explode(' ', trim($params), 2)[0] === $this->name;
    }

    function renderDefault(array &$tokens, int $idx, object $options, ?object $env, $slf): string
    {

        // wrap with details element
        if ($tokens[$idx]->nesting === 1) {
            $title = explode(' ', trim($tokens[$idx]->info), 2)[1] ?? null;

            if ($title) {
                $text = $this->md->renderInline($title);
                $slug = uniqueSlug(html_entity_decode(strip_tags($text)), $env->anchors);
                $html = "<details id=\"$slug\"><summary>$text</summary>";
            } else {
                $html = '<details>';
            }

            return $html . $slf->renderToken($tokens, $idx, $options, $env, $slf);
        }
        if ($tokens[$idx]->nesting === -1) {
            return $slf->renderToken($tokens, $idx, $options, $env, $slf) . '</details>';
        }

        return $slf->renderToken($tokens, $idx, $options, $env, $slf);
    }

}