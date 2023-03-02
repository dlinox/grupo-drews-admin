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

use PHPUnit\Metadata\Version\Requirement;

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
final class RequiresPhp extends Metadata
{
    private readonly Requirement $versionRequirement;

    protected function __construct(int $level, Requirement $versionRequirement)
    {
        parent::__construct($level);

        $this->versionRequirement = $versionRequirement;
    }

    public function isRequiresPhp(): bool
    {
        return true;
    }

    public function versionRequirement(): Requirement
    {
        return $this->versionRequirement;
    }
}
