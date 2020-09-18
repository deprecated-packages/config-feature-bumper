<?php

declare(strict_types=1);

namespace Migrify\ConfigFeatureBumper\Yaml;

use Migrify\ConfigFeatureBumper\Utils\MigrifyArrays;

final class TagAnalyzer
{
    /**
     * @var string[]
     */
    private const AUTOCONFIGURED_TAG_NAMES = [
        'console.command',
        'config_cache.resource_checker',
        'container.service_subscriber',
        'controller.service_arguments',
        'controller.service_arguments',
        'data_collector',
        'form.type',
        'form.type_guesser',
        'kernel.cache_clearer',
        'kernel.cache_warmer',
        'kernel.event_subscriber',
        'property_info.list_extractor',
        'property_info.type_extractor',
        'property_info.description_extractor',
        'property_info.access_extractor',
        'serializer.encoder',
        'serializer.normalizer',
        'validator.constraint_validator',
        'validator.initializer',
    ];

    /**
     * @var MigrifyArrays
     */
    private $migrifyArrays;

    public function __construct(MigrifyArrays $migrifyArrays)
    {
        $this->migrifyArrays = $migrifyArrays;
    }

    /**
     * @param mixed[] $tags
     */
    public function isAutoconfiguredTags(array $tags): bool
    {
        if (isset($tags[0]) && is_string($tags[0])) {
            return $this->isAutoconfiguredTagName($tags[0]);
        }

        if (! $this->migrifyArrays->hasOnlyKey($tags[0], 'name')) {
            return false;
        }

        return $this->isAutoconfiguredTagName($tags[0]['name']);
    }

    private function isAutoconfiguredTagName(string $tag): bool
    {
        return in_array($tag, self::AUTOCONFIGURED_TAG_NAMES, true);
    }
}
