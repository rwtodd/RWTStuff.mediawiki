<?php
class RWTSTuffHooks {
   // Register any render callbacks with the parser
   public static function onParserFirstCallInit( Parser $parser ) {

      // Create a function hook associating the "nplink" magic word with renderExample()
      $parser->setFunctionHook( 'nplink', [ self::class, 'renderNPLink' ] );
   }

   // Render the output of {{#nplink:}}.
   public static function renderNPLink( Parser $parser, $param1 = '', $param2 = '', $param3 = '') {
	/* param1 is the page name, param2 and param3 can be one of:
	 * 'lc' to lowercase the output
	 * 'it' to italicise the output
	 */
	$lastParenIndex = strrpos($param1, '(');
	$preParen = $param1;
	if ($lastParenIndex !== false) {
           // Extract the content inside the last parentheses
           $preParen = trim(substr($param1, 0, $lastParenIndex));
	} 
	if (!strcasecmp($param2,'lc') || !strcasecmp($param3,'lc')) {
		$preParen = strtolower($preParen);
	}
	if (!strcasecmp($param2,'it') || !strcasecmp($param3,'it')) {
		$preParen = "''$preParen''";
	}
        // Create the wikitext link
        $wikiLink = "[[$param1|$preParen]]";
        return $wikiLink;
   }
}
