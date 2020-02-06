<?php
namespace Ivatsko\RequestPrice\Block\Adminhtml\AllRecords\Edit;

use Magento\Backend\Block\Widget\Context;
use Ivatsko\RequestPrice\Api\RequestPriceRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    protected $context;

    protected $requestPriceRepository;

    public function __construct(
        Context $context,
        RequestPriceRepositoryInterface $requestPriceRepositoryConstruct
    ) {
        $this->context = $context;
        $this->requestPriceRepository = $requestPriceRepositoryConstruct;
    }

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

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
?>
