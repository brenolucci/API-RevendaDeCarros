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

            if ($property->isInitialized($object) === false) {
                continue;
            }

            if (is_object($property->getValue($object))) {
                $array[$property->getName()] = $this->toArray($property->getValue($object));
            } elseif (is_array($property->getValue($object))) {
                foreach ($property->getValue($object) as $item) {
                    $array[$property->getName()][] = $this->toArray($item);
                }
            } else {
                $array[$property->getName()] = $property->getValue($object);
            }

            $property->setAccessible(false);
        }

        return $array;
    }
}
