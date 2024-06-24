<?php

namespace RevendaTeste\Traits;

trait ObjectToArray
{
    /**
     * Converte um objeto para um array, mapeando as propriedades e transformando-as nos respectivos índices e seus valores
     *
     * @param $object
     * @return array
     */
    public function toArray($object): array
    {
        $reflectionClass = new \ReflectionClass(get_class($object));
        $array = [];
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = (is_object($property->getValue($object))) ?
                $this->toArray($property->getValue($object)) :
                $property->getValue($object);
            $property->setAccessible(false);
        }

        return $array;
    }
}
