<?php

namespace ExtendedSlim\App\Controllers;

use ExtendedSlim\Http\Request;
use ExtendedSlim\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class AbstractAction
{
    /**
     * @param ConstraintViolationListInterface $violations
     *
     * @return string
     */
    protected function createErrorResponse(ConstraintViolationListInterface $violations): string
    {
        $message = 'API request validation error on field(s): ';

        foreach ($violations as $violation)
        {
            $message .= $violation->getPropertyPath().' ';
        }

        return $message;
    }

    /**
     * @param Request $request
     * @param string  $parameter
     *
     * @return null|string
     */
    protected function getStringParam(Request $request, string $parameter): ?string
    {
        $value = $request->getParam($parameter);

        return $value === null ? null : (string)$value;
    }

    /**
     * @param Request $request
     * @param string  $parameter
     *
     * @return null|string
     */
    protected function getIntParam(Request $request, string $parameter): ?string
    {
        return $this->getStringParam($request, $parameter);
    }

    /**
     * @param Request $request
     * @param string  $parameter
     *
     * @return null|string
     */
    protected function getStringRouteParam(Request $request, string $parameter): ?string
    {
        /** @var Route $route */
        $route = $request->getAttributes()["route"];

        $value = $route->getArgument($parameter);

        return $value === null ? null : (string)$value;
    }

    /**
     * @param Request $request
     * @param string  $parameter
     *
     * @return null|string
     */
    protected function getIntRouteParam(Request $request, string $parameter): ?string
    {
        return $this->getStringRouteParam($request, $parameter);
    }

    /**
     * @param Request $request
     * @param string  $parameter
     *
     * @return null|string[]
     */
    protected function getIntArrayParam(Request $request, string $parameter): ?array
    {
        $params = $request->getParams();
        if (!isset($params[$parameter]))
        {
            return null;
        }

        $values = $params[$parameter];

        if (null === $values)
        {
            return null;
        }

        if (is_array($values))
        {
            return array_map(
                function ($value)
                {
                    return (string)$value;
                },
                $values
            );
        }

        return null;
    }

    /**
     * @param Request $request
     * @param string  $parameter
     *
     * @return null|string
     */
    protected function getBoolParam(Request $request, string $parameter): ?string
    {
        return $this->getStringParam($request, $parameter);
    }
}
