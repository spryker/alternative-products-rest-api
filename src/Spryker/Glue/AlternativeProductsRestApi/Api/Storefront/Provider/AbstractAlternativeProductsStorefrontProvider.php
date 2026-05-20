<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\AlternativeProductsRestApi\Api\Storefront\Provider;

use ApiPlatform\Metadata\GetCollection;
use Generated\Shared\Transfer\ProductAlternativeStorageTransfer;
use Spryker\Client\ProductAlternativeStorage\ProductAlternativeStorageClientInterface;
use Spryker\Client\ProductStorage\ProductStorageClientInterface;
use Spryker\Glue\AlternativeProductsRestApi\Api\Storefront\Exception\AlternativeProductsExceptionFactory;
use Spryker\Glue\ProductsRestApi\Api\Storefront\Provider\AbstractProductsStorefrontProvider;

class AbstractAlternativeProductsStorefrontProvider extends AlternativeProductsBaseStorefrontProvider
{
    public function __construct(
        ProductStorageClientInterface $productStorageClient,
        ProductAlternativeStorageClientInterface $productAlternativeStorageClient,
        protected AbstractProductsStorefrontProvider $abstractProductsProvider,
        AlternativeProductsExceptionFactory $exceptionFactory,
    ) {
        parent::__construct($productStorageClient, $productAlternativeStorageClient, $exceptionFactory);
    }

    /**
     * @return array<\Generated\Api\Storefront\AbstractProductsStorefrontResource>
     */
    protected function buildAlternativeProductResources(
        ProductAlternativeStorageTransfer $alternativeStorage,
        string $locale,
    ): array {
        $abstractProductIds = $alternativeStorage->getProductAbstractIds();

        if ($abstractProductIds === []) {
            return [];
        }

        return (array)$this->abstractProductsProvider->provide(
            new GetCollection(),
            $this->uriVariables,
            array_merge($this->context, [AbstractProductsStorefrontProvider::CONTEXT_KEY_ABSTRACT_PRODUCT_IDS => $abstractProductIds]),
        );
    }
}
