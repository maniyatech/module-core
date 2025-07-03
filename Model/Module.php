<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_Core
 */

declare(strict_types=1);

namespace ManiyaTech\Core\Model;

use InvalidArgumentException;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Component\ComponentRegistrarInterface;
use Magento\Framework\Filesystem\Directory\ReadFactory;
use Magento\Framework\Filesystem\Directory\ReadInterface;

class Module
{
    /**
     * Cached composer.json data for modules.
     *
     * @var array<string, array|object>
     */
    private array $composerJsonData = [];

    /**
     * @var ComponentRegistrarInterface
     */
    private ComponentRegistrarInterface $componentRegistrar;

    /**
     * @var ReadFactory
     */
    private ReadFactory $readFactory;

    /**
     * Module constructor.
     *
     * @param ComponentRegistrarInterface $componentRegistrar
     * @param ReadFactory $readFactory
     */
    public function __construct(
        ComponentRegistrarInterface $componentRegistrar,
        ReadFactory $readFactory
    ) {
        $this->componentRegistrar = $componentRegistrar;
        $this->readFactory = $readFactory;
    }

    /**
     * Get decoded composer.json data for the given module.
     *
     * @param string $moduleName
     * @param bool $assoc Return associative array if true, otherwise stdClass
     * @return array|object
     */
    public function getLocalComposerData(string $moduleName, bool $assoc = false): array|object
    {
        if (!isset($this->composerJsonData[$moduleName])) {
            try {
                $path = $this->componentRegistrar->getPath(ComponentRegistrar::MODULE, $moduleName);
                /** @var ReadInterface $directoryRead */
                $directoryRead = $this->readFactory->create($path);
                $composerJson = $directoryRead->readFile('composer.json');
                $this->composerJsonData[$moduleName] = $this->decodeJson($composerJson, $assoc);
            } catch (\Exception $e) {
                // In case of error (e.g., file not found), store an empty array to prevent repeated file reads
                $this->composerJsonData[$moduleName] = $assoc ? [] : (object)[];
            }
        }

        return $this->composerJsonData[$moduleName];
    }

    /**
     * Get the installed version from composer.json for the specified module.
     *
     * @param string $moduleName
     * @return string
     */
    public function getInstalledVersion(string $moduleName): string
    {
        $data = $this->getLocalComposerData($moduleName, true);
        return $data['version'] ?? '0.0.0';
    }

    /**
     * Decode JSON safely with error handling.
     *
     * @param string $json
     * @param bool $assoc
     * @return array|object
     * @throws InvalidArgumentException If JSON decoding fails
     */
    public function decodeJson(string $json, bool $assoc = false): array|object
    {
        $result = json_decode($json, $assoc);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Unable to decode JSON: ' . json_last_error_msg());
        }

        return $result;
    }
}
