<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\AlternativeProductsRestApi;

use Spryker\Glue\AlternativeProductsRestApi\Dependency\Client\AlternativeProductsRestApiToProductAlternativeStorageClientInterface;
use Spryker\Glue\AlternativeProductsRestApi\Dependency\Client\AlternativeProductsRestApiToProductStorageClientInterface;
use Spryker\Glue\AlternativeProductsRestApi\Dependency\RestApiResource\AlternativeProductsRestApiToProductsRestApiResourceInterface;
use Spryker\Glue\AlternativeProductsRestApi\Processor\AbstractAlternativeProduct\AbstractAlternativeProductReader;
use Spryker\Glue\AlternativeProductsRestApi\Processor\AbstractAlternativeProduct\AbstractAlternativeProductReaderInterface;
use Spryker\Glue\AlternativeProductsRestApi\Processor\ConcreteAlternativeProduct\ConcreteAlternativeProductReader;
use Spryker\Glue\AlternativeProductsRestApi\Processor\ConcreteAlternativeProduct\ConcreteAlternativeProductReaderInterface;
use Spryker\Glue\AlternativeProductsRestApi\Processor\RestResponseBuilder\AlternativeProductRestResponseBuilder;
use Spryker\Glue\AlternativeProductsRestApi\Processor\RestResponseBuilder\AlternativeProductRestResponseBuilderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class AlternativeProductsRestApiFactory extends AbstractFactory
{
    public function createConcreteAlternativeProductReader(): ConcreteAlternativeProductReaderInterface
    {
        return new ConcreteAlternativeProductReader(
            $this->getProductAlternativeStorageClient(),
            $this->getProductStorageClient(),
            $this->createAlternativeProductRestResponseBuilder(),
        );
    }

    public function createAbstractAlternativeProductReader(): AbstractAlternativeProductReaderInterface
    {
        return new AbstractAlternativeProductReader(
            $this->getProductAlternativeStorageClient(),
            $this->getProductStorageClient(),
            $this->createAlternativeProductRestResponseBuilder(),
        );
    }

    public function createAlternativeProductRestResponseBuilder(): AlternativeProductRestResponseBuilderInterface
    {
        return new AlternativeProductRestResponseBuilder(
            $this->getResourceBuilder(),
            $this->getProductsRestApiResource(),
        );
    }

    public function getProductAlternativeStorageClient(): AlternativeProductsRestApiToProductAlternativeStorageClientInterface
    {
        return $this->getProvidedDependency(AlternativeProductsRestApiDependencyProvider::CLIENT_PRODUCT_ALTERNATIVE_STORAGE);
    }

    public function getProductStorageClient(): AlternativeProductsRestApiToProductStorageClientInterface
    {
        return $this->getProvidedDependency(AlternativeProductsRestApiDependencyProvider::CLIENT_PRODUCT_STORAGE);
    }

    public function getProductsRestApiResource(): AlternativeProductsRestApiToProductsRestApiResourceInterface
    {
        return $this->getProvidedDependency(AlternativeProductsRestApiDependencyProvider::RESOURCE_PRODUCTS_REST_API);
    }
}
