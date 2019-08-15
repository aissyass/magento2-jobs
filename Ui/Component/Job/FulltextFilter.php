<?php
/**
 * created: 2019
 *
 * @category  XXXXXXX
 * @package   Ayaline
 * @author    aYaline Magento <support.magento-shop@ayaline.com>
 * @copyright 2019 - aYaline Magento
 * @license   aYaline - http://shop.ayaline.com/magento/fr/conditions-generales-de-vente.html
 * @link      http://shop.ayaline.com/magento/fr/conditions-generales-de-vente.html
 */

namespace PHPAISS\Jobs\Ui\Component\Job;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;

/**
 * Adds fulltext filter for Jobs Job name attribute.
 */
class FulltextFilter
{
    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * FulltextFilter constructor.
     *
     * @param FilterBuilder $filterBuilder
     */
    public function __construct(FilterBuilder $filterBuilder)
    {
        $this->filterBuilder = $filterBuilder;
    }

    /**
     * Adds custom filter to search criteria builder based on received filter.
     *
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Filter $filter
     * @return void
     */
    public function addFilter(SearchCriteriaBuilder $searchCriteriaBuilder, Filter $filter)
    {
        $titleFilter = $this->filterBuilder->setField('name')
                                           ->setValue(sprintf('%%%s%%', $filter->getValue()))
                                           ->setConditionType('like')
                                           ->create();
        $searchCriteriaBuilder->addFilter($titleFilter);
    }
}
