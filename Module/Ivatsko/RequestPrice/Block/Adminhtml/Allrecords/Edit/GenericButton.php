<?php
declare(strict_types=1);

namespace Ivatsko\RequestPrice\Block\Adminhtml\AllRecords\Edit;

use Magento\Backend\Block\Widget\Context;
use Ivatsko\RequestPrice\Api\RequestPriceRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 * @package Ivatsko\RequestPrice\Block\Adminhtml\AllRecords\Edit
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var RequestPriceRepositoryInterface
     */
    protected $requestPriceRepository;

    /**
     * GenericButton constructor.
     * @param Context $context
     * @param RequestPriceRepositoryInterface $requestPriceRepositoryConstruct
     */
    public function __construct(
        Context $context,
        RequestPriceRepositoryInterface $requestPriceRepositoryConstruct
    ) {
        $this->context = $context;
        $this->requestPriceRepository = $requestPriceRepositoryConstruct;
    }

    /**
     * @return |null
     */
    public function getRecordsId()
    {
        try {
            return $this->requestPriceRepository->getById(
                $this->context->getRequest()->getParam('records_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * @param string $route
     * @param array $params
     * @return mixed
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
?>
