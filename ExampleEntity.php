<?php

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *  @author Jan Mikes <j.mikes@me.com>
 *  @copyright Jan Mikes - janmikes.cz
 */
class EventVariant extends BaseEntity
{
	/**
	 * @ORM\Column(nullable=true)
	 * @App\Annotations\Image
	 */
	protected $image;
}
