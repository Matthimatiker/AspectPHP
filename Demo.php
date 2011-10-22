<?php

class Demo {
    
    /**
     * Test.
     *
     * @param string $greeting
     */
    public function test($greeting) {
        
    }
    
    protected function huhu() {
        
    }
    
}

$source = file_get_contents(__FILE__);
$tokens = token_get_all($source);
$numberOfTokens = count($tokens);
for( $i = 0; $i < $numberOfTokens; $i++ ) {
    if (is_array($tokens[$i])) {
        $tokens[$i][0] = token_name($tokens[$i][0]);
    }
}

var_dump($tokens);

?>