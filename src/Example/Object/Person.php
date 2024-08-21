<?php

declare(strict_types=1);

namespace Janmuran\ObjectBuilder\Example\Object;

use DateTime;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

final class Person
{
    public function __construct(
        public readonly string $name,
        public readonly int $age,
        #[SerializedName(name: 'birthDate')]
        #[Type(name: 'DateTime<"Y-m-d">')]
        public readonly DateTime $birthDate,
    ) {
    }
}
