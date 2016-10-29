<?php

namespace App\Entities\Traits;

use Doctrine\ORM\Mapping AS ORM;

trait Deletable
{
	/**
	 * @ORM\Column(name="time_deleted", type="datetime", nullable=true)
	 * @var \DateTime $timeDeleted
	 */
	protected $timeDeleted;
	
	/**
	 * @ORM\Column(name="deleted", type="boolean", options={"default" : 0})
	 * @var bool $deleted
	 */
	protected $deleted = FALSE;
	
	/**
	 * @return \DateTime
	 */
	public function getTimeDeleted()
	{
		return $this->timeDeleted;
	}
	
	/**
	 * @param \DateTime $timeDeleted
	 *
	 * @return $this
	 */
	public function setTimeDeleted($timeDeleted)
	{
		$this->timeDeleted = $timeDeleted;
		
		return $this;
	}
	
	/**
	 * @return boolean
	 */
	public function isDeleted()
	{
		return $this->deleted;
	}
	
	/**
	 * @param boolean $deleted
	 *
	 * @return $this
	 */
	public function setDeleted($deleted)
	{
		$this->deleted = $deleted;
		
		return $this;
	}
	
	/**
	 * @return $this
	 */
	public function delete()
	{
		$this->timeDeleted = new \DateTime();
		$this->deleted     = TRUE;
		
		return $this;
	}
}