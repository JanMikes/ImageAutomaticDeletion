<?php

namespace App\Annotations;

/**
 * @Annotation
 * @Target({"PROPERTY"})
 */
final class Image
{
	/**
	 * @var boolean
	 */
	public $autodelete = true;
}
