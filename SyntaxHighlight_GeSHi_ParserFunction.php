<?php
 
/**
 * This file contais the source code of SyntaxHighlight_Geshi_ParserFunction extension
 * of MediaWiki. This code is released under the GNU General Public License.
 *
 * This source is highly based on SyntaxHighlight_Geshi extension, which works great, but 
 * as it was implemented to use tags, it was not able to be used with Semantic MediaWiki
 * to output semantic properties as highlighted source code. That's why I created this 
 * extension as a parser function.
 *
 * Important: please note that this is a very simplifyed version of the original extension.
 * At the moment it is only possible to specify the programming language and the source code.
 * 
 * @author Matheus Garcia Barbosa de Figueiredo <matheus.figueiredo@almg.gov.br>
 * @copyright Copyright 2005, Edmund Mielach
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package MediaWikiExtensions
 * @version 0.1
 */
 
/**
 * Register the FileProtocolLinks extension with MediaWiki
 */ 
$wgExtensionFunctions[] = 'registerSourceHighlight';
$wgHooks['LanguageGetMagic'][]       = 'registerSourceHighlight_Magic';


$wgSyntaxHighlightDefaultLang = null; //Change this in LocalSettings.php
$dir = dirname(__FILE__) . '/';
$wgExtensionMessagesFiles['SyntaxHighlight_GeSHi'] = $dir . 'SyntaxHighlight_GeSHi.i18n.php';
$wgAutoloadClasses['SyntaxHighlight_GeSHi'] = $dir . 'SyntaxHighlight_GeSHi.class.php';
$wgHooks['ShowRawCssJs'][] = 'SyntaxHighlight_GeSHi::viewHook';
$wgHooks['SpecialVersionExtensionTypes'][] = 'SyntaxHighlight_GeSHi::hSpecialVersion_GeSHi';


function registerSourceHighlight()
{
    global $wgParser;

    $wgParser->setFunctionHook( 'source', 'parserHookMGBF' );
    $wgParser->setFunctionHook( 'syntaxhighlight', 'parserHookMGBF' );
    return true;
}
 
 
function registerSourceHighlight_Magic( &$magicWords, $langCode ) {
        $magicWords['source'] = array( 0, 'source' );
        $magicWords['syntaxhighlight'] = array( 0, 'syntaxhighlight' );
        return true;
}


function renderSourceHighlight(&$parser, $lang, $source)
{
   return $source;
}

#credits for [[Special:Version]]
$wgExtensionCredits['parserhook'][] = array(
        'name' => 'SourceHighlight_Geshi_ParserFunction',
        'author' => 'Matheus Garcia Barbosa de Figueiredo',
        'description' => 'Parser function extension to highlight source code',
        'url' => 'http://www.mediawiki.org/wiki/Extension:SourceHighlight_Geshi_ParserFunction');


function parserHookMGBF(  &$parser, $lang, $source) {
  $args=array();
  $args['lang']=$lang;
  return SyntaxHighlight_GeSHi::parserHook( $source, $args, $parser );
}

?>





