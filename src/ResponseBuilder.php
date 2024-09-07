<?php

declare(strict_types=1);

namespace Janmuran\ObjectBuilder;

use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\ResponseInterface;

final class ResponseBuilder
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @template T of object
     * @param class-string<T> $class
     * @return T of object
     */
    public function createObjectFromResponse(ResponseInterface $response, string $class, string $type = 'json'): object
    {
        /** @var string $data */
        $data = $response->getBody()->getContents();

        return $this->createObjectFromString($data, $class, $type);
    }

    /**
     * @template T of object
     * @param class-string<T> $class
     * @return T
     */
    public function createObjectFromString(string $data, string $class, string $type = 'json'): object
    {
        return $this->serializer->deserialize($data, $class, $type);
    }

    /**
     * @template T of object
     * @param class-string<T> $class
     * @return array<T>
     */
    public function createResponseList(ResponseInterface $response, string $class, string $type = 'json'): array
    {
        $type = sprintf('array<%s>', $class);

        return $this->serializer->deserialize($response->getBody()->getContents(), $type, $type);
    }
}
