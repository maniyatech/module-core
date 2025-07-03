<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_Core
 */

namespace ManiyaTech\Core\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    public const BASE_TMP_PATH = 'ManiyaTech/tmp';
    public const BASE_PATH = 'ManiyaTech';
    public const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'svg'];

    /**
     * @var string
     */
    protected string $baseTmpPath;

    /**
     * @var string
     */
    protected string $basePath;

    /**
     * @var string[]
     */
    protected array $allowedExtensions;

    /**
     * Constructor
     *
     * @param Context $context
     * @param string  $baseTmpPath
     * @param string  $basePath
     * @param array   $allowedExtensions
     */
    public function __construct(
        Context $context,
        $baseTmpPath = self::BASE_TMP_PATH,
        $basePath = self::BASE_PATH,
        $allowedExtensions = self::ALLOWED_EXTENSIONS
    ) {
        parent::__construct($context);
        $this->baseTmpPath = $baseTmpPath;
        $this->basePath = $basePath;
        $this->allowedExtensions = $allowedExtensions;
    }

    /**
     * Get base temporary path.
     */
    public function getBaseTmpPath(): string
    {
        return $this->baseTmpPath;
    }

    /**
     * Get base media path.
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * Get list of allowed file extensions.
     *
     * @return string[]
     */
    public function getAllowedExtensions(): array
    {
        return $this->allowedExtensions;
    }
}
