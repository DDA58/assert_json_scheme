<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Exception;

class AssertFailedException extends AbstractBaseException
{
    public function __construct(
        string $message,
        private mixed $value,
        int $code = 0,
        ?self $previous = null,
        private mixed $parentData = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function getParentData(): mixed
    {
        return $this->parentData;
    }
}
