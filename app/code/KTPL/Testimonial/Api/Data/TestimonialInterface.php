<?php


namespace KTPL\Testimonial\Api\Data;


interface TestimonialInterface
{
    const Id= "id";
    const Name= "name";
    const Email= "email";
    const Image= "image";
    const Ratings= "ratings";
    const Message= "message";
    const IsApproved= "is_approved";
    const IsEnable= "is_enable";
    const CreatedAt= "created_at";
    const UpdatedAt= "updated_at";
    const DeletedAt= "deleted_at";

    /**
     * get testimonial Id
     * @return int
     */
    public function getId();

    /**
     * set testimonial Id
     * @param $id
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setId($id);

    /**
     * get testimonial name
     * @return string
     */
    public function getName();

    /**
     * set testimonial name
     * @param $name
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setName($name);

    /**
     * get email Id
     * @return string
     */
    public function getEmail();

    /**
     * set email Id
     * @param $email
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setEmail($email);

    /**
     * get testimonial ratings
     * @return int
     */
    public function getRatings();

    /**
     * set testimonial ratings
     * @param $ratings
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setRatings($ratings);

    /**
     * get testimonial image as a path
     * @return string
     */
    public function getImage();

    /**
     * set testimonial image as a path
     * @param $image
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setImage($image);

    /**
     * get testimonial message
     * @return string
     */
    public function getMessage();

    /**
     * set testimonial message
     * @param $message
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setMessage($message);

    /**
     * get testimonial is_approved status
     * @return bool
     */
    public function getIsApproved();

    /**
     * set testimonial is_approved status
     * @param $is_approved
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setIsApproved($is_approved);

    /**
     * get testimonial is_enable status
     * @return bool
     */
    public function getIsEnable();

    /**
     * set testimonial is_enable status
     * @param $is_enable
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setIsEnable($is_enable);

    /**
     * get testimonial created date
     * @return string
     */
    public function getCreatedAt();

    /**
     * set testimonial created date
     * @param $created_at
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setCreatedAt($created_at);

    /**
     * get testimonial updated date
     * @return string
     */
    public function getUpdatedDate();

    /**
     * set testimonial updated date
     * @param $updated_at
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setUpdatedDate($updated_at);

    /**
     * get testimonial deleted date
     * @return string
     */
    public function getDeletedAt();

    /**
     * set testimonial deleted date
     * @param $deleted_at
     * @return KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function setDeletedAt($deleted_at);
}