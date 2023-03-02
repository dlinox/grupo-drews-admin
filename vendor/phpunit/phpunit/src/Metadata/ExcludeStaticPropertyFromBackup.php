<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
<<<<<<< HEAD
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
=======
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 *
 * @psalm-immutable
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
 */
final class ExcludeStaticPropertyFromBackup extends Metadata
{
    /**
     * @psalm-var class-string
     */
    private readonly string $className;
    private readonly string $propertyName;

    /**
     * @psalm-param class-string $className
     */
    protected function __construct(int $level, string $className, string $propertyName)
    {
        parent::__construct($level);

        $this->className    = $className;
        $this->propertyName = $propertyName;
    }

    public function isExcludeStaticPropertyFromBackup(): bool
    {
        return true;
    }

    /**
     * @psalm-return class-string
     */
    public function className(): string
    {
        return $this->className;
    }

    public function propertyName(): string
    {
        return $this->propertyName;
    }
}
