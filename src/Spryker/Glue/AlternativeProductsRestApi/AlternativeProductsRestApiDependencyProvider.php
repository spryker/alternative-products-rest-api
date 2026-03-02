<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\AlternativeProductsRestApi;

use Spryker\Glue\AlternativeProductsRestApi\Dependency\Client\AlternativeProductsRestApiToProductAlternativeStorageClientBridge;
use Spryker\Glue\AlternativeProductsRestApi\Dependency\Client\AlternativeProductsRestApiToProductStorageClientBridge;
use Spryker\Glue\AlternativeProductsRestApi\Dependency\RestApiResource\AlternativeProductsRestApiToProductsRestApiResourceBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @method \Spryker\Glue\AlternativeProductsRestApi\AlternativeProductsRestApiConfig getConfig()
 */
class AlternativeProductsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_PRODUCT_ALTERNATIVE_STORAGE = 'CLIENT_PRODUCT_ALTERNATIVE_STORAGE';

    /**
     * @var string
     */
    public const CLIENT_PRODUCT_STORAGE = 'CLIENT_PRODUCT_STORAGE';

    /**
     * @var string
     */
    public const RESOURCE_PRODUCTS_REST_API = 'RESOURCE_PRODUCTS_REST_API';

    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addProductAlternativeStorageClient($container);
        $container = $this->addProductStorageClient($container);
        $container = $this->addProductsRestApiResource($container);

        return $container;
    }

    protected function addProductAlternativeStorageClient(Container $container): Container
    {
        $container->set(static::CLIENT_PRODUCT_ALTERNATIVE_STORAGE, function (Container $container) {
            return new AlternativeProductsRestApiToProductAlternativeStorageClientBridge(
                $container->getLocator()->productAlternativeStorage()->client(),
            );
        });

        return $container;
    }

    protected function addProductsRestApiResource(Container $container): Container
    {
        $container->set(static::RESOURCE_PRODUCTS_REST_API, function (Container $container) {
            return new AlternativeProductsRestApiToProductsRestApiResourceBridge(
                $container->getLocator()->productsRestApi()->resource(),
            );
        });

        return $container;
    }

    protected function addProductStorageClient(Container $container): Container
    {
        $container->set(static::CLIENT_PRODUCT_STORAGE, function (Container $container) {
            return new AlternativeProductsRestApiToProductStorageClientBridge(
                $container->getLocator()->productStorage()->client(),
            );
        });

        return $container;
    }
}
