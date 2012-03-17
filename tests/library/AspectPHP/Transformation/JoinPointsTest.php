<?php

/**
 * AspectPHP_Transformation_JoinPointsTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 05.01.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the transformation class that adds injection points.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 05.01.2012
 */
class AspectPHP_Transformation_JoinPointsTest extends PHPUnit_Framework_TestCase {
    
    /**
     * The name of the transformed class.
     *
     * @var string
     */
    const TRANSFORMED_CLASS = 'JoinPointsCheck_Transformation';
    
    /**
     * System under test.
     *
     * @var AspectPHP_Transformation_JoinPoints
     */
    protected $transformation = null;
    
    /**
     * The original code.
     *
     * @var string
     */
    protected $original = null;
    
    /**
     * The transformed code.
     *
     * @var string
     */
    protected $transformed = null;
    
    /**
     * An instance of the transformed class.
     *
     * @var JoinPointsCheck_Transformation
     */
    protected $transformedInstance = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->transformation = new AspectPHP_Transformation_JoinPoints();
        $this->original       = $this->getContent('Transformation.php');
        $this->transformed    = $this->transformation->transform($this->original);
        if( !class_exists(self::TRANSFORMED_CLASS, false) ) {
            // We execute the transformed code to be able to use the reflection api for testing.
            // We assume that the same input is always transformed into the same output.
            // Otherwise our tests might be incorrect, because the execution is done only
            // once per process.
            $this->execute($this->transformed);
        }
        $this->assertClassExists(self::TRANSFORMED_CLASS);
        if( !class_exists($this->getOriginalClassName(), false) ) {
            // Rename the original class and execute the code to be able to use the reflection api.
            $code = str_replace(self::TRANSFORMED_CLASS, $this->getOriginalClassName(), $this->original);
            $this->execute($code);
        }
        $this->assertClassExists($this->getOriginalClassName());
        $this->transformedInstance = new JoinPointsCheck_Transformation();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->transformedInstance = null;
        $this->transformed         = null;
        $this->original            = null;
        $this->transformation      = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that transform() returns a string.
     */
    public function testTransformReturnsString()
    {
        $this->assertInternalType('string', $this->transformation->transform($this->original));
    }
    
    /**
     * Checks if the same input always leads to the same output.
     */
    public function testTransformIsDeterministic()
    {
        $first  = $this->transformation->transform($this->original);
        $second = $this->transformation->transform($this->original);
        $this->assertEquals($first, $second);
    }
    
    /**
     * Tests if code is added by the transformation.
     */
    public function testTransformationAddsCode()
    {
        $message = 'Code size did not increase as expected.';
        $this->assertGreaterThan(strlen($this->original), strlen($this->transformed), $message);
    }
    
    /**
     * Ensures that the transformation does not change the method context ($this).
     */
    public function testTransformationDoesNotChangeContext()
    {
        $this->assertSame($this->transformedInstance, $this->transformedInstance->getContext());
    }
    
    /**
     * Ensures that the transformed code does not suppress notices.
     */
    public function testTransformedCodeDoesNotSuppressNotices()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Notice');
        $this->transformedInstance->triggerNotice();
        
    }
    
    /**
     * Ensures that the transformed code does not suppress exceptions.
     */
    public function testTransformedCodeDoesNotSuppressExceptions()
    {
        $this->setExpectedException('RuntimeException');
        $this->transformedInstance->throwException();
    }
    
    /**
     * Ensures that the transformation does not change the line numbers of
     * the original code.
     */
    public function testTransformationDoesNotChangeLineNumbers()
    {
        $this->assertEquals(35, $this->transformedInstance->getLineNumber());
    }
    
    /**
     * Ensures that the transformation does not change the visibility of public methods.
     */
    public function testTransformationDoesNotChangeVisibilityOfPublicMethods()
    {
        $method = $this->getMethodInfo('myPublicMethod');
        $this->assertTrue($method->isPublic());
    }
    
    /**
     * Ensures that the transformation does not change the visibility of protected methods.
     */
    public function testTransformationDoesNotChangeVisibilityOfProtectedMethods()
    {
        $method = $this->getMethodInfo('myProtectedMethod');
        $this->assertTrue($method->isProtected());
    }
    
    /**
     * Ensures that the transformation does not change the visibility of private methods.
     */
    public function testTransformationDoesNotChangeVisibilityOfPrivateMethods()
    {
        $method = $this->getMethodInfo('myPrivateMethod');
        $this->assertTrue($method->isPrivate());
    }
    
    /**
     * Ensures that the transformation does not remove the static attribute from methods.
     */
    public function testTransformationDoesNotRemoveStaticAttributeFromMethod()
    {
        $method = $this->getMethodInfo('myStaticMethod');
        $this->assertTrue($method->isStatic());
    }
    
    /**
     * Ensures that the transformation does not remove the final attribute from methods.
     */
    public function testTransformationDoesNotRemoveFinalAttributeFromMethod()
    {
        $method = $this->getMethodInfo('myFinalMethod');
        $this->assertTrue($method->isFinal());
    }
    
    /**
     * Ensures that the transformation does not remove the final attribute
     * from the class.
     */
    public function testTransformationDoesNotRemoveFinalAttributeFromClass()
    {
        $class = $this->getClassInfo();
        $this->assertTrue($class->isFinal());
    }
    
    /**
     * Ensures that the transformation does not add public methods to the class.
     *
     * Public methods might be exposed when reflection is used (for example to find
     * methods that arre available via webservice).
     */
    public function testTransformationDoesNotAddPublicMethods()
    {
        $original   = $this->getOriginalClassInfo()->getMethods(ReflectionMethod::IS_PUBLIC);
        $transfomed = $this->getClassInfo()->getMethods(ReflectionMethod::IS_PUBLIC);
        $message = 'Number of public methods in original and transformed class differs.';
        $this->assertEquals(count($original), count($transfomed), $message);
    }
    
    /**
     * Ensures that the transformation does not add protected methods to the class.
     *
     * Additional protected methods might caus conflicts in sub classes.
     */
    public function testTransformationDoesNotAddProtectedMethods()
    {
        $original   = $this->getOriginalClassInfo()->getMethods(ReflectionMethod::IS_PROTECTED);
        $transfomed = $this->getClassInfo()->getMethods(ReflectionMethod::IS_PROTECTED);
        $message = 'Number of protected methods in original and transformed class differs.';
        $this->assertEquals(count($original), count($transfomed), $message);
    }
    
    /**
     * Ensures that the transformation does not change the doc blocks of the methods.
     *
     * The doc blocks might be used by scripts that rely on reflection and therefore
     * should not be changed.
     */
    public function testTransformationDoesNotChangeMethodDocBlocks()
    {
        $original    = $this->getOriginalMethodInfo('myDocBlockMethod');
        $transformed = $this->getMethodInfo('myDocBlockMethod');
        $this->assertEquals($original->getDocComment(), $transformed->getDocComment());
    }
    
    /**
     * Ensures that code that does not belong to a class is not changed during transformation.
     */
    public function testTransformationDoesNotChangeCodeThatDoesNotBelongToClass()
    {
        $code = $this->getContent('NoClass.php');
        $this->assertEquals($code, $this->transformation->transform($code));
    }
    
    /**
     * Checks if methods receive the parameters that were declared in the signature.
     */
    public function testMethodsReceiveCorrectDeclaredParameters()
    {
        $received = $this->transformedInstance->parameters(42, 7);
        $this->assertEquals(array(42, 7), $received);
    }
    
    /**
     * Checks if methods receive variable parameters (that cannot be declared in the signature).
     */
    public function testMethodsReceiveCorrectVariableParameters()
    {
        $received = $this->transformedInstance->variableParameters(3, 2, 1);
        $this->assertEquals(array(3, 2, 1), $received);
    }
    
    /**
     * Checks if the __CLASS__ constant has the correct value.
     */
    public function testClassConstantHasCorrectValue()
    {
        $this->assertEquals(self::TRANSFORMED_CLASS, $this->transformedInstance->getClass());
    }
    
    /**
     * Checks if the __METHOD__ constant has the correct value.
     */
    public function testMethodConstantHasCorrectValue()
    {
        $this->assertEquals(self::TRANSFORMED_CLASS . '::getMethod', $this->transformedInstance->getMethod());
    }
    
    /**
     * Checks if the __FUNCTION__ constant has the correct value.
     */
    public function testFunctionConstantHasCorrectValue()
    {
        $this->assertEquals('getFunction', $this->transformedInstance->getFunction());
    }
    
    /**
     * Ensures that the transformation works with methods whose visibility was not
     * declared explicitly.
     *
     * For example:
     * <code>
     * class Demo {
     *     function myMethod() {
     *     }
     * }
     * </code>
     */
    public function testTransformationWorksWithMethodsWhoseVisibilityIsNotDeclaredExplicitly()
    {
        $this->setExpectedException(null);
        $source      = $this->getContent('NoVisibility.php');
        $transformed = $this->transformation->transform($source);
        $this->execute($transformed);
    }
    
    /**
     * Ensures that the transformation works even if the provided code does
     * not have any comment.
     */
    public function testTransformationWorksEvenIfCodeDoesNotHaveAnyComment()
    {
        $this->setExpectedException(null);
        $source      = $this->getContent('NoDocComment.php');
        $transformed = $this->transformation->transform($source);
        $this->execute($transformed);
        $reflection = new ReflectionMethod('JoinPointsCheck_NoDocComment', 'undocumentedMethod');
        $this->assertFalse($reflection->getDocComment());
    }
    
    /**
     * Ensures that the transformation does not change interface declarations.
     */
    public function testTransformationDoesNotChangeInterfaces()
    {
        $this->setExpectedException(null);
        $source      = $this->getContent('WithInterfaces.php');
        $transformed = $this->transformation->transform($source);
        $this->execute($transformed);
        $reflection = new ReflectionClass('JoinPointsCheck_WithInterfaces');
        $this->assertContains('Countable', $reflection->getInterfaceNames());
    }
    
    /**
     * Checks if the transformation can handle abstract methods.
     */
    public function testTransformationHandlesAbstractMethods()
    {
        $this->setExpectedException(null);
        $source      = $this->getContent('AbstractMethod.php');
        $transformed = $this->transformation->transform($source);
        $this->execute($transformed);
    }
    
    /**
     * Ensures that the transformation is able to handle methods that do not
     * contain a doc comment and whose visibility is not explicitly defined.
     */
    public function testTransformationHandlesMethodsWithoutCommentAndVisibility()
    {
        $this->setExpectedException(null);
        $source      = $this->getContent('NoDocCommentAndNoVisibility.php');
        $transformed = $this->transformation->transform($source);
        $this->execute($transformed);
    }
    
    /**
     * Checks if static methods are callable after transformation.
     */
    public function testStaticMethodIsCallable()
    {
        $this->assertEquals('static', JoinPointsCheck_Transformation::myStaticMethod());
    }
    
    /**
     * Ensures that methods receive the correct default parameters.
     */
    public function testMethodsReceiveDefaultParameters()
    {
        $this->assertEquals('Demo', $this->transformedInstance->defaultParameter());
    }
    
    // TODO:
    // handles multiple classes in one code block
    // advice invocation
    
    /**
     * Asserts that the class is loaded.
     *
     * @param string $class
     */
    protected function assertClassExists($class)
    {
        $message = 'Class "' . $class . '" is not available.';
        $this->assertTrue(class_exists($class, false), $message);
    }
    
    /**
     * Returns a reflection object that may be used to inspect the transformed class.
     *
     * @return ReflectionClass
     */
    protected function getClassInfo()
    {
        return new ReflectionClass(self::TRANSFORMED_CLASS);
    }
    
    /**
     * Returns a reflection object that may be used to inspect the
     * method $name in the transformed class.
     *
     * @param string $name
     * @return ReflectionMethod
     */
    protected function getMethodInfo($name)
    {
        return $this->getClassInfo()->getMethod($name);
    }
    
    /**
     * Returns a reflection object that may be used to inspect the original class.
     *
     * @return ReflectionClass
     */
    protected function getOriginalClassInfo()
    {
        return new ReflectionClass($this->getOriginalClassName());
    }
    
    /**
     * Returns a reflection object that may be used to inspect the
     * method $name in the original class.
     *
     * @param string $name
     * @return ReflectionMethod
     */
    protected function getOriginalMethodInfo($name)
    {
        return $this->getOriginalClassInfo()->getMethod($name);
    }
    
    /**
     * Returns the name that is used for the original class.
     *
     * @return string
     */
    protected function getOriginalClassName()
    {
        return self::TRANSFORMED_CLASS . '_Original';
    }
    
    /**
     * Executes the given source code.
     *
     * @param string $code
     * @return false
     */
    protected function execute($code)
    {
        // Remove opening tag as eval does not accept it.
        if( strpos($code, '<?php') === 0 ) {
            $code = substr($code, strlen('<?php'));
        }
        $result = eval($code);
        $this->assertTrue($result !== false);
    }
    
    /**
     * Returns the content of the test data file $file in TestData/JoinPointsCheck.
     *
     * Example:
     * <code>
     * $content = $this->getContent('Transformation.php');
     * </code>
     *
     * @param string $file The file name.
     * @return string
     */
    protected function getContent($file)
    {
        return file_get_contents(dirname(__FILE__) . '/TestData/JoinPointsCheck/' . $file);
    }
    
}