<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\AlternativeProductsRestApi\Dependency\RestApiResource;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class AlternativeProductsRestApiToProductsRestApiResourceBridge implements AlternativeProductsRestApiToProductsRestApiResourceInterface
{
    /**
     * @var \Spryker\Glue\ProductsRestApi\ProductsRestApiResourceInterface
     */
    protected $productsRestApiResource;

    /**
     * @param \Spryker\Glue\ProductsRestApi\ProductsRestApiResourceInterface $productsRestApiResource
     */
    public function __construct($productsRestApiResource)
    {
        $this->productsRestApiResource = $productsRestApiResource;
    }

    public function findProductAbstractById(int $idProductAbstract, RestRequestInterface $restRequest): ?RestResourceInterface
    {
        return $this->productsRestApiResource->findProductAbstractById($idProductAbstract, $restRequest);
    }

    public function findProductConcreteById(int $idProductConcrete, RestRequestInterface $restRequest): ?RestResourceInterface
    {
        return $this->productsRestApiResource->findProductConcreteById($idProductConcrete, $restRequest);
    }
}
