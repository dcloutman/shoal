<?php
use PHPUnit\Framework\TestCase;
use Shoal\Ui\TextInput;

class TextInputTest extends TestCase {

    private $element = null;

    public function setUp () {
        $this->element = new TextInput();
    }

    use \TestUtils\Ui\CommonAttributesTestTrait;

    public function testToString () {
        $textInput = $this->element;
        $textInput = \TestUtils\Ui\Utilities::setCommonAttributes($textInput);
        $this->assertEquals(
            '<input type="text" name="testElements[]" id="uniqueValue1" class="freshStyle" style="color: #c3c3c3; background-color: #030303;border: 1px solid pink;" />', 
            (string) $textInput
        );

        $placeholderText = 'Type text here.';
        $textInput->placeholder($placeholderText);
        $this->assertEquals($placeholderText, $textInput->placeholder());

        // 
        $value = 'Hello world!';
        $textInput->value($value);
        $this->assertEquals($value, $textInput->value());

        $this->assertEquals(
            '<input type="text" value="Hello world!" name="testElements[]" id="uniqueValue1" class="freshStyle" style="color: #c3c3c3; background-color: #030303;border: 1px solid pink;" placeholder="Type text here." />', 
            (string) $textInput
        );

    }
}
