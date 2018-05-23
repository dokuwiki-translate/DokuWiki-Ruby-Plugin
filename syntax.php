<?php
 
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

class syntax_plugin_ruby extends DokuWiki_Syntax_Plugin {

    function getType(){
        return 'substition';
    }

    function getSort(){
        return 150;
    }

    function connectTo($mode) {
      $this->Lexer->addSpecialPattern('\{\{ruby\|[^}]*\}\}',$mode,'plugin_ruby');
    }

    function handle($match, $state, $pos, Doku_Handler $handler) {
        return explode('|', substr($match, strlen('{{ruby|'), -2));
    }

    function render($format, Doku_Renderer $renderer, $data) {
        $renderer->doc .= '<ruby><rb>' .htmlspecialchars($data[0]) . '</rb><rp>' . $this->getConf('parenthesis') . '</rp><rt>' .htmlspecialchars($data[1]) . '</rt><rp>' . $this->getConf('parenthesisClosing') . '</rp></ruby>';
    }
}
