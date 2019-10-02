<?php


namespace KTPL\Testimonial\Api;

use KTPL\Testimonial\Api\Data\TestimonialInterface;

interface TestimonialRepositoryInterface
{
    /**
     * get testimonial data
     * @return TestimonialInterface
     */
    public function getList();

    /**
     * @param int $testimonial_id
     * @return TestimonialInterface
     */
    public function getTestimonialById($testimonial_id);

    /**
     * @param \KTPL\Testimonial\Api\Data\TestimonialInterface $testimonial
     * @return TestimonialInterface
     */
    public function saveTestimonialData(TestimonialInterface $testimonial);

    /**
     * @param int $testimonial_id
     * @return TestimonialInterface
     */
    public function DeleteTestimonialById($testimonial_id);
}