<?php
declare(strict_types=1);

namespace Ivatsko\RequestPrice\Block\RequestPrice;

use Magento\Catalog\Model\Product\Pricing\Renderer\SalableResolverInterface;
use Magento\Catalog\Pricing\Price\MinimalPriceCalculatorInterface;
use Magento\Framework\Pricing\Price\PriceInterface;
use Magento\Framework\Pricing\Render\RendererPool;
use Magento\Framework\Pricing\SaleableInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class RequestPrice
 * @package Ivatsko\RequestPrice\Block\RequestPrice
 */
class RequestPrice extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{
    /**
     * @var Product
     */
    protected $product;
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * RequestPrice constructor.
     * @param Registry $registryConstruct
     */
    /**
     * @param Context $context
     * @param SaleableInterface $saleableItem
     * @param PriceInterface $price
     * @param RendererPool $rendererPool
     * @param array $data
     * @param SalableResolverInterface $salableResolver
     * @param MinimalPriceCalculatorInterface $minimalPriceCalculator
     */
    public function __construct(
        Context $context,
        SaleableInterface $saleableItem,
        PriceInterface $price,
        RendererPool $rendererPool,
        array $data = [],
        SalableResolverInterface $salableResolver = null,
        MinimalPriceCalculatorInterface $minimalPriceCalculator = null,
        Registry $registryConstruct
    )
    {
        parent::__construct($context, $saleableItem, $price, $rendererPool, $data);
        $this->registry = $registryConstruct;
    }

    /**
     * @return Product
     */
    private function getProduct()
    {
        $this->product = $this->registry->registry('current_product');
        return $this->product;
    }

    /**
     * @return mixed
     */
    public function getProductSku()
    {
        return $this->getProduct()->getSku();
    }


}
