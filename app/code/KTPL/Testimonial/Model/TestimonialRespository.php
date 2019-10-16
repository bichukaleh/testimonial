<?php

namespace KTPL\Testimonial\Model;

use KTPL\Testimonial\Api\TestimonialRepositoryInterface;
use KTPL\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;
use KTPL\Testimonial\Model\ResourceModel\Testimonial\Collection;
use KTPL\Testimonial\Model\TestimonialFactory as TestimonialModel;
use KTPL\Testimonial\Model\ResourceModel\Testimonial;
class TestimonialRespository implements TestimonialRepositoryInterface
{

    /** @var TestimonialFactory */
    protected $testimonialFactory;
    /**  @var Testimonial|\KTPL\Testimonial\Model\Testimonial */
    protected $testimonial;
    /**  @var TestimonialFactory */
    protected $testimonialModel;

    /**
     * TestimonialRespository constructor.
     * @param CollectionFactory $collectionFactory
     * @param TestimonialFactory $testimonialModel
     * @param TestimonialFactory $testimonialFactory
     * @param Testimonial $testimonial
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        TestimonialModel $testimonialModel,
        TestimonialFactory $testimonialFactory,
        Testimonial $testimonial
    ) {
        /** @var Collection collection */
        $this->collection = $collectionFactory->create()->addFieldToFilter('deleted_at', ['null' => true]);
        $this->testimonialFactory = $testimonialFactory;
        $this->testimonial = $testimonial;
        $this->testimonialModel = $testimonialModel;
    }

    /**
     * @return Collection
     */
    public function getCollection()
    {
        return $this->collection->setOrder('testimonial_id', 'DESC');
    }

    /**
     * @return array|\KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function getList()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        $collection = $this->getCollection()->toArray();
        return $collection;
    }

    /**
     * @param $testimonial_id
     * @return \KTPL\Testimonial\Api\Data\TestimonialInterface
     */
    public function getTestimonialById($testimonial_id)
    {
//        return $this->testimonialFactory->create()->load($testimonial_id);
        return $this->testimonialModel->create()->load($testimonial_id);
    }

    /**
     * save testimonial data
     * @param \KTPL\Testimonial\Api\Data\TestimonialInterface $testimonial
     * @return \KTPL\Testimonial\Api\Data\TestimonialInterface|void
     */
    public function saveTestimonialData(\KTPL\Testimonial\Api\Data\TestimonialInterface $testimonial)
    {
        try {
            if ($testimonial->getId() != null) {
                $testimonial->setId($testimonial->getId());
            } else {
                $testimonial->setCreatedAt(date('Y-m-d'));
            }
            $testimonial->setName($testimonial->getName());
            $testimonial->setEmail($testimonial->getEmail());
            $testimonial->setMessage($testimonial->getMessage());
            $testimonial->setRatings($testimonial->getRatings());
            $testimonial->setUpdatedDate(date('Y-m-d'));
            $testimonial->setIsApproved(1);
            $testimonial->setIsEnable(1);
            $this->testimonial->save($testimonial);
        } catch (\Exception $e) {
            return json_encode(array('message' => $e->getMessage()));
        }

        return $testimonial;
    }

    /**
     * $testimonial
     * @param int $testimonial_id
     * @return \KTPL\Testimonial\Api\Data\TestimonialInterface|\KTPL\Testimonial\Model\Testimonial
     * @throws \Exception
     */
    public function DeleteTestimonialById($testimonial_id)
    {
        $testimonial = $this->testimonialFactory->create();
        $testimonial->setId($testimonial_id);
        $testimonial->setDeletedAt(date('y-m-d'));
        $this->testimonial->save($testimonial);
        return $testimonial;
    }
}