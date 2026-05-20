<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\AlternativeProductsRestApi\Api\Storefront\Provider;

use Generated\Shared\Transfer\ProductAlternativeStorageTransfer;
use Spryker\ApiPlatform\State\Provider\AbstractStorefrontProvider;
use Spryker\Client\ProductAlternativeStorage\ProductAlternativeStorageClientInterface;
use Spryker\Client\ProductStorage\ProductStorageClientInterface;
use Spryker\Glue\AlternativeProductsRestApi\Api\Storefront\Exception\AlternativeProductsExceptionFactory;

abstract class AlternativeProductsBaseStorefrontProvider extends AbstractStorefrontProvider
{
    protected const string MAPPING_TYPE_SKU = 'sku';

    public function __construct(
        protected ProductStorageClientInterface $productStorageClient,
        protected ProductAlternativeStorageClientInterface $productAlternativeStorageClient,
        protected AlternativeProductsExceptionFactory $exceptionFactory,
    ) {
    }

    /**
     * @throws \Spryker\ApiPlatform\Exception\GlueApiException
     */
    protected function provideCollection(): array
    {
        $concreteSku = (string)($this->getUriVariables()['concreteProductSku'] ?? '');

        if ($concreteSku === '') {
            throw $this->exceptionFactory->createConcreteProductSkuMissingException();
        }

        $locale = $this->getLocale()->getLocaleNameOrFail();

        $concreteProductData = $this->productStorageClient->findProductConcreteStorageDataByMapping(
            static::MAPPING_TYPE_SKU,
            $concreteSku,
            $locale,
        );

        if ($concreteProductData === null) {
            throw $this->exceptionFactory->createConcreteProductNotFoundException();
        }

        $alternativeStorage = $this->productAlternativeStorageClient->findProductAlternativeStorage($concreteSku);

        if ($alternativeStorage === null) {
            return [];
        }

        return $this->buildAlternativeProductResources($alternativeStorage, $locale);
    }

    abstract protected function buildAlternativeProductResources(
        ProductAlternativeStorageTransfer $alternativeStorage,
        string $locale,
    ): array;
}
