<?php

namespace KTPL\Testimonial\Model;

use KTPL\Testimonial\Api\Data\KTPL;
use KTPL\Testimonial\Api\Data\TestimonialInterface;

class Testimonial extends \Magento\Framework\Model\AbstractModel implements TestimonialInterface
{
    const CACHE_TAG = 'KTPL_testimonial_testimonial';

    protected $_cacheTag = 'KTPL_testimonial_testimonial';

    public $_eventPrefix = 'KTPL_testimonial_testimonial';

    protected function _construct()
    {
        $this->_init('KTPL\Testimonial\Model\ResourceModel\Testimonial');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getData(TestimonialInterface::Id);
    }

    /**
     * @param $id
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setId($id)
    {
        $this->setData(TestimonialInterface::Id, $id);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getData(TestimonialInterface::Name);
    }

    /**
     * @param $name
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setName($name)
    {
        $this->setData(TestimonialInterface::Name, $name);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(TestimonialInterface::Email);
    }

    /**
     * @param $email
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setEmail($email)
    {
        $this->setData(TestimonialInterface::Email, $email);
    }

    /**
     * @return int
     */
    public function getRatings()
    {
        return $this->getData(TestimonialInterface::Ratings);
    }

    /**
     * @param $ratings
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setRatings($ratings)
    {
        $this->setData(TestimonialInterface::Ratings, $ratings);
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->getData(TestimonialInterface::Image);
    }

    /**
     * @param $image
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setImage($image)
    {
        $this->setData(TestimonialInterface::Image, $image);
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->getData(TestimonialInterface::Message);
    }

    /**
     * @param $message
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setMessage($message)
    {
        $this->setData(TestimonialInterface::Message, $message);
    }

    /**
     * @return bool
     */
    public function getIsApproved()
    {
        return $this->getData(TestimonialInterface::IsApproved);
    }

    /**
     * @param $is_approved
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setIsApproved($is_approved)
    {
        $this->setData(TestimonialInterface::IsApproved, $is_approved);
    }

    /**
     * @return bool
     */
    public function getIsEnable()
    {
        return $this->getData(TestimonialInterface::IsEnable);
    }

    /**
     * @param $is_enable
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setIsEnable($is_enable)
    {
        $this->setData(TestimonialInterface::IsEnable, $is_enable);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(TestimonialInterface::CreatedAt);
    }

    /**
     * @param $created_at
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setCreatedAt($created_at)
    {
        $this->setData(TestimonialInterface::CreatedAt, $created_at);
    }

    /**
     * @return string
     */
    public function getUpdatedDate()
    {
        return $this->getData(TestimonialInterface::UpdatedAt);
    }

    /**
     * @param $updated_at
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setUpdatedDate($updated_at)
    {
        $this->setData(TestimonialInterface::UpdatedAt, $updated_at);
    }

    /**
     * get testimonial deleted date
     * @return string
     */
    public function getDeletedAt()
    {
        return $this->getData(TestimonialInterface::DeletedAt);
    }

    /**
     * set testimonial deleted date
     * @param $deleted_at
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setDeletedAt($deleted_at)
    {
        $this->setData(TestimonialInterface::DeletedAt, $deleted_at);
    }
}