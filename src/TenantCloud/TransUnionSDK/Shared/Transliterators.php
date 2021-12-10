<?php

namespace TenantCloud\TransUnionSDK\Shared;

use TenantCloud\Standard\StaticConstructor\HasStaticConstructor;
use Transliterator;

final class Transliterators implements HasStaticConstructor
{
	/**
	 * Transliterator for {@see https://en.wikipedia.org/wiki/Diacritic} as TransUnion mostly only accepts ASCII characters,
	 * but there are valid cases where diacritics should have been allowed. For example, the US has many cities
	 * with diacritics in them: {@see https://en.wikipedia.org/wiki/List_of_U.S._cities_with_diacritics}
	 */
	public static Transliterator $diacritics;

	public static function __constructStatic(): void
	{
		self::$diacritics = Transliterator::createFromRules(':: NFD; :: [:Nonspacing Mark:] Remove; :: NFC;', Transliterator::FORWARD);
	}
}
