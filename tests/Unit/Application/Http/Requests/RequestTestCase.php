<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Http\Requests;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator;
use Tests\Unit\Application\Http\Requests\Helpers\StubRepository;
use Tests\Unit\Application\Http\Requests\Helpers\StubValidationFactory;
use Tests\Unit\UnitTestCase;

abstract class RequestTestCase extends UnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        StubRepository::clearRepository();
    }

    public function validateParameters(array $requestParameters): bool
    {
        try {
            $this->createRequest($requestParameters)->validateResolved();
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function validateWithRouteParameters(array $requestParameters, array $routeParameters): bool
    {
        try {
            $formRequest = $this->createRequest($requestParameters);
            $this->setRequestRouteParameters($formRequest, $routeParameters);
            $formRequest->validateResolved();
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    abstract protected function getRequestUnderTest(): string;

    private function createContainer(): Container
    {
        $container = new Container();
        $container->bindMethod($this->getRequestUnderTest() . '@authorize', function () {
            return true;
        });
        $container->bind(ValidationFactory::class, StubValidationFactory::class);

        return $container;
    }

    private function createRequest(array $requestParameters): FormRequest
    {
        $requestUnderTestClass = $this->getRequestUnderTest();
        /** @var FormRequest $request */
        $request = new $requestUnderTestClass($requestParameters);
        $request->setContainer($this->createContainer());
        $request->setRedirector(new Redirector(new UrlGenerator(new RouteCollection(), new Request())));

        return $request;
    }

    private function setRequestRouteParameters(FormRequest $formRequest, array $routeParameters): void
    {
        $formRequest->setRouteResolver(function () use ($formRequest, $routeParameters) {
            $route = new Route('', '', []);
            $route->bind($formRequest);
            foreach ($routeParameters as $parameterName => $parameterValue) {
                $route->setParameter($parameterName, $parameterValue);
            }

            return $route;
        });
    }
}
