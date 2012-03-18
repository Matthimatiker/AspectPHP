<?php

/**
 * AspectPHP_Code_TokenAnalyzer
 *
 * @package AspectPHP_Code
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @version $Rev$
 * @since 27.01.2012
 */

/**
 * Analyzes tokenized source code.
 *
 * The analyzer provides methods that simplify searching for specific tokens
 * in the provided token list.
 *
 * @package AspectPHP_Code
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @version $Rev$
 * @since 27.01.2012
 */
class AspectPHP_Code_TokenAnalyzer implements ArrayAccess, Countable, IteratorAggregate
{
    
    /**
     * Contains opening braces as key and corresponding
     * closing braces as value.
     *
     * @var array(string=>string)
     */
    protected static $braces = array(
        '{' => '}',
        '(' => ')'
    );
    
    /**
     * The tokens that are analyzed.
     *
     * @var array(array(integer|string)|string)
     */
    protected $tokens = null;
    
    /**
     * Creates an analyzer.
     *
     * Create an analyzer from token list:
     * <code>
     * $code     = '<?php ?>';
     * $tokens   = token_get_all($code);
     * $analyzer = new AspectPHP_Code_TokenAnalyzer($tokens);
     * </code>
     *
     * Create an analyzer from source code:
     * <code>
     * $code     = '<?php ?>';
     * $analyzer = new AspectPHP_Code_TokenAnalyzer($code);
     * </code>
     *
     * @param array(array|string)|string $tokensOrSource The tokenized source code or the source code itself.
     * @throws InvalidArgumentException If an empty token list is provided.
     */
    public function __construct($tokensOrSource)
    {
        $tokens = array();
        if (is_string($tokensOrSource)) {
            // Source code provided.
            $tokens = token_get_all($tokensOrSource);
        } elseif (is_array($tokensOrSource)) {
            // Token array provided.
            $tokens = $tokensOrSource;
        }
        if (count($tokens) === 0) {
            $message = 'Expected non-empty token list or source code.';
            throw new InvalidArgumentException($message);
        }
        $this->tokens = $tokens;
    }
    
    /**
     * Searches for the first token after $index that meets the given requirements.
     *
     * See {@link findBetween()} for details about the search options.
     *
     * @param integer|string|array(integer|string) $typeOrTypes
     * @param integer $index
     * @param array(integer|string) $stopAt
     * @return integer
     */
    public function findNext($typeOrTypes, $index, array $stopAt = array())
    {
        $this->assertIsIndex($index);
        if ($index === count($this) - 1) {
            return -1;
        }
        return $this->findBetween($typeOrTypes, $index + 1, count($this) - 1, $stopAt);
    }
    
    /**
     * Searches for the first token before $index that meets the given requirements.
     *
     * See {@link findBetween()} for details about the search options.
     *
     * @param integer|string|array(integer|string) $typeOrTypes
     * @param integer $index
     * @param array(integer|string) $stopAt
     * @return integer
     */
    public function findPrevious($typeOrTypes, $index, array $stopAt = array())
    {
        $this->assertIsIndex($index);
        if ($index === 0) {
            return -1;
        }
        return $this->findBetween($typeOrTypes, $index - 1, 0, $stopAt);
    }
    
    /**
     * Searches between $start and $end (inclusively) for the given token type.
     *
     * The method returns -1 if the token was not found and the index
     * of the result token otherwise.
     *
     * The given type can be a type constant (for example T_FUNCTION) or a
     * token string (for example "{" or ";").
     *
     * If $start is greater than $end the search will be executed in descending
     * order. Otherwise ascending order will be used.
     *
     * Optionally an array of stop types may be specified via $stopAt.
     * If one of these types is found during the search then -1 will be returned.
     *
     * Example:
     * <code>
     * // Search the first 50 tokens for a "function" token. Stop if
     * // a class declaration ("class") is encountered.
     * $index = $analyzer->findBetween(T_FUNCTION, 0, 49, array(T_CLASS));
     * if ($index !== -1) {
     *     $token = $analyzer[$index];
     * }
     * </code>
     *
     * Also a list of search token types can be provided. The analyzer will
     * return the index of the first token that matches any of the types:
     * <code>
     * // Searches for the index of the first T_FUNCTION or T_CLASS token.
     * $index = $analyzer->findBetween(array(T_FUNCTION, T_CLASS), 0, 49);
     * </code>
     *
     * @param integer|string|array(integer|string) $typeOrTypes The search token or tokens.
     * @param integer $start The start index.
     * @param integer $end The end index.
     * @param array(integer|string) $stopAt List of tokens that will stop the search process.
     * @return integer The index of the result token or -1 if none was found.
     * @throws InvalidArgumentException If invalid $start or $end indexes are used.
     */
    public function findBetween($typeOrTypes, $start, $end, array $stopAt = array())
    {
        $types = is_array($typeOrTypes) ? $typeOrTypes : array($typeOrTypes);
        $this->assertIsIndex($start);
        $this->assertIsIndex($end);
        
        $step = 1;
        if ($start > $end) {
            // Search in descending order.
            $step = -1;
        }
        
        $lastIndex = $end + $step;
        for ($index = $start; $index !== $lastIndex; $index += $step) {
            if ($this->isOneTypeOf($index, $types)) {
                return $index;
            }
            if ($this->isOneTypeOf($index, $stopAt)) {
                // Stop token encountered.
                return -1;
            }
        }
        
        // No token found within range.
        return -1;
    }
    
    /**
     * Returns the indexes of all matching tokens between $start and $end.
     *
     * Example:
     * <code>
     * // Returns the indexes of all "function" and "class" tokens
     * // in the analyzed source code.
     * $types = array(T_FUNCTION, T_CLASS);
     * $tokens = $analyzer->findAllBetween($types, 0, count($analyzer) - 1);
     * </code>
     *
     * @param integer|string|array(integer|string) $typeOrTypes The search token or tokens.
     * @param integer $start The start index.
     * @param integer $end The end index.
     * @param array(integer|string) $stopAt List of tokens that will stop the search process.
     * @return array(integer) The indexes of the result tokens.
     * @throws InvalidArgumentException If invalid $start or $end indexes are used.
     */
    public function findAllBetween($typeOrTypes, $start, $end, array $stopAt = array())
    {
        $matches   = array();
        $direction = ($start < $end) ? 1 : -1;
        $current   = $start;
        $minIndex  = min($start, $end);
        $maxIndex  = max($start, $end);
        while (($index = $this->findBetween($typeOrTypes, $current, $end, $stopAt)) !== -1) {
            $matches[] = $index;
            $current   = $index + $direction;
            if ($current < $minIndex || $current > $maxIndex) {
                // The calculated index is out of bounds, therefore stop search process.
                break;
            }
        }
        return $matches;
    }
    
    /**
     * Searches for the opening/closing brace that belongs to the brace at $index.
     *
     * @param integer $index Index of the brace token.
     * @return integer Index of the matching brace.
     * @throws InvalidArgumentException If the provided index does not belong to a brace token.
     * @throws RuntimeException If no matching brace was found. It is assumed that the tokenized code is not valid.
     */
    public function findMatchingBrace($index)
    {
        $this->assertIsIndex($index);
        if (!$this->isBrace($index)) {
            $message = 'Token at position ' . $index . ' does not contain a brace.';
            throw new InvalidArgumentException($message);
        }
        $brace              = $this->tokens[$index];
        $correspondingBrace = $this->getCorrespondingBrace($brace);
        if (isset(self::$braces[$brace])) {
            // Token contains an opening brace.
            $stopIndex = count($this);
            $step      = 1;
        } else {
            // Token contains a closing brace.
            $stopIndex = -1;
            $step      = -1;
        }
        $braceCount = 1;
        for ($i = $index + $step; $i !== $stopIndex; $i += $step) {
            if ($this->isOfType($i, $brace)) {
                $braceCount++;
            } elseif ($this->isOfType($i, $correspondingBrace)) {
                $braceCount--;
                if ($braceCount === 0) {
                    return $i;
                }
            }
        }
        $template = 'No matching brace found for "%s" at %s. Is the tokenized source code valid?';
        $message  = sprintf($template, $brace, $index);
        throw new RuntimeException($message);
    }
    
    /**
     * Checks if the token with the given offset exists.
     *
     * @param integer $offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return $this->isIndex($offset);
    }
    
    /**
     * Returns the token with the given offset.
     *
     * @param integer $offset
     * @return array(mixed)|string
     * @throws InvalidArgumentException If the token with the provided offset does not exist.
     */
    public function offsetGet($offset)
    {
        $this->assertIsIndex($offset);
        return $this->tokens[$offset];
    }
    
    /**
     * Modifying tokens is not supported, therefore a BadMethodCallException is thrown.
     *
     * @param integer $offset
     * @param array(mixed)|string $value
     * @throws BadMethodCallException Always throws an exception.
     */
    public function offsetSet($offset, $value)
    {
        throw new BadMethodCallException('Modifying tokens is not supported.');
    }
    
    /**
     * Deleting tokens is not supported, therefore a BadMethodCallException is thrown.
     *
     * @param integer $offset
     * @throws BadMethodCallException Always throws an exception.
     */
    public function offsetUnset($offset)
    {
        throw new BadMethodCallException('Deleting tokens is not supported.');
    }
    
    /**
     * Returns the number of tokens.
     *
     * @return integer
     */
    public function count()
    {
        return count($this->tokens);
    }
    
    /**
     * Returns an iterator that is used to loop over the tokens.
     *
     * @return Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->tokens);
    }
    
    /**
     * Returns the source code that is analyzed.
     *
     * @return string
     */
    public function __toString()
    {
        $sourceCode     = '';
        $numberOfTokens = count($this);
        for ($i = 0; $i < $numberOfTokens; $i++) {
            if (is_string($this->tokens[$i])) {
                $sourceCode .= $this->tokens[$i];
            } else {
                $sourceCode .= $this->tokens[$i][1];
            }
        }
        return $sourceCode;
    }
    
    /**
     * Checks if the token at position $index is a brace.
     *
     * @param integer $index
     * @return boolean True if the token is a brace, false otherwise.
     */
    protected function isBrace($index)
    {
        return $this->isOpeningBrace($index) || $this->isClosingBrace($index);
    }
    
    /**
     * Checks if the token at position $index is an opening brace.
     *
     * @param integer $index
     * @return boolean True if the token is an opening brace, false otherwise.
     */
    protected function isOpeningBrace($index)
    {
        return $this->isOneTypeOf($index, array_keys(self::$braces));
    }
    
    /**
     * Checks if the token at position $index is a closing brace.
     *
     * @param integer $index
     * @return boolean True if the token is a closing brace, false otherwise.
     */
    protected function isClosingBrace($index)
    {
        return $this->isOneTypeOf($index, self::$braces);
    }
    
    /**
     * Returns the opening/closing brace that belongs to the given brace.
     *
     * Example:
     * <code>
     * // Returns "}":
     * $this->getCorrespondingBrace('{');
     * // Returns "(":
     * $this->getCorrespondingBrace(')');
     * </code>
     *
     * @param string $brace
     * @return string
     */
    protected function getCorrespondingBrace($brace)
    {
        if (isset(self::$braces[$brace])) {
            // Opening brace provided.
            return self::$braces[$brace];
        }
        // Return the corresponding opening brace.
        $braces = array_flip(self::$braces);
        return $braces[$brace];
    }
    
    /**
     * Checks if the type of the token at position $index equals one
     * of the types that were specified in $types.
     *
     * @param integer $index
     * @param array(integer|string) $types
     * @return boolean True if the token types matches one of the specified types, false otherwise.
     */
    protected function isOneTypeOf($index, array $types)
    {
        foreach ($types as $type) {
            /* @var $type integer|string */
            if ($this->isOfType($index, $type)) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Checks if the token at position $index is of type $type.
     *
     * @param integer $index
     * @param integer|string $type
     * @return boolean True if the token is of the specified type, false otherwise.
     */
    protected function isOfType($index, $type)
    {
        if (is_int($type)) {
            // T_* constant provided as type.
            if (!is_array($this->tokens[$index])) {
                return false;
            }
            return $type === $this->tokens[$index][0];
        }
        // Character provided as type.
        return $type === $this->tokens[$index];
    }
    
    /**
     * Asserts that $index is a valid token index.
     *
     * Throws an exception if an invalid index is provided.
     *
     * @param integer $index
     * @throws InvalidArgumentException If an invalid index is passed.
     */
    protected function assertIsIndex($index)
    {
        if (!$this->isIndex($index)) {
            $template = '"%s" is not a valid token position. Expected value between %s and %s.';
            $message  = sprintf($template, $index, 0, count($this) - 1);
            throw new InvalidArgumentException($message);
        }
    }
    
    /**
     * Checks if the provided integer is a valid token index.
     *
     * @param integer|mixed $index
     * @return boolean True if $index is a valid token index, false otherwise.
     */
    protected function isIndex($index)
    {
        return is_int($index) && isset($this->tokens[$index]);
    }
    
}