<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\AlternativeProductsRestApi\Processor\RestResponseBuilder;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface AlternativeProductRestResponseBuilderInterface
{
    public function createRestResponse(): RestResponseInterface;

    public function createConcreteProductSkuMissingError(): RestResponseInterface;

    public function createConcreteProductNotFoundError(): RestResponseInterface;

    public function createRouteNotFoundError(): RestResponseInterface;

    public function buildAbstractAlternativeProductCollectionResponse(
        array $abstractProductIds,
        RestRequestInterface $restRequest
    ): RestResponseInterface;

    public function buildConcreteAlternativeProductCollectionResponse(
        array $concreteProductIds,
        RestRequestInterface $restRequest
    ): RestResponseInterface;
}
