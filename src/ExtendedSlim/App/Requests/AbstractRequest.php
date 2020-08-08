<?php

namespace ExtendedSlim\App\Requests;

use MabeEnum\Enum;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Mapping\ClassMetadata;

abstract class AbstractRequest
{
    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     *
     * @deprecated Use setOptionalIntRule
     */
    protected static function optionalInt(ClassMetadata &$metadata, string $property)
    {
        self::setOptionalIntRule($metadata, $property);
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     */
    protected static function setOptionalIntRule(ClassMetadata &$metadata, string $property)
    {
        $metadata->addPropertyConstraint($property, new Constraints\Regex('/^\d+$/'));
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     *
     * @deprecated Use setRequiredIntRule
     */
    protected static function requiredInt(ClassMetadata &$metadata, string $property)
    {
        self::setRequiredIntRule($metadata, $property);
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     */
    protected static function setRequiredIntRule(ClassMetadata &$metadata, string $property)
    {
        $metadata->addPropertyConstraint($property, new Constraints\NotBlank());
        $metadata->addPropertyConstraint($property, new Constraints\Regex('/^\d+$/'));
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     *
     * @deprecated Use setRequiredBoolRule
     */
    protected static function requiredBool(ClassMetadata &$metadata, string $property)
    {
        self::setRequiredBoolRule($metadata, $property);
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     */
    protected static function setRequiredBoolRule(ClassMetadata &$metadata, string $property)
    {
        $metadata->addPropertyConstraint($property, new Constraints\NotBlank());
        $metadata->addPropertyConstraint($property, new Constraints\Regex('/^[0-1]$/'));
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     *
     * @deprecated Use setRequiredStringRule
     */
    protected static function requiredString(ClassMetadata &$metadata, string $property)
    {
        self::setRequiredStringRule($metadata, $property);
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     */
    protected static function setRequiredStringRule(ClassMetadata &$metadata, string $property)
    {
        $metadata->addPropertyConstraint($property, new Constraints\NotBlank());
        $metadata->addPropertyConstraint($property, new Constraints\Length(['min' => 1]));
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     *
     * @deprecated Use setOptionalStringRule
     */
    protected static function optionalString(ClassMetadata &$metadata, string $property)
    {
        self::setOptionalStringRule($metadata, $property);
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     */
    protected static function setOptionalStringRule(ClassMetadata &$metadata, string $property)
    {
        $metadata->addPropertyConstraint($property, new Constraints\Length(['min' => 1]));
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     * @param string        $class
     *
     * @deprecated Use setRequiredEnumByValueRule
     */
    protected static function requiredEnumByValue(ClassMetadata &$metadata, string $property, string $class)
    {
        self::setRequiredEnumByValueRule($metadata, $property, $class);
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     * @param string        $class
     */
    protected static function setRequiredEnumByValueRule(ClassMetadata &$metadata, string $property, string $class)
    {
        /** @var Enum $class */
        $metadata->addPropertyConstraint(
            $property,
            new Constraints\Choice(
                array_map(
                    function ($item)
                    {
                        return (string)$item;
                    },
                    $class::getValues()
                )
            )
        );
        $metadata->addPropertyConstraint($property, new Constraints\NotBlank());
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     * @param string        $class
     *
     * @deprecated Use setRequiredEnumByNameRule
     */
    protected static function requiredEnumByName(ClassMetadata &$metadata, string $property, string $class)
    {
        self::setRequiredEnumByNameRule($metadata, $property, $class);
    }

    /**
     * @param ClassMetadata &$metadata
     * @param string        $property
     * @param string        $class
     */
    protected static function setRequiredEnumByNameRule(ClassMetadata &$metadata, string $property, string $class)
    {
        /** @var Enum $class */
        $metadata->addPropertyConstraint(
            $property,
            new Constraints\Choice(
                array_map(
                    function ($item)
                    {
                        return (string)$item;
                    },
                    $class::getNames()
                )
            )
        );
        $metadata->addPropertyConstraint($property, new Constraints\NotBlank());
    }
}
