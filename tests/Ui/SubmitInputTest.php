<?php
use PHPUnit\Framework\TestCase;
use Shoal\Ui\SubmitInput;

class SubmitInputTest extends TestCase {

    private $element = null;

    public function setUp () {
        $this->element = new SubmitInput();
    }

    use \TestUtils\Ui\CommonAttributesTestTrait;

    public function testToString () {
        $submitInput = $this->element;
        $submitInput = \TestUtils\Ui\Utilities::setCommonAttributes($submitInput);
        $this->assertEquals(
            '<input type="submit" name="testElements[]" id="uniqueValue1" class="freshStyle" style="color: #c3c3c3; background-color: #030303;border: 1px solid pink;" />',
            (string) $submitInput
        );

        $value = 'Hello world!';
        $submitInput->value($value);
        $this->assertEquals($value, $submitInput->value());

        $this->assertEquals(
            '<input type="submit" value="Hello world!" name="testElements[]" id="uniqueValue1" class="freshStyle" style="color: #c3c3c3; background-color: #030303;border: 1px solid pink;" />', 
            (string) $submitInput
        );

    }
}
