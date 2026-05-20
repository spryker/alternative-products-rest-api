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
use Spryker\Glue\ProductsRestApi\Api\Storefront\Provider\ConcreteProductsStorefrontProvider;

class ConcreteAlternativeProductsStorefrontProvider extends AlternativeProductsBaseStorefrontProvider
{
    public function __construct(
        ProductStorageClientInterface $productStorageClient,
        ProductAlternativeStorageClientInterface $productAlternativeStorageClient,
        protected ConcreteProductsStorefrontProvider $concreteProductsProvider,
        AlternativeProductsExceptionFactory $exceptionFactory,
    ) {
        parent::__construct($productStorageClient, $productAlternativeStorageClient, $exceptionFactory);
    }

    /**
     * @return array<\Generated\Api\Storefront\ConcreteProductsStorefrontResource>
     */
    protected function buildAlternativeProductResources(
        ProductAlternativeStorageTransfer $alternativeStorage,
        string $locale,
    ): array {
        $concreteProductIds = $alternativeStorage->getProductConcreteIds();

        if ($concreteProductIds === []) {
            return [];
        }

        return (array)$this->concreteProductsProvider->provide(
            new GetCollection(),
            $this->uriVariables,
            array_merge($this->context, [ConcreteProductsStorefrontProvider::CONTEXT_KEY_CONCRETE_PRODUCT_IDS => $concreteProductIds]),
        );
    }
}
