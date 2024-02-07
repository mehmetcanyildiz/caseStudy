<?php

namespace App\Exceptions;

use Exception as BaseException;
use Throwable;

/**
 * Exceptions
 */
abstract class Exceptions extends BaseException
{
    protected int   $httpStatusCode;
    protected array $context;

    /**
     * Constructs an exception instance.
     */
    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null,
        int $httpStatusCode = 500,
        array $context = [],
    ) {
        parent::__construct($message, $code, $previous);

        $this->httpStatusCode = $httpStatusCode;
        $this->context        = $context;
    }

    /**
     * Sets the HTTP status code.
     */
    public function setHttpStatusCode(int $httpStatusCode): void
    {
        $this->httpStatusCode = $httpStatusCode;
    }

    /**
     * Returns the HTTP status code.
     */
    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    /**
     * Sets the context.
     */
    public function setContext(array $context): void
    {
        $this->context = $context;
    }

    /**
     * Returns the context.
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * Returns the context.
     */
    public function context(): array
    {
        return $this->getContext();
    }
}
