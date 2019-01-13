<?php
/**
 * Wiki-Style Script - auxiliary plugin
 * Add <span class="wss-nowiki-section"> to avoid handling nowiki components by the script
 * Almost copied from DokuWiki units' function
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     HokkaidoPerson <dosankomali@yahoo.co.jp>
 */

 // must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class syntax_plugin_wikiformatstyling_nwtag extends DokuWiki_Syntax_Plugin {

    function getType(){
        return 'substition';
    }

    function getSort(){
        return 169;    // before Doku_Parser_Mode_unformatted
    }

    /**
     * Connect lookup pattern to lexer
     */
    function connectTo($mode) {
        $this->Lexer->addEntryPattern('<nowiki>(?=.*</nowiki>)',$mode,'plugin_wikiformatstyling_nwtag');
    }

    function postConnect() {
        $this->Lexer->addExitPattern('</nowiki>','plugin_wikiformatstyling_nwtag');
    }

    /**
     * Handle the match
     */
    function handle($match, $state, $pos, Doku_Handler $handler) {
        if ( $state == DOKU_LEXER_UNMATCHED ) {
            return array($match, $state);
        }
    }

    /**
     * Create output
     */
    function render($format, Doku_Renderer $renderer, $data) {
        if ( $data[1] == DOKU_LEXER_UNMATCHED ) {
            $renderer->doc .= '<span class="wss-nowiki-section">' . hsc($data[0]) . '</span>';
        }

    }
}
