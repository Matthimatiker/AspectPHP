<?php

/**
 * AspectPHP_Transformation_Replace
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @copyright 2012 Matthias Molitor
 * @version $Rev$
 * @since 17.01.2012
 */

/**
 * Transformation class that replaces specific tokens by provided values.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @copyright 2012 Matthias Molitor
 * @version $Rev$
 * @since 17.01.2012
 */
class AspectPHP_Transformation_Replace
{
    
    /**
     * The replacement rules.
     *
     * Assigns replacement values to token types.
     *
     * @var array(integer=>string)
     */
    protected $rules = array();
    
    /**
     * Specifies the replacement rules.
     *
     * The given map contains the replacement rules.
     * The token type (for example T_WHITESPACE) is used as key,
     * the replacement as value.
     *
     * Example:
     * <code>
     * $transformation->setRules(array(T_WHITESPACE => ''));
     * </code>
     *
     * @param array(integer=>string) $map
     */
    public function setRules(array $map)
    {
        $this->rules = $map;
    }
    
    /**
     * Transforms the provided source code.
     *
     * @param string $source
     * @return string
     */
    public function transform($source)
    {
        $tokens    = token_get_all($source);
        $newSource = '';
        foreach ($tokens as $token) {
            /* @var $token string|array(integer|string) */
            if (is_string($token)) {
                $newSource .= $token;
                continue;
            }
            if (isset($this->rules[$token[0]])) {
                // Replace the token.
                $newSource .= $this->rules[$token[0]];
                continue;
            }
            $newSource .= $token[1];
        }
        return $newSource;
    }
    
}