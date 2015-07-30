<?php

namespace App\Events;

use Nette,
	Kdyby,
	Doctrine,
	App\Model\Entities,
	Nette\Reflection,
	WebChemistry\Images;

/**
 *  @author Jan Mikes <j.mikes@me.com>
 *  @copyright Jan Mikes - janmikes.cz
 */
final class ImageRemoveSubscriber extends Nette\Object implements Kdyby\Events\Subscriber
{
	/** @var WebChemistry\Images\Storage */
	private $imageStorage;


	public function __construct(Images\Storage $imageStorage)
	{
		$this->imageStorage = $imageStorage;
	}


	public function getSubscribedEvents()
	{
		return [Doctrine\ORM\Events::preRemove];
	}


	public function preRemove(Doctrine\ORM\Event\LifecycleEventArgs $args)
	{
		$reader = new \Doctrine\Common\Annotations\AnnotationReader();
		$entity = $args->getObject();
			
		foreach (Reflection\ClassType::from($entity)->getProperties() as $property) {
			$image = $reader->getPropertyAnnotation($property, "App\\Annotations\\Image");

			if ($image && $image->autodelete && $imagePath = $entity->{$property->getName()}) {
				$this->imageStorage->delete($imagePath);
			}
		}
	}
}
