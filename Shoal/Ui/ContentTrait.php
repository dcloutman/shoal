<?php
namespace Shoal\Ui;

trait ContentTrait {
	protected $content = '';

	/** Combined getter / setter for $this->content
	 *  @param string content
	 *  @return mixed A string if a value for content is not passed, the current instance of the object if it is.
	 */
	public function content ( $content = null ) {
		if ( null !== $content ) {
			$this->content = $content;
			return $this;
		}
		return $this->content;
	}
}
